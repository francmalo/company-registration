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

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST['company_name'];
    $business_type = $_POST['business_type'];
    // Update other fields as needed

    $stmt = $conn->prepare("UPDATE business_registration SET company_name = ?, business_type = ? WHERE id = ?");
    $stmt->bind_param("ssi", $company_name, $business_type, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Registration</title>
    <!-- Include your CSS and JavaScript files here -->
</head>

<body>
    <h1>Update Registration</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" value="<?php echo $registration['company_name']; ?>"
            required><br><br>
        <label for="business_type">Business Type:</label>
        <select id="business_type" name="business_type" required>
            <option value="Private Limited Company"
                <?php if ($registration['business_type'] == 'Private Limited Company') echo 'selected'; ?>>Private
                Limited Company</option>
            <option value="Public Limited Company"
                <?php if ($registration['business_type'] == 'Public Limited Company') echo 'selected'; ?>>Public Limited
                Company</option>
            <!-- Add other business type options here -->
        </select><br><br>
        <!-- Add other form fields for updating registration details -->
        <input type="submit" value="Update">
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>

</html>