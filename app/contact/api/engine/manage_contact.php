<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';

    $id = (int)$data['id'];

    $answer["testA"] = $data;
    $answer["testB"] = $_FILES;
    exit(json_encode($answer));

    $answer["success"] = 1;
    exit(json_encode($answer));
?>