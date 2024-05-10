CREATE TABLE business_registration (
    registration_id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    business_type VARCHAR(255) NOT NULL,
    proposed_names TEXT NOT NULL,
    proposed_name_documents TEXT NOT NULL,
    articles_of_association TEXT NOT NULL,
    registered_address TEXT NOT NULL,
    share_information TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE shareholders_directors (
    shareholder_director_id INT AUTO_INCREMENT PRIMARY KEY,
    registration_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    national_id_path TEXT NOT NULL,
    pin_certificate_path TEXT NOT NULL,
    passport_photo_path TEXT NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    shares INT NOT NULL,
    FOREIGN KEY (registration_id) REFERENCES business_registration(registration_id)
);

CREATE TABLE beneficial_owners (
    beneficial_owner_id INT AUTO_INCREMENT PRIMARY KEY,
    registration_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    id VARCHAR(255) NOT NULL,
    supporting_document_path TEXT NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    shares_percentage INT NOT NULL,
    FOREIGN KEY (registration_id) REFERENCES business_registration(registration_id)
);