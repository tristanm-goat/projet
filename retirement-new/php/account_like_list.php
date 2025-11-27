<?php
function get_liked_facilities($username) {
    // --- Step 1: Get liked facility IDs from the 'login-details' database ---
    
    // We need to create a new connection here because the main 'connection.php' might be used elsewhere.
    include 'connection.php';

    $stmt_get_ids = $login_conn->prepare("SELECT account_option1, account_option2, account_option3 FROM account WHERE account_user = ?");
    $stmt_get_ids->bind_param("s", $username);
    $stmt_get_ids->execute();
    $result_ids = $stmt_get_ids->get_result();
    $liked_ids_row = $result_ids->fetch_assoc();
    $stmt_get_ids->close();
    $login_conn->close();

    // Filter out null/empty values to get a clean list of IDs
    $liked_ids = [];
    if ($liked_ids_row) {
        $liked_ids = array_filter([$liked_ids_row['account_option1'], $liked_ids_row['account_option2'], $liked_ids_row['account_option3']]);
    }

    if (empty($liked_ids)) {
        return []; // No liked facilities, return an empty array
    }

    // --- Step 2: Get facility details from the 'ontario_facility_rhra' database ---
    $facility_host = "localhost:3306";
    $facility_username = "member";
    $facility_password = "admin";
    $facility_dbname = "ontario_facility_rhra";

    $facility_conn = new mysqli($facility_host, $facility_username, $facility_password, $facility_dbname);
    if ($facility_conn->connect_error) {
        error_log("Facility DB Connection failed: " . $facility_conn->connect_error);
        return [];
    }

    // Create placeholders for the IN clause (e.g., ?,?,?)
    $placeholders = implode(',', array_fill(0, count($liked_ids), '?'));
    // Create the type definition string for bind_param (e.g., 'sss')
    $types = str_repeat('s', count($liked_ids));

    $sql_get_details = "SELECT 
        postal, id, citytown, tool_tip_id, name, lic_number, previously_known_as, latlng, lic_status, streetaddress, 
        assistance_with_bathing, assistance_with_personal_hygiene, assistance_with_ambulation, assistance_with_feeding, 
        provision_of_skin_and_wound_care, continence_care, administration_of_drugs_or_another_substance, 
        provision_of_a_meal, dementia_care_program, assistance_with_dressing, 
        pharmacists_provides_while_engaging_in_the_practice_of_pharmacy, 
        phy_and_surg_provides_while_engaging_in_the_practice_of_medicine, 
        nurses_provides_while_engaging_in_the_practice_of_nursing, 
        number_of_suites, resident_capacity 
    FROM rhra_entries_detailed WHERE id IN ($placeholders)";
    $stmt_get_details = $facility_conn->prepare($sql_get_details);
    
    // Bind the parameters dynamically
    $stmt_get_details->bind_param($types, ...$liked_ids);
    $stmt_get_details->execute();
    $result_details = $stmt_get_details->get_result();

    $liked_facilities = [];
    while ($row = $result_details->fetch_assoc()) {
        // Use the facility ID as the key for easy lookup
        $liked_facilities[$row['id']] = $row;
    }

    $stmt_get_details->close();
    $facility_conn->close();

    // Return the facilities in the order they were liked
    $ordered_facilities = array_map(fn($id) => $liked_facilities[$id] ?? null, $liked_ids);
    return array_filter($ordered_facilities);
}
?>