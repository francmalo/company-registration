<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Retrieve the registration data from the database
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM business_registration WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$registration = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Registration</title>
    <!-- Include your CSS and JavaScript files here -->
</head>

<body>
    <h1>View Registration</h1>
    <h2>Company Name: <?php echo $registration['company_name']; ?></h2>
    <p>Business Type: <?php echo $registration['business_type']; ?></p>
    <p>Proposed Names: <?php echo $registration['proposed_names']; ?></p>
    <!-- Display other registration details here -->
    <a href="dashboard.php">Back to Dashboard</a>
</body>

</html>