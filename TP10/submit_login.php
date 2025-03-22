<?php
session_start();
require_once 'Model/pdo.php';

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    echo "<pre>Veuillez remplir tous les champs</pre>";
    header('Location: login.php');
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

try {
    $resultat = $dbPDO->prepare("SELECT * FROM `user` WHERE `email` = :email");
    $resultat->execute(['email' => $email]);

    if ($resultat->rowCount() > 0) {
        $user = $resultat->fetch();

        if ($user['password'] === sha1($password)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            header('Location: dashboard.php');
            exit();
        } else {
            echo "<pre>Mot de passe incorrect</pre>";
        }
    } else {
        echo "<pre>Aucun utilisateur trouvé</pre>";
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

exit();
