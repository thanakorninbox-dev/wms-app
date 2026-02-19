<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';

    $sql = "SELECT a.*, b.warehouse_name
        FROM md_storage a
        LEFT JOIN md_warehouse b ON 
            a.company_id = b.company_id and 
            a.warehouse = b.id
        WHERE 
            a.company_id = {$company_id}";
    $sth = $pdo2->prepare($sql);
    $sth->execute();
    if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
        $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
        exit(json_encode($answer));
    }

    $answer["output"] = $sth->fetchAll(PDO::FETCH_ASSOC);

    // modify output
    foreach($answer["output"] as $key => $item){

    }

    $answer["success"] = 1;
    exit(json_encode($answer));

?>