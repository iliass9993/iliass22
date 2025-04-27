create database DBwatchnow;
use DBwatchnow;

CREATE TABLE Utilisateur (
    Id_Utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    Username varchar(255),
    Email varchar(255),
    PasswordC varchar(255),
    PhoneNumber varchar(12)
);

CREATE TABLE Pack (
    Id_Pack INT PRIMARY KEY AUTO_INCREMENT,
    Pack_Name VARCHAR(20),
    Price FLOAT
);

CREATE TABLE Profile (
    Id_Profile INT PRIMARY KEY AUTO_INCREMENT
);

CREATE TABLE Film (
    Id_Film INT PRIMARY KEY AUTO_INCREMENT
);

CREATE TABLE Contenu (
    Id_Contenu INT PRIMARY KEY AUTO_INCREMENT
);

CREATE TABLE Serie (
    Id_Serie INT PRIMARY KEY AUTO_INCREMENT
);

CREATE TABLE Payment (
    Id_Payment INT PRIMARY KEY AUTO_INCREMENT,
    Id_Utilisateur INT,
    FOREIGN KEY (Id_Utilisateur) REFERENCES Utilisateur(Id_Utilisateur)
);

CREATE TABLE Abonnement (
    Id_Abonnement INT PRIMARY KEY AUTO_INCREMENT,
    Id_Utilisateur INT,
    Id_Pack INT,
    Date_Debut DATE,
    Date_Fin DATE,
    PriceOfAbn float,
    FOREIGN KEY (Id_Utilisateur) REFERENCES Utilisateur(Id_Utilisateur),
    FOREIGN KEY (Id_Pack) REFERENCES Pack(Id_Pack)
);

CREATE TABLE Tracabilite (
    Id_Tracabilite INT PRIMARY KEY AUTO_INCREMENT,
    Id_Utilisateur INT,
    Action TEXT,
    Date_Action DATETIME,
    FOREIGN KEY (Id_Utilisateur) REFERENCES Utilisateur(Id_Utilisateur)
);

