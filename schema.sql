CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL
);

CREATE TABLE livres (
    livre_id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    auteur VARCHAR(150) NOT NULL,
    image VARCHAR(255),
    description TEXT,
    statut ENUM(
        'disponible',
        'indisponible',
        'me_contacter'
    ) NOT NULL DEFAULT 'disponible', 
    utilisateur_id INT NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

CREATE TABLE conversations (
    conversation_id INT AUTO_INCREMENT PRIMARY KEY,
    user1_id INT NOT NULL ,
    user2_id INT NOT NULL,
    UNIQUE (user1_id, user2_id),
    FOREIGN KEY (user1_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (user2_id) REFERENCES utilisateurs(id),
    CHECK (user1_id < user2_id)
);

CREATE TABLE messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    conversation_id INT NOT NULL,
    expediteur_id INT NOT NULL,
    contenu TEXT NOT NULL,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (conversation_id) REFERENCES conversations(conversation_id),
    FOREIGN KEY (expediteur_id) REFERENCES utilisateurs(id)   
);