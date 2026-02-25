<?php 
    session_start();

    require '../../../preset.php';
    require '../../../assets/utils/db_auth.php';

    $id = (int)$data['id'];

    /** * FILE SYNCHRONIZATION & UPLOAD LOGIC 
     * -----------------------------------------------------------------------------------
     * Strategy: "Keep & Sync"
     * 1. Identify which existing files were removed by the user and delete them from disk.
     * 2. Upload any brand-new files dropped into the Dropzone.
     * 3. Re-assemble a final comma-separated string containing (Kept Files + New Files).
     * -----------------------------------------------------------------------------------
     */

    // Define the physical path for storage
    $target_dir = $include_url . "uploads/contact/";

    /** 1. DISK CLEANUP (Removal of deleted files) **/
    if ($id > 0) {
        // Fetch currently stored filenames from DB for comparison
        $sql_check = "SELECT `files` FROM md_contact WHERE company_id = :company_id AND id = :id";
        $sth_check = $pdo2->prepare($sql_check);
        $sth_check->execute([":company_id" => $company_id, ":id" => $id]);
        $existing_db_string = $sth_check->fetchColumn();

        if (!empty($existing_db_string)) {
            $existing_files_array = explode(',', $existing_db_string);
            
            // 'keep_files' comes from JS (Dropzone.files names currently in the UI)
            $keep_files = isset($data['keep_files']) ? explode(',', $data['keep_files']) : [];

            foreach ($existing_files_array as $file_on_disk) {
                $file_on_disk = trim($file_on_disk);
                if (empty($file_on_disk)) continue;

                /**
                 * If a file exists in the database but is NOT in the 'keep_files' list,
                 * it means the user clicked 'Remove' in the UI. We delete it from the server.
                 */
                if (!in_array($file_on_disk, $keep_files)) {
                    $full_path = $target_dir . $file_on_disk;
                    if (file_exists($full_path)) {
                        unlink($full_path); // Physically remove (rm) the file
                    }
                }
            }
        }
    }

    /** 2. PERMISSION & DIRECTORY CHECK **/
    $parent_dir = dirname($target_dir);
    if (!is_writable($parent_dir)) {
        exit(json_encode([
            "success" => 0, 
            "message" => "Server error: Target directory is not writable. Check permissions."
        ]));
    }

    // Ensure the directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true); 
    }

    /** 3. PROCESSING NEW UPLOADS **/
    $uploaded_names = [];

    if (isset($_FILES['contact_files'])) {
        foreach ($_FILES['contact_files']['name'] as $key => $name) {
            if ($_FILES['contact_files']['error'][$key] === UPLOAD_ERR_OK) {
                
                $tmp_name = $_FILES['contact_files']['tmp_name'][$key];
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                
                // Assign a unique ID to prevent filename collisions on the server
                $file_id = uniqid() . "_" . time() . "." . $extension;
                $destination = $target_dir . $file_id;

                if (move_uploaded_file($tmp_name, $destination)) {
                    $uploaded_names[] = $file_id;
                    // Standard readable permission
                    chmod($destination, 0644); 
                } else {
                    error_log("Failed to move uploaded file: " . $name);
                }
            }
        }
    }

    /** 4. CONSTRUCTING THE FINAL DATABASE STRING **/
    // Parse files the user kept from the existing session
    $keep_files = isset($data['keep_files']) ? explode(',', $data['keep_files']) : [];

    // Merge old kept filenames with the brand-new unique filenames
    $final_file_array = array_merge($keep_files, $uploaded_names);

    // Clean up: Remove empty values and trim whitespace
    $final_file_array = array_filter(array_map('trim', $final_file_array));

    // The final comma-separated string for the DB 'files' column
    $db_image_string = implode(",", $final_file_array);

    /********************************************************************************** */


    // 2. Initialize log array
    $table_log = [];

    // Get existing log and existing files if updating
    if ($id > 0) {
        $sql = "SELECT `log`, `files` FROM md_contact WHERE company_id = :company_id AND id = :id";
        $sth = $pdo2->prepare($sql);
        $sth->execute([
            ":company_id" => $company_id,
            ":id" => $id
        ]);
        
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $table_log = json_decode($row['log'] ?? '[]', true);
        }
    }

    // Append the new log entry
    $table_log[] = $logging;

    // 3. Database Operation
    $params = [
        ":company_id"       => $company_id,
        ":contact_name"     => $data["contact_name"],
        ":tax_id"           => $data["tax_id"],
        ":organization"     => $data["organization"],
        ":branch"           => $data["branch"],
        ":contact_type"     => (int)$data["contact_type"],
        ":billing_address"  => $data["billing_address"],
        ":shipping_location"=> $data["shipping_location"],
        ":shipping_address" => $data["shipping_address"],
        ":remark"           => $data["remark"],
        ":files"            => $db_image_string,
        ":status"           => (int)$data["status"],
        ":log"              => json_encode($table_log)
    ];

    if ($id > 0) {
        // UPDATE
        $sql = "UPDATE md_contact SET
                    `contact_name`      = :contact_name,
                    `tax_id`            = :tax_id,
                    `organization`      = :organization,
                    `branch`            = :branch,
                    `contact_type`      = :contact_type,
                    `billing_address`   = :billing_address,
                    `shipping_location` = :shipping_location,
                    `shipping_address`  = :shipping_address,
                    `remark`            = :remark,
                    `files`             = :files,
                    `status`            = :status,
                    `log`               = :log
                WHERE id = :id AND company_id = :company_id";
        
        $params[":id"] = $id;
        $sth = $pdo2->prepare($sql);
        $sth->execute($params);

    } else {
        // INSERT
        $sql = "INSERT INTO md_contact 
                (company_id, contact_name, tax_id, organization, branch, contact_type, 
                billing_address, shipping_location, shipping_address, remark, files, status, log) 
                VALUES 
                (:company_id, :contact_name, :tax_id, :organization, :branch, :contact_type, 
                :billing_address, :shipping_location, :shipping_address, :remark, :files, :status, :log)";

        $sth = $pdo2->prepare($sql);
        $sth->execute($params);
    }

    $answer["success"] = 1;
    exit(json_encode($answer));
?>