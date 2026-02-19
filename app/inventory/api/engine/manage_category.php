<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';

    $id = (int)$data['id'];

    // get existing log
    $sql = "SELECT `log` 
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
    $row = $sth->fetch(PDO::FETCH_ASSOC);

    $table_log = json_decode($row['log'] ?? '[]', true);

    $table_log[] = $logging;

    if ($id > 0) {

        $sql = "UPDATE md_product_category SET
                    `category` = :category,
                    `slug` = :slug,
                    `description` = :description,
                    `status` = :status,
                    `log` = :log
                WHERE id = :id AND company_id = :company_id";

        $sth = $pdo2->prepare($sql);
        $sth->execute([
            ":id" => $id,
            ":company_id" => $company_id,
            ":category" => $data["category"],
            ":slug" => $data["slug"],
            ":description" => $data["description"],
            ":status" => $data["status"],
            ":log" => json_encode($table_log),
        ]);

    } else {

        $sql = "INSERT INTO md_product_category 
                (company_id, category, slug, `description`, `status`, `log`) 
                VALUES 
                (:company_id, :category, :slug, :description, :status, :log)";

        $sth = $pdo2->prepare($sql);
        $sth->execute([
            ":company_id" => $company_id,
            ":category" => $data["category"],
            ":slug" => $data["slug"],
            ":description" => $data["description"],
            ":status" => $data["status"],
            ":log" => json_encode($table_log),
        ]);
    }

    $answer["success"] = 1;
    exit(json_encode($answer));

?>