<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class mailer{


	public function __construct($_db){

		if( empty($_db["pdo1"]) ){

			exit(json_encode(["success"=>0, "message"=>"Error {$this->new_line}Developer need to define pdo1 - class ap"]));
		}

		if( empty($_db["pdo2"]) ){

			exit(json_encode(["success"=>0, "message"=>"Error {$this->new_line}Developer need to define pdo2 - class ap"]));
		}

			$this->pdo1  = $_db["pdo1"];
			$this->pdo2  = $_db["pdo2"];
	}


	public function get_authen($input = array()){
		
		
		$revise = [];
		$revise["company_id"] 	= $input["company_id"];

		if(count($input["smtp"]) > 0){
			return $input["smtp"];
		}

		$sql = "SELECT * FROM smtp_setting WHERE company_id = '{$revise["company_id"]}'";

		$sth = $this->pdo2->prepare("$sql");
		$sth->execute();

		$res = $sth->fetch(PDO::FETCH_ASSOC);

		if( empty($res) ){
			$answer = [];
			$answer["success"] = 0;
			$answer["message"] = "<b>Error: </b> You haven't set SMTP Server yet<br>----------<br>กรุณาตั้งค่า SMTP Server ก่อนส่ง Email";
			exit(json_encode($answer));
		}
		return $res;
	}


	private function check_required_fields($input=[]){

		$revise = [];

		$revise["class"] 	= $input["class"];
		$revise["function"] = $input["function"];
		$revise["require"] 	= $input["require"];
		$revise["input"] 	= $input["input"];


		foreach ($revise["require"] as $key => $item) {

			if( !isset($revise["input"][$item]) ){
				exit(json_encode(["success"=>0, "message"=>"Error: class {$revise["class"]}->{$revise["function"]} => {$item} cannot be empty"]));
			}
		}
	}


	private function decrypt($input){

		$this->check_required_fields([
			"class"		=> "trdb",
			"function"	=> "decrypt",
			"require" 	=> ["key","data"],
			"input" 	=> $input
		]);

		return openssl_decrypt(trim($input["data"]), "AES-256-CBC", $input["key"], 0, "1234567890123456" );
	}
	

	public function send_email($input = array()){


		$this->check_required_fields([
			"class"		=> "trdb",
			"function"	=> "send_email",
			"require" 	=> ["subject","message","company_id"],
			"input" 	=> $input
		]);
		
		
		$revise 				= [];
		$revise["subject"]		= $input["subject"];
		$revise["message"]		= $input["message"];
		$revise["channel_name"]	= $input["channel_name"];
		$revise["to"]			= $input["to"];
		$revise["key"]			= $input["key"];
		$company_id				= $input["company_id"];
		$authen 				= $this->get_authen($input);


        require_once dirname(__FILE__).'/phpmailer/vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug  = false;
            $mail->isSMTP();
            $mail->CharSet 	  = "UTF-8";
            $mail->Host       = $authen["server"];
            $mail->SMTPAuth   = true;
            $mail->Timeout    = 20;
            $mail->Username   = $authen["username"];
            $mail->Password   = $this->decrypt(["data"=>$authen["password"],"key"=>$revise["key"]]);
            
			if ($authen["port"] === "465") {
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			} elseif ($authen["port"] === "587" || $authen["port"] === "25") {
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			} else {
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // default fallback
			}

            $mail->Port       = $authen["port"];

			if(true){
				$mail->SMTPOptions = [
					'socket' => ['bindto' => '0.0.0.0:0']
				];
			}

            //Recipients
            $mail->setFrom($authen["username"], $revise["channel_name"]);


		    $des = explode(",", $revise["to"]);

		    foreach ($des as $key => $value) {
		        $mail->addAddress(trim($value));
		    }

            //Content
            $mail->isHTML(true);
            $mail->Subject = $revise["subject"];
            $mail->Body    = nl2br($revise["message"]);
            $mail->AltBody = $revise["message"];

            $mail->send();
        } 
        catch (phpmailerException $e) {

			$answer = [];
			$answer["success"] = 0;
            $answer["message"] = "<b>Error1</b>: ".nl2br($e->errorMessage());
			exit(json_encode($answer));
		}
        catch (Exception $e) {
        
			$answer = [];
			$answer["success"] = 0;
            $answer["message"] = "<b>Error2</b>: ".nl2br($mail->ErrorInfo);
			exit(json_encode($answer));

        }

	}

}

?>
