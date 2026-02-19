<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';
    
    sleep(1);

	session_destroy();

    $answer["success"] = 1;
    exit(json_encode($answer));

?>