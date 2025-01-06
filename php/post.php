<?php
header('Content-Type: application/json');
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mcdo1';
// Créer une connexion 
$conn = new mysqli($servername, $username, $password, $dbname);
// Vérifier la connexion 
if ($conn->connect_error) {
    die(json_encode(array("error" => "Connexion échouée: " . $conn->connect_error)));
}
// Vérifier si la méthode de la requête est POST 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données JSON envoyées 
    $data = json_decode(file_get_contents('php://input'), true);
    // Parcourir les produits du panier et les enregistrer dans la base de données 
    foreach ($data['panier'] as $produit) {
        $nom_produit = $produit['nom'];
        $prix = $produit['prix'];
        $quantite = $produit['quantite'];
        // Récupérer la quantité 
        $total = $prix * $quantite;
        $sql = "INSERT INTO commandes (nom_produit, prix, quantite, total) VALUES ('$nom_produit', $prix, $quantite, $total)";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Nouvelle commande ajoutée avec succès"));
        } else {
            echo json_encode(array("error" => "Erreur: " . $sql . "<br>" . $conn->error));
        }
    }
} else {
    // Si la méthode n'est pas POST, envoyer une réponse d'erreur 
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(array("error" => "Méthode non autorisée"));
} // Fermer la connexion 
$conn->close();
