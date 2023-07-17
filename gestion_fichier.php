<?php
include 'connexion_base.php';
// Connexion à la base de données
$pdo = new database('localhost', 'root', 'root','gestionnaire-fichier');
$bdd = $pdo->connect();
// Vérifie si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        // Vérifie l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)){
            die("Erreur : Veuillez sélectionner un format de fichier valide.");

        } 
        // Vérifie la taille du fichier - 5Mo maximum
        $maxsize = 20 * 1024 * 1024;
        if($filesize > $maxsize) {
            die("Error: La taille du fichier est supérieure à la limite autorisée.");
        } 
        // Vérifie le type MIME du fichier
        if(in_array($filetype, $allowed)){
            // Vérifie si le fichier existe avant de le télécharger.
            if(file_exists("upload/" . $_FILES["photo"]["name"])){
                echo $_FILES["photo"]["name"] . " existe déjà.";
            } 
            else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]);
                echo "Votre fichier a été téléchargé avec succès.";
                $nomFichier = $_FILES["photo"]["name"];
                $cheminDestination = "upload/" . $_FILES["photo"]["name"];
                $dateTelechargement = date("Y-m-d H:i:s"); // Utilisez la date actuelle pour la date de téléchargement
              
                // Insérer les informations du fichier dans la base de données
                // $requete = $bdd->prepare("INSERT INTO fichier (nom, chemin, 'date-telechargement') VALUES (?, ?, NOW())");
                // $requete->execute([$nomFichier, $cheminDestination]);
                // header("location: gestion_fichier.php");
                $requete = $bdd->prepare("INSERT INTO fichier (nom, chemin, `date-telechargement`) VALUES (?, ?, NOW())");
                $requete->execute([$nomFichier, $cheminDestination]);

                var_dump([$nomFichier, $cheminDestination]);
            } 
        } 
        else{
            echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
        }
    }
    else{
        echo "Error: " . $_FILES["photo"]["error"];
        var_dump($_FILES["photo"]["error"]);
    }


}
//une requête SQL SELECT pour récupérer les enregistrements de la table "fichier" de la base de données
$requete = $bdd->prepare("SELECT * FROM fichier");
$requete->execute();
//une boucle foreach pour parcourir les enregistrements de la table "fichier" et afficher les informations de chaque fichier
echo "<table>";
echo "<thead><tr><th>Nom</th><th>Chemin</th><th>Date de téléchargement</th><th>Action</th></tr></thead>";
echo "<tbody>";
foreach($requete as $row) {
    echo "<tr>";
    echo "<td>" . $row['nom'] . "</td>";
    echo "<td>" . $row['chemin'] . "</td>";
    echo "<td>" . $row['date-telechargement'] . "</td>";
    echo "<td><a href='gestion_fichier.php?delete=".$row['id']."'>Supprimer</a></td>";

    // echo "<td><a href='uploader.php?delete=".$row['id']."'>Supprimer</a></td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
//ajout de la fonctionnalite supprimer un fichier
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $requete = $bdd->prepare("DELETE FROM fichier WHERE id=?");
    $requete->execute([$id]);
    //header('location: telechargement.php');
}
?>
