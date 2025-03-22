<?php
require_once 'Model/pdo.php';

$sqlStudents = $dbPDO->prepare("SELECT nom, prenom FROM etudiants");
$sqlStudents->execute();
$resStudents = $sqlStudents->fetchAll();

$sqlClasses = $dbPDO->prepare("SELECT libelle FROM classes");
$sqlClasses->execute();
$resClasses = $sqlClasses->fetchAll();

$sqlProfs = $dbPDO->prepare("
    SELECT professeurs.nom AS prof_nom, professeurs.prenom AS prof_prenom, matiere.lib AS matiere_nom, classes.libelle AS classe_libelle
    FROM professeurs
    JOIN matiere ON professeurs.id_matiere = matiere.id
    JOIN classes ON professeurs.id_classe = classes.id
");
$sqlProfs->execute();
$resProfs = $sqlProfs->fetchAll();
?>

<a href="register.php">S'inscrire</a>
<a href="login.php">Se connecter</a>
<p>Créer un compte pour modifier la base de donnée</p>
<div class="relative overflow-x-auto">
    <h1 class="text-lg font-bold">Liste des étudiants</h1>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Prénom</th>
                <th scope="col" class="px-6 py-3">Nom</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resStudents as $student): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"> <?php echo $student['prenom']; ?> </td>
                    <td class="px-6 py-4"> <?php echo $student['nom']; ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="relative overflow-x-auto mt-6">
    <h1 class="text-lg font-bold">Liste des classes</h1>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Libellé</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resClasses as $class): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"> <?php echo $class['libelle']; ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="relative overflow-x-auto mt-6">
    <h1 class="text-lg font-bold">Liste des professeurs</h1>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Prénom</th>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3">Matière</th>
                <th scope="col" class="px-6 py-3">Classe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resProfs as $prof): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"> <?php echo $prof['prof_prenom']; ?> </td>
                    <td class="px-6 py-4"> <?php echo $prof['prof_nom']; ?> </td>
                    <td class="px-6 py-4"> <?php echo $prof['matiere_nom']; ?> </td>
                    <td class="px-6 py-4"> <?php echo $prof['classe_libelle']; ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>