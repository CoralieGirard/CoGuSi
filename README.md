BD

CREATE TABLE IF NOT EXISTS Usager ( idUser INTEGER(10) AUTO_INCREMENT PRIMARY KEY, Username VARCHAR(40) UNIQUE, Email VARCHAR(100), idImage INTEGER(10), Password VARCHAR(1000),
CONSTRAINT idImage_fk FOREIGN KEY (idImage) REFERENCES Image(idImage)
);

CREATE TABLE IF NOT EXISTS Album ( idAlbum INTEGER(10) AUTO_INCREMENT PRIMARY KEY, Titre VARCHAR(100), Proprietaire INT, Description LONGTEXT, DateCreation VARCHAR(30), likes INT,

CONSTRAINT Proprietaire_fk FOREIGN KEY (Proprietaire) REFERENCES Usager(idUser)

);

CREATE TABLE IF NOT EXISTS Image ( idImage INTEGER(10) AUTO_INCREMENT PRIMARY KEY, URL VARCHAR(1000), idAlbum INT, Description VARCHAR(1000), DateCreation VARCHAR(30), likes INT,

CONSTRAINT idAlbum_fk FOREIGN KEY (idAlbum) REFERENCES Album(idAlbum)

);

CREATE TABLE IF NOT EXISTS Commentaire ( idCommentaire INTEGER(10) AUTO_INCREMENT PRIMARY KEY, Proprietaire INT, idType INT, Type VARCHAR(30), DateCreation VARCHAR(30), Contenu LONGTEXT,  likes INT,

CONSTRAINT Proprietaire_fk FOREIGN KEY (Proprietaire) REFERENCES Usager(idUser) );

INSERT INTO `image` (`idImage`, `URL`, `idAlbum`, `Description`, `DateCreation`, `likes`) VALUES
(1, './images/profile-2398782_960_720.jpg', NULL, NULL, NULL, 0);
