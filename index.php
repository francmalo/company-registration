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
        <hr>

        <label>Proposed Company Names</label>
        <div id="proposed-names-container">
            <div class="proposed-name-item">
                <input type="text" name="proposed_names[]" placeholder="Proposed Name" required>
                <input type="file" name="proposed_name_national_ids[]" accept="image/*, application/pdf" required
                    placeholder="National ID">
                <input type="file" name="proposed_name_pin_certificates[]" accept="image/*, application/pdf" required
                    placeholder="PIN Certificate">
                <input type="file" name="proposed_name_passport_photos[]" accept="image/jpeg, image/png" required
                    placeholder="Passport Photo">
            </div>
        </div>
        <button type="button" id="add-proposed-name">Add Another Proposed Name</button>
        <hr>

        <label for="articles_of_association">Articles of Association Details</label>
        <textarea id="articles_of_association" name="articles_of_association" required></textarea>
        <hr>

        <label for="registered_address">Registered Address</label>
        <textarea id="registered_address" name="registered_address" required></textarea>
        <hr>

        <label for="share_information">Share Information</label>
        <textarea id="share_information" name="share_information" required></textarea>
        <hr>

        <label>Shareholders and Directors</label>
        <div id="shareholders-directors-container">
            <div class="shareholder-director-item">
                <input type="text" name="shareholders_directors_names[]" placeholder="Name" required>
                <input type="file" name="shareholders_directors_national_ids[]" accept="image/*, application/pdf"
                    required placeholder="National ID">
                <input type="file" name="shareholders_directors_pin_certificates[]" accept="image/*, application/pdf"
                    required placeholder="PIN Certificate">
                <input type="file" name="shareholders_directors_passport_photos[]" accept="image/jpeg, image/png"
                    required placeholder="Passport Photo">
                <input type="text" name="shareholders_directors_addresses[]" placeholder="Residential Address" required>
                <input type="tel" name="shareholders_directors_phones[]" placeholder="Phone Number" required>
                <input type="email" name="shareholders_directors_emails[]" placeholder="Email Address" required>
                <input type="number" name="shareholders_directors_shares[]" placeholder="Number of Shares" required>
            </div>
        </div>
        <button type="button" id="add-shareholder-director">Add Another Shareholder/Director</button>
        <hr>

        <label>Beneficial Owners</label>
        <div id="beneficial-owners-container">
            <div class="beneficial-owner-item">
                <input type="text" name="beneficial_owners_names[]" placeholder="Name" required>
                <input type="text" name="beneficial_owners_ids[]" placeholder="National ID/Passport Number" required>
                <input type="file" name="beneficial_owners_documents[]" accept="image/*, application/pdf" required
                    placeholder="Supporting Documents">
                <input type="text" name="beneficial_owners_addresses[]" placeholder="Residential Address" required>
                <input type="tel" name="beneficial_owners_phones[]" placeholder="Phone Number" required>
                <input type="email" name="beneficial_owners_emails[]" placeholder="Email Address" required>
                <input type="number" name="beneficial_owners_shares[]" placeholder="Percentage of Shares" required>
            </div>
        </div>
        <button type="button" id="add-beneficial-owner">Add Another Beneficial Owner</button>
        <hr>

        <input type="submit" value="Register">
    </form>


    <script>
    // Get the form element
    const form = document.getElementById('registration-form');

    // Add an event listener for form submission
    form.addEventListener('submit', handleSubmit);

    // Function to handle form submission
    function handleSubmit(event) {
        event.preventDefault(); // Prevent the default form submission

        // Perform client-side validation
        const isValid = validateForm();

        if (isValid) {
            // If the form is valid, submit it
            this.submit();
        } else {
            // If the form is invalid, display an error message
            alert('Please fill out all required fields.');
        }
    }

    // Function to validate the form
    function validateForm() {
        const inputs = form.querySelectorAll('input, textarea, select');
        let isValid = true;

        inputs.forEach(function(input) {
            if (input.required && input.value.trim() === '') {
                isValid = false;
            }
        });

        return isValid;
    }

    // Add event listeners for adding more proposed names, shareholders/directors, and beneficial owners
    const proposedNamesContainer = document.getElementById('proposed-names-container');
    const addProposedNameButton = document.getElementById('add-proposed-name');
    addProposedNameButton.addEventListener('click', addProposedName);

    const shareholdersDirectorsContainer = document.getElementById('shareholders-directors-container');
    const addShareholderDirectorButton = document.getElementById('add-shareholder-director');
    addShareholderDirectorButton.addEventListener('click', addShareholderDirector);

    const beneficialOwnersContainer = document.getElementById('beneficial-owners-container');
    const addBeneficialOwnerButton = document.getElementById('add-beneficial-owner');
    addBeneficialOwnerButton.addEventListener('click', addBeneficialOwner);

    // Function to add a new proposed name input field
    function addProposedName() {
        const newItem = document.createElement('div');
        newItem.classList.add('proposed-name-item');
        newItem.innerHTML = `
                <input type="text" name="proposed_names[]" placeholder="Proposed Name" required>
                <input type="file" name="proposed_name_national_ids[]" accept="image/*, application/pdf" required placeholder="National ID">
                <input type="file" name="proposed_name_pin_certificates[]" accept="image/*, application/pdf" required placeholder="PIN Certificate">
                <input type="file" name="proposed_name_passport_photos[]" accept="image/jpeg, image/png" required placeholder="Passport Photo">
            `;
        proposedNamesContainer.appendChild(newItem);
    }

    // Function to add a new shareholder/director input field
    function addShareholderDirector() {
        const newItem = document.createElement('div');
        newItem.classList.add('shareholder-director-item');
        newItem.innerHTML = `
                <input type="text" name="shareholders_directors_names[]" placeholder="Name" required>
                <input type="file" name="shareholders_directors_national_ids[]" accept="image/*, application/pdf" required placeholder="National ID">
                <input type="file" name="shareholders_directors_pin_certificates[]" accept="image/*, application/pdf" required placeholder="PIN Certificate">
                <input type="file" name="shareholders_directors_passport_photos[]" accept="image/jpeg, image/png" required placeholder="Passport Photo">
                <input type="text" name="shareholders_directors_addresses[]" placeholder="Residential Address" required>
                <input type="tel" name="shareholders_directors_phones[]" placeholder="Phone Number" required>
                <input type="email" name="shareholders_directors_emails[]" placeholder="Email Address" required>
                <input type="number" name="shareholders_directors_shares[]" placeholder="Number of Shares" required>
            `;
        shareholdersDirectorsContainer.appendChild(newItem);
    }

    // Function to add a new beneficial owner input field
    function addBeneficialOwner() {
        const newItem = document.createElement('div');
        newItem.classList.add('beneficial-owner-item');
        newItem.innerHTML = `
                <input type="text" name="beneficial_owners_names[]" placeholder="Name" required>
                <input type="text" name="beneficial_owners_ids[]" placeholder="National ID/Passport Number" required>
                <input type="file" name="beneficial_owners_documents[]" accept="image/*, application/pdf" required placeholder="Supporting Documents">
                <input type="text" name="beneficial_owners_addresses[]" placeholder="Residential Address" required>
                <input type="tel" name="beneficial_owners_phones[]" placeholder="Phone Number" required>
                <input type="email" name="beneficial_owners_emails[]" placeholder="Email Address" required>
                <input type="number" name="beneficial_owners_shares[]" placeholder="Percentage of Shares" required>
            `;
        beneficialOwnersContainer.appendChild(newItem);
    }
    </script>
</body>

</html>