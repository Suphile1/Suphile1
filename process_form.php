<?php
$servername = "localhost";
$username = "root";  // Changez cela si vous avez un autre nom d'utilisateur
$password = "";  // Changez cela si vous avez un mot de passe
$dbname = "contact_form_db";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$entreprise = $_POST['entreprise'];
$vous_etes = $_POST['vous_etes'];
$vous_cherchez = $_POST['vous_cherchez'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$message = $_POST['message'];

// Préparer et lier
$stmt = $conn->prepare("INSERT INTO contacts (nom, prenom, entreprise, vous_etes, vous_cherchez, telephone, email, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $nom, $prenom, $entreprise, $vous_etes, $vous_cherchez, $telephone, $email, $message);

// Exécuter la requête
if ($stmt->execute()) {
    echo "Les données ont été soumises avec succès.";
} else {
    echo "Erreur: " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
