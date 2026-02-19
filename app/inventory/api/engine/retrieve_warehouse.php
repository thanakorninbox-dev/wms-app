<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';

    $id = (int)$data['id'];

    $sql = "SELECT * 
        FROM md_warehouse
        WHERE 
            company_id = {$company_id} and 
            id = {$id}";

    $sth = $pdo2->prepare($sql);
    $sth->execute();
    if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
        $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
        exit(json_encode($answer));
    }

    $answer["output"] = $sth->fetch(PDO::FETCH_ASSOC);
    $answer["success"] = 1;
    exit(json_encode($answer));

?>