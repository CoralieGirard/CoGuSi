# BD
CREATE TABLE IF NOT EXISTS Usager
(
idUser INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
Username VARCHAR(40),
Email VARCHAR(100),
Image LONGTEXT,
Password VARCHAR(40)
);

CREATE TABLE IF NOT EXISTS Album
(
idAlbum INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
Titre VARCHAR(100),
Proprietaire VARCHAR(40),
Description LONGTEXT,
DateCreation VARCHAR(40)
);

CREATE TABLE IF NOT EXISTS Image
(
idImage INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
idAlbum INT,
Description VARCHAR(1000),
DateCreation VARCHAR(40)
);

CREATE TABLE IF NOT EXISTS Commentaire
(
idCommentaire INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
Type VARCHAR(30),
DateCreation VARCHAR(40),
Contenu LONGTEXT
);
