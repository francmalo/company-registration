CREATE TABLE business_registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    business_type VARCHAR(50) NOT NULL,
    proposed_names TEXT,
    proposed_name_documents BLOB,
    articles_of_association TEXT,
    registered_address TEXT,
    share_information TEXT,
    shareholders_directors TEXT,
    shareholders_directors_documents BLOB,
    beneficial_owners TEXT,
    beneficial_owners_documents BLOB,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);