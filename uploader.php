<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'upload de fichiers</title>
</head>
<body>
    <form action="gestion_fichier.php" method="post" enctype="multipart/form-data">
        <h2>Upload Fichier</h2>
        <label for="fileUpload">Fichier:</label>
        <input type="file" name="photo" id="fileUpload">
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .jpeg, .gif, .png sont autorisés jusqu'à une taille maximale de 10 Mo.</p>
    </form>
</body>
</html>
<?php
$targetDir = "upload/";

// Vérifie si le répertoire d'upload existe, sinon le crée
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true); // 0755 donne les permissions nécessaires pour le répertoire
}

// include 'connexion_base.php';
// // Connexion à la base de données
// $base = new database('localhost', 'root', 'root','gestionnaire-fichier');
// $bdd = $base->connect();
// // Définir le chemin du répertoire de téléchargement
// $targetDir = "upload/";
// $nomFichier = $cheminDestination = $dateTelechargement = "";


// Vérifie si le formulaire a été soumis
// if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
//     if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
//         $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
//         $filename = $_FILES["photo"]["name"];
//         $filetype = $_FILES["photo"]["type"];
//         $filesize = $_FILES["photo"]["size"];

//         // Vérifie l'extension du fichier
//         $ext = pathinfo($filename, PATHINFO_EXTENSION);
//         if(!array_key_exists($ext, $allowed)){
//             die("Erreur : Veuillez sélectionner un format de fichier valide.");

//         } 
//         // Vérifie la taille du fichier - 5Mo maximum
//         $maxsize = 0 * 1024 * 1024;
//         if($filesize > $maxsize) {
//             die("Error: La taille du fichier est supérieure à la limite autorisée.");
//         } 
        // Vérifie le type MIME du fichier
        // if(in_array($filetype, $allowed)){
        //     // Vérifie si le fichier existe avant de le télécharger.
        //     if(file_exists("upload/" . $_FILES["photo"]["name"])){
        //         echo $_FILES["photo"]["name"] . " existe déjà.";
        //     } 
        //     else{
        //         move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]);
        //         echo "Votre fichier a été téléchargé avec succès.";
        //         $nomFichier = $_FILES["photo"]["name"];
        //         $cheminDestination = "upload/" . $_FILES["photo"]["name"];
        //         $dateTelechargement = date("Y-m-d H:i:s"); // Utilisez la date actuelle pour la date de téléchargement
              
        //         // Insérer les informations du fichier dans la base de données
        //         $requete = $bdd->prepare("INSERT INTO fichier (nom, chemin, date-telechargement) VALUES (?, ?, NOW())");
        //         $requete->execute([$nomFichier, $cheminDestination, $dateTelechargement]);
        //         // header("location: gestion_fichier.php");
        //         var_dump($nomFichier, $cheminDestination, $dateTelechargement);
        //     } 
        // } 
//         else{
//             echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
//         }
//     }
//     else{
//         echo "Error: " . $_FILES["photo"]["error"];
//         var_dump($_FILES["photo"]["error"]);
//     }


// }
?>