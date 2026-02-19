<?php
session_start();

require '../../../preset.php';
require '../../../assets/utils/db_auth.php';

$id = (int)($data['id'] ?? 0);

// get existing log
$sql = "SELECT `log`
        FROM md_warehouse
        WHERE company_id = :company_id
          AND id = :id";
$sth = $pdo2->prepare($sql);
$sth->execute([
  ':company_id' => $company_id,
  ':id' => $id,
]);

if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
  $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
  exit(json_encode($answer));
}
$row = $sth->fetch(PDO::FETCH_ASSOC);

$table_log = json_decode($row['log'] ?? '[]', true);
if (!is_array($table_log)) $table_log = [];

// add new log entry (assumes $logging already prepared)
$table_log[] = $logging;

if ($id > 0) {

  $sql = "UPDATE md_warehouse SET
            warehouse_name = :warehouse_name,
            location       = :location,
            manager        = :manager,
            capacity       = :capacity,
            description    = :description,
            status         = :status,
            `log`          = :log
          WHERE id = :id
            AND company_id = :company_id";

  $sth = $pdo2->prepare($sql);
  $sth->execute([
    ":id"             => $id,
    ":company_id"     => $company_id,
    ":warehouse_name" => $data["warehouse_name"] ?? "",
    ":location"       => $data["location"] ?? "",
    ":manager"        => (int)($data["manager"] ?? 0),
    ":capacity"       => (int)($data["capacity"] ?? 0),
    ":description"    => $data["description"] ?? "",
    ":status"         => (int)($data["status"] ?? 1),
    ":log"            => json_encode($table_log, JSON_UNESCAPED_UNICODE),
  ]);

} else {

  $sql = "INSERT INTO md_warehouse
            (company_id, warehouse_name, location, manager, capacity, description, status, `log`)
          VALUES
            (:company_id, :warehouse_name, :location, :manager, :capacity, :description, :status, :log)";

  $sth = $pdo2->prepare($sql);
  $sth->execute([
    ":company_id"     => $company_id,
    ":warehouse_name" => $data["warehouse_name"] ?? "",
    ":location"       => $data["location"] ?? "",
    ":manager"        => (int)($data["manager"] ?? 0),
    ":capacity"       => (int)($data["capacity"] ?? 0),
    ":description"    => $data["description"] ?? "",
    ":status"         => (int)($data["status"] ?? 1),
    ":log"            => json_encode($table_log, JSON_UNESCAPED_UNICODE),
  ]);
  
}

if ($sth->errorInfo()[0] != "00000" && !empty($sth->errorInfo()[0])) {
  $answer["message"] = (empty($sth->errorInfo()[2])) ? $sth->errorInfo()[0] : $sth->errorInfo()[2];
  exit(json_encode($answer));
}

$answer["success"] = 1;
exit(json_encode($answer));
?>
