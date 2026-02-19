<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';

    $id = (int)$data['id'];

    // get data
    $sql = "SELECT *
        FROM md_product_category
        WHERE 
            company_id = {$company_id} and 
            id = {$id}";
    $sth = $pdo2->prepare($sql);
    $sth->execute();
    if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
        $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
        exit(json_encode($answer));
    }
    $json = $sth->fetch(PDO::FETCH_ASSOC);
    $json = json_encode($json);

    

    // delete data
    $sql = "DELETE FROM md_product_category
        WHERE 
            company_id = {$company_id} and 
            id = {$id}";
    $sth = $pdo2->prepare($sql);
    $sth->execute();
    if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
        $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
        exit(json_encode($answer));
    }



    // insert into archive
    $sql = "INSERT INTO archive (`company_id`,`user_id`,`date`,`json`) VALUES ({$company_id},{$user_id},NOW(),'{$jsona}')";
    $sth = $pdo2->prepare($sql);
    $sth->execute();
    if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
        $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
        exit(json_encode($answer));
    }



    $answer["success"] = 1;
    exit(json_encode($answer));

?>