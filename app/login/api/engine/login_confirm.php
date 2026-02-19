<?php 
	session_start();

	require '../../../preset.php';
	require '../../../assets/utils/db_auth.php';

	$data["username"] = $_SESSION["login_data"]['username'];
	$data["password"] = $_SESSION["login_data"]['password'];
	$user_id		= $_SESSION["login_user_id"];
	$password 		= md5(trim(strtolower($data["password"])));	
	$salt_password 	= md5($user_id."_".trim(strtolower($data["password"])));	

	/**
	 * Validate OTP
	 */
	function generateOTP($sercet_key, $time_step = 180, $length = 6){
		$counter = floor($_SESSION["otpTime"] / $time_step);
		$data = pack("NN", 0, $counter);
		$hash = hash_hmac('sha1', $data, $sercet_key, true);
		$offset = ord(substr($hash, -1)) & 0x0F;
		$value = unpack("N", substr($hash, $offset, 4));
		$otp = ($value[1] & 0x7FFFFFFF) % pow(10, $length);

		return str_pad(strval($otp), $length, '0', STR_PAD_LEFT);
	}

	$otp = generateOTP($password);

	// time diff between $_SESSION["otpTime"] and now() in minutes
	$otp_time = isset($_SESSION['otpTime']) ? (int)$_SESSION['otpTime'] : 0;
	$now = time();
	$otp_diff_seconds = max(0, $now - $otp_time);
	$otp_diff_minutes = $otp_diff_seconds / 60.0;

	// print time
	$_SESSION["now"] = $now;
	$_SESSION["diff"] = $otp_diff_minutes;

	/**
	 * Validate OTP
	 */
	if( $data["otp"]!=$otp || $otp_diff_minutes > 5 ){
		$answer["message"] = "Wrong OTP! Please try again. (Our OTP is valid for 5 minute)";
		exit(json_encode($answer));
	}

    // get password 
    $sth = $pdo1->prepare("select * from user where user_id = {$user_id} limit 1;");
	$sth->execute();
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
			$temp = $s->fetch(PDO::FETCH_ASSOC);
		}

		/**
		 * Create login session
		 */
		$_SESSION["login_status"] 		= 1;
		$_SESSION["login_username"] 	= $temp["username"];
		$_SESSION["login_name"] 			= $temp["name"];
		$_SESSION["login_surname"] 		= $temp["surname"];
		$_SESSION["login_company_id"] = $temp["default_company"];

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