<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';

    $id = (int)$data['id'];
    $warehouse = (int)$data['warehouse'];

    $sql = "SELECT * 
        FROM md_storage
        WHERE 
            company_id = {$company_id} and 
            warehouse = {$warehouse} and 
            `zone` = '{$data["zone"]}'
        ";

    $sth = $pdo2->prepare($sql);
    $sth->execute();
    if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
        $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
        exit(json_encode($answer));
    }

    $pre = $sth->fetchAll(PDO::FETCH_ASSOC);

    $output = [];
    foreach ($pre as $key => $value) {
        $output = array_merge($output, range($value["aisle_form"], $value["aisle_to"]));
    }

    $answer["output"] = $output;
    $answer["success"] = 1;
    exit(json_encode($answer));

?>