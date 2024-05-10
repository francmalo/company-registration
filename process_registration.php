<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config.php';

// Function to handle file uploads
function uploadFiles($files, $upload_dir) {
    $file_paths = array();
    foreach ($files['tmp_name'] as $key => $tmp_name) {
        $file_path = $upload_dir . basename($files['name'][$key]);
        if (move_uploaded_file($tmp_name, $file_path)) {
            $file_paths[] = $file_path;
        } else {
            // Handle file upload error
            echo "Error uploading file: " . $files['name'][$key];
        }
    }
    return $file_paths;
}

// Create the uploads directory if it doesn't exist
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Get the form data
$company_name = $_POST['company_name'];
$business_type = $_POST['business_type'];
$proposed_names = implode(", ", $_POST['proposed_names']);
$articles_of_association = $_POST['articles_of_association'];
$registered_address = $_POST['registered_address'];
$share_information = $_POST['share_information'];

// Move the proposed name documents to the uploads directory
$proposed_name_national_id_paths = uploadFiles($_FILES['proposed_name_national_ids'], $upload_dir);
$proposed_name_pin_certificate_paths = uploadFiles($_FILES['proposed_name_pin_certificates'], $upload_dir);
$proposed_name_passport_photo_paths = uploadFiles($_FILES['proposed_name_passport_photos'], $upload_dir);

$proposed_name_document_paths = array(
    'national_ids' => $proposed_name_national_id_paths,
    'pin_certificates' => $proposed_name_pin_certificate_paths,
    'passport_photos' => $proposed_name_passport_photo_paths
);
$proposed_name_documents = json_encode($proposed_name_document_paths);

// Prepare the SQL statement for business_registration table
$sql = "INSERT INTO business_registration (company_name, business_type, proposed_names, proposed_name_documents, articles_of_association, registered_address, share_information)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("sssssss", $company_name, $business_type, $proposed_names, $proposed_name_documents, $articles_of_association, $registered_address, $share_information );
// Execute the statement
if ($stmt->execute()) {
// Get the last inserted ID
$registration_id = $stmt->insert_id;

$stmt->close();

// Handle the shareholders and directors data
foreach ($_POST['shareholders_directors_names'] as $key => $name) {
    $shareholder_director_name = $name;
    $shareholder_director_address = $_POST['shareholders_directors_addresses'][$key];
    $shareholder_director_phone = $_POST['shareholders_directors_phones'][$key];
    $shareholder_director_email = $_POST['shareholders_directors_emails'][$key];
    $shareholder_director_shares = $_POST['shareholders_directors_shares'][$key];
    $shareholder_director_national_id_path = uploadFiles($_FILES['shareholders_directors_national_ids'], $upload_dir);
    $shareholder_director_pin_certificate_path = uploadFiles($_FILES['shareholders_directors_pin_certificates'], $upload_dir);
    $shareholder_director_passport_photo_path = uploadFiles($_FILES['shareholders_directors_passport_photos'], $upload_dir);

    // Prepare the SQL statement for shareholders_directors table
    $sql = "INSERT INTO shareholders_directors (registration_id, name, national_id_path, pin_certificate_path, passport_photo_path, address, phone, email, shares)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("isssssssi", $registration_id, $shareholder_director_name, $shareholder_director_national_id_path[0], $shareholder_director_pin_certificate_path[0], $shareholder_director_passport_photo_path[0], $shareholder_director_address, $shareholder_director_phone, $shareholder_director_email, $shareholder_director_shares);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();
}

// Handle the beneficial owners data
foreach ($_POST['beneficial_owners_names'] as $key => $name) {
    $beneficial_owner_name = $name;
    $beneficial_owner_id = $_POST['beneficial_owners_ids'][$key];
    $beneficial_owner_address = $_POST['beneficial_owners_addresses'][$key];
    $beneficial_owner_phone = $_POST['beneficial_owners_phones'][$key];
    $beneficial_owner_email = $_POST['beneficial_owners_emails'][$key];
    $beneficial_owner_shares = $_POST['beneficial_owners_shares'][$key];
    $beneficial_owner_document_path = uploadFiles($_FILES['beneficial_owners_documents'], $upload_dir);

    // Prepare the SQL statement for beneficial_owners table
  // Prepare the SQL statement for shareholders_directors table
// Prepare the SQL statement for beneficial_owners table
// Prepare the SQL statement for beneficial_owners table
$sql = "INSERT INTO beneficial_owners (registration_id, name, id, supporting_document_path, address, phone, email, shares_percentage)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters
// Bind the parameters
$stmt->bind_param("ississsi", $registration_id, $beneficial_owner_name, $beneficial_owner_id, $beneficial_owner_document_path[0], $beneficial_owner_address, $beneficial_owner_phone, $beneficial_owner_email, $beneficial_owner_shares);

// Execute the statement
$stmt->execute();

    // Close the statement
    $stmt->close();
}

echo "Business registration successful!";
} else {
echo "Error: " . $stmt->error;
}
// Close the database connection
$conn->close();
?>