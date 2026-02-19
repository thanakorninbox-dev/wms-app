<?php

require_once __DIR__."/../../config.php";
require_once __DIR__."/../../dbconn.php";

if(!empty($_SESSION["login_company_id"])){

    // validate otp
    $sql = "SELECT `password`
        FROM user 
        WHERE user_id = {$_SESSION["login_user_id"]}";
    $sth = $pdo1->prepare($sql);
    $sth->execute();
    if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
        $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
        exit(json_encode($answer));
    }
    $password = $sth->fetchColumn();
    /** Generate OTP */
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
    
    if( $_SESSION["otp"]!=$otp ){
        $answer["message"] = "Your password has been reset, Please logout and login again.";
        exit(json_encode($answer));
    }
    
    // check company accessibily
    $sql = "SELECT * FROM company_map_user WHERE company_id = {$_SESSION["login_company_id"]} and user_id = {$_SESSION["login_user_id"]}";
    $sth = $pdo1->prepare($sql);
    $sth->execute();
    if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
        $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
        exit(json_encode($answer));
    }
    $map = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    if( count($map)==0 ){
        $answer["message"] = "Your accessibility to this company has been removed.";
        exit(json_encode($answer));
    }

}





// set up ANSWER
$answer = array("success"=>0, "message"=>"");

if(!isset($_POST['json']))
{
    $answer["message"] = "No data receive!";
    exit(json_encode($answer));
}

$data = json_decode($_POST['json'],true);

// incase logging in
if(!empty($_SESSION["login_company_id"])){

    $company_id = (int)$_SESSION["login_company_id"];
    $user_id = (int)$_SESSION["login_user_id"];

    // create json for table logging
    $logging = array(
        "user_id" => $user_id,
        "data" => json_encode($data),
        "dt" => date('Y-m-d H:i:s'),
        "login" => date('Y-m-d H:i:s', $_SESSION["otpTime"])
    );

} 


class db_auth{
	

}
?>
