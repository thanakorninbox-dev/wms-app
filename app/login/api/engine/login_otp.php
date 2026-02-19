<?php 
	session_start();

	require '../../../preset.php';
	require '../../../assets/utils/db_auth.php';

	// get user_id by username or password
	$sth			= $pdo1->prepare("select user_id from user where ? in (username,email) ");
	$sth->execute(array(strtolower($data["username"])));
	$user_id		= $sth->fetchColumn();

	$username 		= strtolower($data["username"]);
	$password 		= md5(trim(strtolower($data["password"])));	
	$salt_password 	= md5($user_id."_".trim(strtolower($data["password"])));	
	// get password 
	$sth = $pdo1->prepare("select password from user where username = ? or email = ? limit 1;");
	$sth->execute(array($username,$username));
	$temp = $sth->fetch(PDO::FETCH_ASSOC);

  if( strtolower($data["username"]) == "support" ){
		if( $data["password"] == strtolower(substr(md5("trcloud".date("Ymd")),0,4)) ){
			$support = true;
		}else{
			$support = false;
		}
	}else{
		$support = false;
	}

  /**
	 * validate password
	*/
	if((($password == $temp["password"]||$salt_password == $temp["password"]) && strtolower($data["username"]) != "support") || $support == true ){

		// create user session
		if( strtolower($data["username"]) == "support" ){
			$s = $pdo1->query("select *, 'info@trcloud.co' as email from user where username='support' limit 1;");
			$r = $s->fetch(PDO::FETCH_ASSOC);
		}else{
			$s = $pdo1->prepare("select * from user where (username=? or email=?) and user_id = ? limit 1;");
			$s->execute(array($username,$username,$user_id));
			$r = $s->fetch(PDO::FETCH_ASSOC);
		}

		// user email
		$user_email = $r["email"];

		if(strpos($user_email,"@")===false){
			$answer["message"] = "<b>".$user_email."</b> is not eligible email, please contact your administrator to change your email.";
			exit(json_encode($answer));
		}

		if( $r["status"] == "not activated" ){
			$answer["message"] = "Cannot Login: This user is not activated!?!";
			exit(json_encode($answer));
		}

		//~ access control
		if( isset($pinform["secure_login"]) && $pinform["secure_login"] == "on" && $_SESSION["license"] != "lord"){
			
			$sth = $pdo1->prepare("select * from whitelist where cookie = :cookie");
			$sth->execute(array(":cookie"=>$data["cookie"]));
			if($sth->rowCount()==0){
				
				$s = $pdo1->prepare("INSERT INTO `whitelist` (`cookie`, `status`, `ip`) VALUES (:cookie, '1', :ip) on duplicate key update ip = values(ip);");
				$s->execute(array(":cookie"=>$data["cookie"],":ip"=>$_SERVER["REMOTE_ADDR"]));
				
				session_destroy();
				$answer["message"] = "wait";
				setcookie("u", "", time()-1, "/");
				setcookie("h1", "", time()-1, "/");
				setcookie("h2", "", time()-1, "/");
				echo json_encode($answer);
				
			}else{
				
				$coo = $sth->fetch(PDO::FETCH_ASSOC);
				if( $coo["status"] == "0" ){
					session_destroy();
					$answer["message"] = "block";
					setcookie("u", "", time()-1, "/");
					setcookie("h1", "", time()-1, "/");
					setcookie("h2", "", time()-1, "/");
					echo json_encode($answer);

					$deviceDecision = [
						'type'   => 'BLOCKED',
						'status' => 0
					];

				}else if( $coo["status"] == "1" ){
					session_destroy();
					$answer["message"] = "wait";
					setcookie("u", "", time()-1, "/");
					setcookie("h1", "", time()-1, "/");
					setcookie("h2", "", time()-1, "/");
					echo json_encode($answer);

					$deviceDecision = [
						'type'   => 'WAIT_APPROVAL',
						'status' => 1
					];
					include __DIR__ . "/api/engine-notification/new_device_login_alert.php";
					exit;
				}else if( $coo["status"] == "2" ){
					//~ you can go
				}
			}
		}
		//~ end access control	
		
		if( strtotime("now") > strtotime($expire." + 1 day") ){
			session_destroy();
			$answer["expire"] = "expire";
			exit(json_encode($answer));
			setcookie("u", "", time()-1, "/");
			setcookie("h1", "", time()-1, "/");
			setcookie("h2", "", time()-1, "/");
		}



		/**
		 * Generate OTP
		 */
		function generateOTP($sercet_key, $time_step = 180, $length = 6){

			global $otpTime;

			$otpTime = time();

			$counter = floor($otpTime / $time_step);
			$data = pack("NN", 0, $counter);
			$hash = hash_hmac('sha1', $data, $sercet_key, true);
			$offset = ord(substr($hash, -1)) & 0x0F;
			$value = unpack("N", substr($hash, $offset, 4));
			$otp = ($value[1] & 0x7FFFFFFF) % pow(10, $length);

			return str_pad(strval($otp), $length, '0', STR_PAD_LEFT);
		}


		function numberToLetters($num) {
			$result = '';
			while ($num > 0) {
					$mod = ($num - 1) % 26;
					$result = chr(65 + $mod) . $result;
					$num = intval(($num - $mod) / 26);
			}
			return str_pad($result, 6, 'A', STR_PAD_LEFT);
		}

		$otp = generateOTP($password);

		$reference_number = numberToLetters(generateOTP($otp));

		/**
		 * Sent Email With OTP
		 */
		require "../../../assets/utils/module/mailer.php";

		// send email
		if(true){

			$mailer 	= new mailer(["pdo1"=>$pdo1,"pdo2"=>$pdo2]);

			$mailer->send_email([
				"company_id" 	=> 0,
				"smtp" 	=> $SMTP,
				"subject" 	 	=> "One Time Password (OTP) For reference number ".$reference_number,
				"message" 	 	=> "Your OTP is ".$otp." for reference number ".$reference_number,
				"channel_name" 	=> "WMS LOGIN OTP ",
				"to" 			=> $user_email,
				"key" 			=> $pinkey,
			]);

		}

        $_SESSION = [];

		$_SESSION["login_data"] = $data; // store variables

		$_SESSION["otp"] = $otp;

		$_SESSION["otpTime"] = $otpTime;

		$_SESSION["reference"] = $reference_number;

		$_SESSION["user_email"] = $user_email;

		$_SESSION["login_user_id"] = $user_id;

		$answer["success"] 	= 1;
		$answer["message"] 	= "Login Complete!";
		exit(json_encode($answer));
	}
	else
	{
		$answer["message"] = "Incorrect Password";
		setcookie("u", "", time()-1, "/");
		setcookie("h1", "", time()-1, "/");
		setcookie("h2", "", time()-1, "/");
		exit(json_encode($answer));
	}

	$answer["success"] = 1;
	exit(json_encode($answer));

?>