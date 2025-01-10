<?php
header('Content-Type: application/json');
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mcdo1';

// Connexion à la base de données 
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion 
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
} // Récupérer les données POST 
$produit = isset($_POST['produit']) ? $_POST['produit'] : '';
$quantite_produit = isset($_POST['quantite_produit']) ? $_POST['quantite_produit'] : 0;
$accompagnement = isset($_POST['accompagnement']) ? $_POST['accompagnement'] : '';
$quantite_accompagnement = isset($_POST['quantite_accompagnement']) ? $_POST['quantite_accompagnement'] : 0;
$boisson = isset($_POST['boisson']) ? $_POST['boisson'] : '';
$quantite_boisson = isset($_POST['quantite_boisson']) ? $_POST['quantite_boisson'] : 0;

// Récupérer les prix et les IDs depuis la base de données 
$prod_prix = $a_prix = $bsn_prix = 0;
$prod_id = $a_id = $bsn_id = 0;

// Calculer le total (exemple simplifié) 
$cmd_total = ($prod_prix * $quantite_produit) +
    ($a_prix * $quantite_accompagnement) +
    ($bsn_prix * $quantite_boisson);


// Exemple de requête pour récupérer les informations des produits 
$result = $conn->query("SELECT prod_id, prod_prix FROM Produit ");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $prod_id = $row['prod_id'];
    $prod_prix = $row['prod_prix'];
}

$result = $conn->query("SELECT a_id, a_prix FROM Accompagnement ");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $a_id = $row['a_id'];
    $a_prix = $row['a_prix'];
}

$result = $conn->query("SELECT bsn_id, bsn_prix FROM Boisson ");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $bsn_id = $row['bsn_id'];
    $bsn_prix = $row['bsn_prix'];
}

// Insérer les données dans la table Commande 
$stmt = $conn->prepare("INSERT INTO Commande (cmd_total, cmd_date) VALUES (?, NOW())");
$stmt->bind_param("d", $cmd_total);
$stmt->execute();
$cmd_id = $stmt->insert_id;
$stmt->close();

// Insérer les produits dans la table prod_cmd 
$stmt = $conn->prepare("INSERT INTO prod_cmd (prod_id, cmd_id, quantite_produit) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $prod_id, $cmd_id, $quantite_produit);
$stmt->execute();
$stmt->close();

// Insérer les accompagnements dans la table a_cmd 
$stmt = $conn->prepare("INSERT INTO a_cmd (a_id, cmd_id, quantite_accompagnement) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $a_id, $cmd_id, $quantite_accompagnement);
$stmt->execute();
$stmt->close();

// Insérer les boissons dans la table bsn_cmd 
$stmt = $conn->prepare("INSERT INTO bsn_cmd (bsn_id, cmd_id, quantite_boisson) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $bsn_id, $cmd_id, $quantite_boisson);
$stmt->execute();
$stmt->close();

// Récupérer les données des accompagnements 
$result_accompagnement = $conn->query("SELECT * FROM a_cmd WHERE cmd_id = $cmd_id");
$a_cmd = $result_accompagnement->fetch_all(MYSQLI_ASSOC);

// Récupérer les données des produits 
$result_produit = $conn->query("SELECT * FROM prod_cmd WHERE cmd_id = $cmd_id");
$prod_cmd = $result_produit->fetch_all(MYSQLI_ASSOC);

// Récupérer les données des boissons 
$result_boisson = $conn->query("SELECT * FROM bsn_cmd WHERE cmd_id = $cmd_id");
$bsn_cmd = $result_boisson->fetch_all(MYSQLI_ASSOC);

// Récupérer les données de la commande 
$result = $conn->query("SELECT * FROM Commande WHERE cmd_id = $cmd_id");
$commande = $result->fetch_assoc();


// Fermer la connexion 
$conn->close();
echo json_encode(array(
    "commande" => $commande,
    "a_cmd" => $a_cmd,
    "prod_cmd" => $prod_cmd,
    "bsn_cmd" => $bsn_cmd
));
// echo $json_data;

// echo json_encode(array("message" => "Commande passée avec succès"));

// // Créer une connexion 
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Vérifier la connexion 
// if ($conn->connect_error) {
//     die(json_encode(array("error" => "Connexion échouée: " . $conn->connect_error)));
// }
// // Vérifier si la méthode de la requête est POST 
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Récupérer les données JSON envoyées 
//     $data = json_decode(file_get_contents('php://input'), true);
//     // Parcourir les produits du panier et les enregistrer dans la base de données 
//     foreach ($data['panier'] as $produit) {
//         $nom_produit = $produit['nom'];
//         $prix = $produit['prix'];
//         $quantite = $produit['quantite'];
//         // Récupérer la quantité 
//         $total = $prix * $quantite;
//         $sql = "INSERT INTO commandes (nom_produit, prix, quantite, total) VALUES ('$nom_produit', $prix, $quantite, $total)";
//         if ($conn->query($sql) === TRUE) {
//             echo json_encode(array("message" => "Nouvelle commande ajoutée avec succès"));
//         } else {
//             echo json_encode(array("error" => "Erreur: " . $sql . "<br>" . $conn->error));
//         }
//     }
// } else {
//     // Si la méthode n'est pas POST, envoyer une réponse d'erreur 
//     header('HTTP/1.1 405 Method Not Allowed');
//     echo json_encode(array("error" => "Méthode non autorisée"));
// } // Fermer la connexion 
// $conn->close();
