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
$produit = $_POST['produit'];
$quantite_produit = $_POST['quantite_produit'];
$accompagnement = $_POST['accompagnement'];
$quantite_accompagnement = $_POST['quantite_accompagnement'];
$boisson = $_POST['boisson'];
$quantite_boisson = $_POST['quantite_boisson'];


// Calculer le total (exemple simplifié) 
$total = ($prod_prix * $quantite_produit) +
    ($a_prix * $quantite_accompagnement) +
    ($bsn_prix * $quantite_boisson);

// Insérer les données dans la table Commande 
$stmt = $conn->prepare("INSERT INTO Commande (cmd_total, cmd_date) VALUES (?, NOW())");
$stmt->bind_param("d", $total);
$stmt->execute();
$commande_id = $stmt->insert_id;
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
$stmt = $conn->prepare("INSERT INTO bsn_cmd (bsn_id, cmd_id, quantite_accompagnement) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $bsn_id, $cmd_id, $quantite_boisson);
$stmt->execute();
$stmt->close();

// Fermer la connexion 
$conn->close();
echo json_encode(array("message" => "Commande passée avec succès"));

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
