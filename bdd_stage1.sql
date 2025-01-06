create database mcdo1; 
use mcdo1;

CREATE TABLE Produit(
   prod_id INT auto_increment,
   prod_libelle VARCHAR(50) NOT NULL,
   prod_prix DECIMAL(15,2) NOT NULL,
   prod_img VARCHAR(500) NOT NULL,
   prod_description VARCHAR(500) NOT NULL,
   PRIMARY KEY(prod_id)
);

CREATE TABLE Accompagnement(
   a_id INT auto_increment,
   a_libelle VARCHAR(50) NOT NULL,
   a_prix DECIMAL(15,2) NOT NULL,
   a_img VARCHAR(500) NOT NULL,
   PRIMARY KEY(a_id)
);

CREATE TABLE Boisson(
   bsn_id INT auto_increment,
   bsn_libelle VARCHAR(50) NOT NULL,
   bsn_prix DECIMAL(15,2) NOT NULL,
   bsn_img VARCHAR(500) NOT NULL,
   PRIMARY KEY(bsn_id)
);

CREATE TABLE Adresse(
   adr_id INT auto_increment,
   adr_rue VARCHAR(150) NOT NULL,
   adr_ville VARCHAR(150) NOT NULL,
   adr_cp VARCHAR(50) NOT NULL,
   PRIMARY KEY(adr_id)
);

CREATE TABLE Client(
   clt_id INT auto_increment,
   clt_prenom VARCHAR(50) NOT NULL,
   clt_nom VARCHAR(50) NOT NULL,
   adr_id INT NOT NULL,
   PRIMARY KEY(clt_id),
   FOREIGN KEY(adr_id) REFERENCES Adresse(adr_id)
);

CREATE TABLE Commande(
   cmd_id INT auto_increment,
   cmd_date DATETIME NOT NULL,
   clt_id INT NOT NULL,
   PRIMARY KEY(cmd_id),
   FOREIGN KEY(clt_id) REFERENCES Client(clt_id)
);

CREATE TABLE Menu(
   menu_id INT auto_increment,
   menu_libelle VARCHAR(50) NOT NULL,
   cmd_id INT NOT NULL,
   bsn_id INT NOT NULL,
   a_id INT NOT NULL,
   prod_id INT NOT NULL,
   PRIMARY KEY(menu_id),
   FOREIGN KEY(cmd_id) REFERENCES Commande(cmd_id),
   FOREIGN KEY(bsn_id) REFERENCES Boisson(bsn_id),
   FOREIGN KEY(a_id) REFERENCES Accompagnement(a_id),
   FOREIGN KEY(prod_id) REFERENCES Produit(prod_id)
);

insert into produit values 
(1, 'Big mac', 5.60, 'https://mcdonaldschampselysees.fr/wp-content/uploads/2022/05/Big-Mac.png', "Ce hamburger est composé de deux rondelles de 45,4 g de viande hachée de bœuf ou poulet, de fromage américain, de « Sauce Spéciale »"),
(2, 'Big Tasty', 5.70, 'https://eu-images.contentstack.com/v3/assets/blt5004e64d3579c43f/blt39847df4f7dade25/66cc5764fc4e214320727ba1/BIG_TASTY_1Viande_TBWA_400x400px_72DPI_V2.png?auto=webp', "Deux généreux steaks hachés 100% pur bœuf*, trois tranches d'emmental fondu, deux rondelles de tomate, de la salade, des oignons frais et surtout une iconique sauce au goût grillé. Découvrez aussi son format 1 steak haché."),
(3,'Mc Chicken', 5, 'https://mcdonaldschampselysees.fr/wp-content/uploads/2022/05/Mc-Chiken.png', "Le McChicken se compose ainsi, de haut en bas : Pain au sésame Sauce McChicken 20 ml  Laitue émincée Poulet pané Pain inférieur La chair du poulet est composée à 90 % de muscle, à 5 % de gras, et à 5 % de peau ."),
(4, 'Mc Fish', 2.50, "https://www.mcdonalds.be/_webdata/product-images/mcfish.png", "Le Filet-O-Fish contient un filet de poisson pané fait essentiellement de colin d'Alaska et/ou de hoki, une demi tranche de fromage fondu et une sauce tartare. Il est servi sur un petit pain sans graines de sésame."),
(5, 'Mc Extreme', 6.75, "https://eu-images.contentstack.com/v3/assets/blt5004e64d3579c43f/blt892013edb702519d/670d41dd923a09ee0d95cb3b/EXTREME_2Viandes_TBWA_400x400px_72DPI.png?auto=webp", "Le burger qui se mange avec les deux mains ! McExtreme, le nouveau burger, toujours préparé à la commande*, tellement généreux qu'il se mange avec les deux mains ! Avec ses deux steaks hachés juteux, son gouda fumé, ses tranches de bacon et son pain moelleux, difficile d'y résister !"),
(6, 'Cheese', 2.50, "https://eu-images.contentstack.com/v3/assets/blt5004e64d3579c43f/blt2b47e0f28b8e53d7/666c673775b6dfc234a08c52/Cheeseburger_GLOBAL_400x400px_72DPI_V2.png?auto=webp", "Un cheeseburger ou hamburger au fromage est un hamburger dans lequel une tranche de fromage accompagne la viande.");

insert into accompagnement values
(1, 'Frites', 3.75, "https://s7d1.scene7.com/is/image/mcdonalds/FriesMedium:nutrition-calculator-tile?wid=472&hei=472&dpr=off"),
(2, 'Potatoes', 3.50, "https://eu-images.contentstack.com/v3/assets/blt5004e64d3579c43f/blt402c651b7ec19f76/666c67457172c14d2bf90039/GRANDE_POTATOES_GLOBAL_400x400px_72DPI.png?auto=webp"),
(3, 'Frites Double Chedar', 5.75, "https://eu-images.contentstack.com/v3/assets/blt5004e64d3579c43f/blt448a9f73a854302b/6570aae74bf0bf040a8ea9f9/McFlavors_Double_Cheddar_VAE_LAD.png?auto=webp"),
(4, 'Potatoes Double Chedar', 5.50, "https://eu-images.contentstack.com/v3/assets/blt5004e64d3579c43f/bltd2b4028eab2a848c/662b96e8c43d2b1ebe8f1506/13550.jpg?width=1200&height=630&crop=1200:630"); 


insert into boisson values
(1, "Coca-Cola", 4, "https://mcdorivedroite.com/wp-content/uploads/2017/02/COCA.jpg"),
(2, "Sprite", 4.30, "https://eu-images.contentstack.com/v3/assets/blt5004e64d3579c43f/blte12c314f20957f4f/66cc5adce0768f12f930ebc3/MOYEN_VERRE_SPRITE_GLOBAL_400x400px_72DPI.png?auto=webp"),
(3, "Fanta", 4, "https://mcdonaldschampselysees.fr/wp-content/uploads/2022/11/FANTA.webp"),
(4, "Ice Tea", 3.50, "https://mcdonaldschampselysees.fr/wp-content/uploads/2022/11/icetea.webp"),
(5, "Eau", 2, "https://eu-images.contentstack.com/v3/assets/blt5004e64d3579c43f/blta66db817bb5642be/6217a599c27bcd6ae2b6b9f8/Cup_eau.png?auto=webp");