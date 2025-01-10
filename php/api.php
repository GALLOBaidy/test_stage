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
// else {
//     echo "Connexion réussie";
// }
$data = array();
function fetchData($conn, $table)
{
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        $data = array("message" => "0 résultats pour $table");
    }
    return $data;
}
$data['produits'] = fetchData($conn, 'produit');
$data['accompagnements'] = fetchData($conn, 'accompagnement');
$data['boissons'] = fetchData($conn, 'boisson');
// $data['commandes'] = fetchData($conn, 'commande');
// Fermer la connexion 
$conn->close();
// Renvoyer les données au format JSON 
$json_data = json_encode($data);
if (json_last_error() !== JSON_ERROR_NONE) {
    die(json_encode(array("error" => "Erreur JSON: " . json_last_error_msg())));
}
echo $json_data;


// // Vérifier la connexion 
// if ($conn->connect_error) {
//     die("Connexion échouée: " . $conn->connect_error);
// }
// // Vérifier si la méthode de la requête est POST 
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Récupérer les données JSON envoyées 
//     $data = json_decode(file_get_contents('php://input'), true);
//     // Parcourir les produits du panier et les enregistrer dans la base de données 
//     foreach ($data['panier'] as $produit) {
//         $nom_produit = $produit['nom'];
//         $prix = $produit['prix'];
//         $total = $prix * $quantite;
//         $sql = "INSERT INTO commandes (nom_produit, prix, quantite, total) VALUES ('$nom_produit', $prix, $quantite, $total)";
//         if ($conn->query($sql) === TRUE) {
//             echo "Nouvelle commande ajoutée avec succès";
//         } else {
//             echo "Erreur: " . $sql . "<br>" . $conn->error;
//         }
//     }

//     // Envoyer une réponse JSON 
//     header('Content-Type: application/json');
//     echo json_encode(['message' => 'Données reçues avec succès', 'data' => $data]);
// } else {
//     // Si la méthode n'est pas POST, envoyer une réponse d'erreur 
//     header('HTTP/1.1 405 Method Not Allowed');
//     echo 'Méthode non autorisée';
// }
// // Fermer la connexion 
// $conn->close();

// header('Content-Type: application/json');
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "mcdo1";
// // Créer une connexion 
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Vérifier la connexion 
// if ($conn->connect_error) {
//     die(json_encode(array("error" => "Connexion échouée: " . $conn->connect_error)));
// }else {
//     echo "Connexion réussie";
// }
// $data = array();
// // Requête pour le tableau produit 
// $sql1 = "SELECT * FROM produit";
// $result1 = $conn->query($sql1);
// $produits = array();
// if ($result1->num_rows > 0) {
//     while ($row = $result1->fetch_assoc()) {
//         $produits[] = $row;
//     }
// } else {
//     $produits = array("message" => "0 résultats pour produits");
// }
// $data['produits'] = $produits;
// // Requête pour le tableau accompagnement 
// $sql2 = "SELECT * FROM accompagnement";
// $result2 = $conn->query($sql2);
// $accompagnements = array();
// if ($result2->num_rows > 0) {
//     while ($row = $result2->fetch_assoc()) {
//         $accompagnements[] = $row;
//     }
// } else {
//     $accompagnements = array("message" => "0 résultats pour accompagnements");
// }
// $data['accompagnements'] = $accompagnements;
// // Requête pour le tableau boisson 
// $sql3 = "SELECT * FROM boisson";
// $result3 = $conn->query($sql3);
// $boissons = array();
// if ($result3->num_rows > 0) {
//     while ($row = $result3->fetch_assoc()) {
//         $boissons[] = $row;
//     }
// } else {
//     $boissons = array("message" => "0 résultats pour boissons");
// }
// $data['boissons'] = $boissons;
// // Fermer la connexion 
// $conn->close();
// // Renvoyer les données au format JSON 
// echo json_encode($data);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// header('Content-Type: application/json');
// $servername = "localhost";
// $username = "ton_utilisateur";
// $password = "ton_mot_de_passe";
// $dbname = "nom_de_ta_bdd";
// // Créer une connexion 
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Vérifier la connexion 
// if ($conn->connect_error) {
//     die(json_encode(array("error" => "Connexion échouée: " . $conn->connect_error)));
// }
// $sql = "SELECT * FROM ta_table";
// $result = $conn->query($sql);
// $data = array();
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $data[] = $row;
//     }
// } else {
//     $data = array("message" => "0 résultats");
// }
// $conn->close();
// echo json_encode($data);
// $sql = "SELECT * FROM produit";
// $result = $conn->query($sql);
// $data = array();
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $data[] = $row;
//     }
// } else {
//     $data = array("message" => "0 résultats");
// }
// $conn->close();
// echo json_encode($data);

// try {
//     $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
//     $pdo = new PDO($dsn, $user, $pass);
//     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//     echo "La connexion a été établie avec success";
// } catch (PDOException $e) {
//     echo "Pas de connexion à la base de données" . $e->getMessage();
// }

// $sql = "select * from produit";

// $stmt = $pdo->prepare($sql);

// $stmt->execute();

// $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo json_encode($produits);


// header('Content-Type: application/json');
// $method = $_SERVER['REQUEST_METHOD'];
// switch ($method) {
//     case 'GET':
//         get_data();
//         break;
//     case 'POST':
//         post_data();
//         break;
//     case 'PUT':
//         parse_str(file_get_contents("php://input"), $_PUT);
//         put_data($_PUT);
//         break;
//     case 'DELETE':
//         parse_str(file_get_contents("php://input"), $_DELETE);
//         delete_data($_DELETE);
//         break;
//     default:
//         echo json_encode(array("message" => "Méthode non supportée"));
//         break;
// }
// function get_data()
// {
//     // Exemple de données 
//     $data = array(array("id" => 1, "nom" => "Produit 1", "prix" => 10), array("id" => 2, "nom" => "Produit 2", "prix" => 20));
//     echo json_encode($data);
// }
// function post_data()
// {
//     $input = json_decode(file_get_contents('php://input'), true);
//     // Traitement des données POST 
//     echo json_encode(array("message" => "Données reçues", "data" => $input));
// }
// function put_data($data)
// {
//     // Traitement des données PUT 
//     echo json_encode(array("message" => "Données mises à jour", "data" => $data));
// }
// function delete_data($data)
// {
//     // Traitement des données DELETE
//     echo json_encode(array("message" => "Données supprimées", "data" => $data));
// }
