<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';

    $id = (int)$data['id'];

    // Initialize log array
    $table_log = [];

    // Get existing log only if we are updating an existing record
    if ($id > 0) {
        $sql = "SELECT `log` 
                FROM md_contact_type
                WHERE
                    company_id = :company_id AND 
                    id = :id";
        $sth = $pdo2->prepare($sql);
        $sth->execute([
            ":company_id" => $company_id,
            "id" => $id
        ]);
        
        if ($sth->errorCode() !== '00000') {
            $error = $sth->errorInfo();
            $answer["message"] = $error[2] ?? $error[0];
            exit(json_encode($answer));
        }
        
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $table_log = json_decode($row['log'] ?? '[]', true);
        }
    }

    // Append the new log entry (assuming $logging is defined in your preset/utils)
    $table_log[] = $logging;

    if ($id > 0) {
        // UPDATE existing record
        $sql = "UPDATE md_contact_type SET
                    `contact_type` = :contact_type,
                    `description` = :description,
                    `status` = :status,
                    `log` = :log
                WHERE id = :id AND company_id = :company_id";

        $sth = $pdo2->prepare($sql);
        $sth->execute([
            ":id" => $id,
            ":company_id" => $company_id,
            ":contact_type" => $data["contact_type"],
            ":description" => $data["description"],
            ":status" => (int)$data["status"],
            ":log" => json_encode($table_log),
        ]);

    } else {
        // INSERT new record
        $sql = "INSERT INTO md_contact_type 
                (company_id, contact_type, `description`, `status`, `log`) 
                VALUES 
                (:company_id, :contact_type, :description, :status, :log)";

        $sth = $pdo2->prepare($sql);
        $sth->execute([
            ":company_id" => $company_id,
            ":contact_type" => $data["contact_type"],
            ":description" => $data["description"],
            ":status" => (int)$data["status"],
            ":log" => json_encode($table_log),
        ]);
    }

    $answer["success"] = 1;
    exit(json_encode($answer));
?>