<?php
// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$company_name = $_POST['company_name'];
$business_type = $_POST['business_type'];
$proposed_names = implode(", ", $_POST['proposed_names']);
$articles_of_association = $_POST['articles_of_association'];
$registered_address = $_POST['registered_address'];
$share_information = $_POST['share_information'];

// Handle the proposed names documents
$proposed_name_documents = "";
foreach ($_FILES['proposed_name_documents']['tmp_name'] as $key => $tmp_name) {
    $proposed_name_documents .= file_get_contents($tmp_name);
}

// Handle the shareholders and directors data
$shareholders_directors = array();
$shareholders_directors_documents = "";
foreach ($_POST['shareholders_directors_names'] as $key => $name) {
    $shareholders_directors[] = array(
        'name' => $name,
        'id' => $_POST['shareholders_directors_ids'][$key],
        'address' => $_POST['shareholders_directors_addresses'][$key],
        'phone' => $_POST['shareholders_directors_phones'][$key],
        'email' => $_POST['shareholders_directors_emails'][$key],
        'shares' => $_POST['shareholders_directors_shares'][$key]
    );

    $shareholders_directors_documents .= file_get_contents($_FILES['shareholders_directors_documents']['tmp_name'][$key]);
}
$shareholders_directors = json_encode($shareholders_directors);

// Handle the beneficial owners data
$beneficial_owners = array();
$beneficial_owners_documents = "";
foreach ($_POST['beneficial_owners_names'] as $key => $name) {
    $beneficial_owners[] = array(
        'name' => $name,
        'id' => $_POST['beneficial_owners_ids'][$key],
        'address' => $_POST['beneficial_owners_addresses'][$key],
        'phone' => $_POST['beneficial_owners_phones'][$key],
        'email' => $_POST['beneficial_owners_emails'][$key],
        'shares' => $_POST['beneficial_owners_shares'][$key]
    );

    $beneficial_owners_documents .= file_get_contents($_FILES['beneficial_owners_documents']['tmp_name'][$key]);
}
$beneficial_owners = json_encode($beneficial_owners);

// Prepare the SQL statement
$sql = "INSERT INTO business_registration (company_name, business_type, proposed_names, proposed_name_documents, articles_of_association, registered_address, share_information, shareholders_directors, shareholders_directors_documents, beneficial_owners, beneficial_owners_documents)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("sssbssssss", $company_name, $business_type, $proposed_names, $proposed_name_documents, $articles_of_association, $registered_address, $share_information, $shareholders_directors, $shareholders_directors_documents, $beneficial_owners, $beneficial_owners_documents);

// Execute the statement
if ($stmt->execute()) {
    echo "Business registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>