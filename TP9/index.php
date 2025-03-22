<?php
require_once 'Model/pdo.php';

$sqlStudents = $dbPDO->prepare("SELECT id, nom, prenom FROM etudiants");
$sqlStudents->execute();
$resStudents = $sqlStudents->fetchAll();

$sqlClasses = $dbPDO->prepare("SELECT id, libelle FROM classes");
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

<body>
    <h1>Liste des étudiants</h1>
    <ul>
        <?php foreach ($resStudents as $student): ?>
            <li>
                <?php echo $student['prenom'] . ' ' . $student['nom']; ?>
                <a href="Views/modif_etudiant.php?id=<?php echo $student['id']; ?>">Modifier</a>
                <a href="Views/suppression_etudiant.php?id=<?php echo $student['id']; ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h1>Liste des classes</h1>
    <ul>
        <?php foreach ($resClasses as $class): ?>
            <li><?php echo $class['libelle']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h1>Liste des professeurs</h1>
    <ul>
        <?php foreach ($resProfs as $prof): ?>
            <li><?php echo $prof['prof_prenom'] . ' ' . $prof['prof_nom'] . ' - ' . $prof['matiere_nom'] . ' - ' . $prof['classe_libelle']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h1>Ajouter une nouvelle matière</h1>
    <form action="Views/nouvelle_matiere.php" method="post">
        <label for="libelle">Libellé:</label>
        <input type="text" id="libelle" name="libelle" required>
        <button type="submit">Valider</button>
    </form>

    <h1>Ajouter un nouvel élève</h1>
    <form action="Views/nouvel_etudiant.php" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required>
        <label for="classe">Classe:</label>
        <select id="classe" name="classe" required>
            <?php foreach ($resClasses as $class): ?>
                <option value="<?php echo $class['id']; ?>"><?php echo $class['libelle']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Valider</button>
    </form>
</body>