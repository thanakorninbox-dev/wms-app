<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';

    $sql = "SELECT a.*
        FROM md_warehouse a
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
        // status
        if($item["status"]==1){
            $answer["output"][$key]["status"] = 'Active';
            $answer["output"][$key]["bg_class"] = 'success';
        }else{
            $answer["output"][$key]["status"] = 'Inactive';
            $answer["output"][$key]["bg_class"] = 'secondary';

        }
    }

    $answer["success"] = 1;
    exit(json_encode($answer));

?>