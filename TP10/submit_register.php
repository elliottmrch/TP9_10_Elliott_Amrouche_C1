<?php
require_once 'Model/pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;

    if (!empty($post['email']) && !empty($post['password']) && !empty($post['confirm-password']) && $post['password'] === $post['confirm-password']) {
        try {
            $resultat = $dbPDO->prepare("INSERT INTO `user` (`id`, `email`, `password`) VALUES (NULL, :email, SHA1(:password));");
            $req = $resultat->execute([
                'email' => $post['email'],
                'password' => $post['password']
            ]);

            if ($req) {
                header('Location: dashboard.php');
                exit();
            } else {
                header('Location: register.php');
                exit();
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        header('Location: register.php');
        exit();
    }
}
