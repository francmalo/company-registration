<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>Business Registration Form</h2>
    <form id="registration-form" action="process_registration.php" method="post" enctype="multipart/form-data">
        <label for="company_name">Company Name</label>
        <input type="text" id="company_name" name="company_name" required>

        <label for="business_type">Business Type</label>
        <select id="business_type" name="business_type" required>
            <option value="">Select Business Type</option>
            <option value="Private Limited Company">Private Limited Company</option>
            <option value="Public Limited Company">Public Limited Company</option>
            <option value="Company Limited by Guarantee">Company Limited by Guarantee</option>
            <option value="Limited Liability Partnership">Limited Liability Partnership</option>
            <option value="Foreign Company Registration in Kenya">Foreign Company Registration in Kenya</option>
        </select>

        <label>Proposed Company Names</label>
        <div id="proposed-names-container">
            <div class="proposed-name-item">
                <input type="text" name="proposed_names[]" required>
                <input type="file" name="proposed_name_documents[]" accept="image/*, application/pdf" required>
            </div>
        </div>
        <button type="button" id="add-proposed-name">Add Another Proposed Name</button>

        <label for="articles_of_association">Articles of Association Details</label>
        <textarea id="articles_of_association" name="articles_of_association" required></textarea>

        <label for="registered_address">Registered Address</label>
        <textarea id="registered_address" name="registered_address" required></textarea>

        <label for="share_information">Share Information</label>
        <textarea id="share_information" name="share_information" required></textarea>

        <label>Shareholders and Directors</label>
        <div id="shareholders-directors-container">
            <div class="shareholder-director-item">
                <input type="text" name="shareholders_directors_names[]" placeholder="Name" required>
                <input type="text" name="shareholders_directors_ids[]" placeholder="National ID/Passport Number"
                    required>
                <input type="file" name="shareholders_directors_documents[]" accept="image/*, application/pdf" required>
                <input type="text" name="shareholders_directors_addresses[]" placeholder="Residential Address" required>
                <input type="tel" name="shareholders_directors_phones[]" placeholder="Phone Number" required>
                <input type="email" name="shareholders_directors_emails[]" placeholder="Email Address" required>
                <input type="number" name="shareholders_directors_shares[]" placeholder="Number of Shares" required>
            </div>
        </div>
        <button type="button" id="add-shareholder-director">Add Another Shareholder/Director</button>

        <label>Beneficial Owners</label>
        <div id="beneficial-owners-container">
            <div class="beneficial-owner-item">
                <input type="text" name="beneficial_owners_names[]" placeholder="Name" required>
                <input type="text" name="beneficial_owners_ids[]" placeholder="National ID/Passport Number" required>
                <input type="file" name="beneficial_owners_documents[]" accept="image/*, application/pdf" required>
                <input type="text" name="beneficial_owners_addresses[]" placeholder="Residential Address" required>
                <input type="tel" name="beneficial_owners_phones[]" placeholder="Phone Number" required>
                <input type="email" name="beneficial_owners_emails[]" placeholder="Email Address" required>
                <input type="number" name="beneficial_owners_shares[]" placeholder="Percentage of Shares" required>
            </div>
        </div>
        <button type="button" id="add-beneficial-owner">Add Another Beneficial Owner</button>

        <input type="submit" value="Register">
    </form>

    <script src="script.js"></script>
</body>

</html>