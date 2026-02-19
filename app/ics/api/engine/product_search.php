<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';

    $sql = "SELECT *
            FROM md_product
            WHERE 
              company_id = {$company_id} and 
              sku like '%{$data["keyword"]}%'
            LIMIT 50
            ";
    $sth = $pdo2->prepare($sql);
    $sth->execute();
    if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
        $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
        exit(json_encode($answer));
    }

    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    $answer["result"] = $result;
    $answer["success"] = 1;
    exit(json_encode($answer));

?>