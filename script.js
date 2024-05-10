// Get the form element
const form = document.getElementById('registration-form');

// Add an event listener for form submission
form.addEventListener('submit', function(event) {
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
});

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
        <input type="text" name="proposed_names[]" required>
        <input type="file" name="proposed_name_documents[]" accept="image/*, application/pdf" required>
    `;
    proposedNamesContainer.appendChild(newItem);
}

// Function to add a new shareholder/director input field
function addShareholderDirector() {
    const newItem = document.createElement('div');
    newItem.classList.add('shareholder-director-item');
    newItem.innerHTML = `
        <input type="text" name="shareholders_directors_names[]" placeholder="Name" required>
        <input type="text" name="shareholders_directors_ids[]" placeholder="National ID/Passport Number" required>
        <input type="file" name="shareholders_directors_documents[]" accept="image/*, application/pdf" required>
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
        <input type="file" name="beneficial_owners_documents[]" accept="image/*, application/pdf" required>
        <input type="text" name="beneficial_owners_addresses[]" placeholder="Residential Address" required>
        <input type="tel" name="beneficial_owners_phones[]" placeholder="Phone Number" required>
        <input type="email" name="beneficial_owners_emails[]" placeholder="Email Address" required>
        <input type="number" name="beneficial_owners_shares[]" placeholder="Percentage of Shares" required>
    `;
    beneficialOwnersContainer.appendChild(newItem);
}