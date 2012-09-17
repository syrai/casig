<?php
if(isset($_FILES) && is_array($_FILES)) {
// Nombre de fichiers envoyés
$nb = count($_FILES['fichiers']['name']);
echo $nb;
// Chemin destination (répertoire courant + /upload/)
$dir = realpath('.').'/test/';
if($nb>0) {
for($i=0;$i<$nb;$i++) {
echo '<p>Fichier : '.$_FILES['fichiers']['name'][$i];
echo '<br>Taille : '.$_FILES['fichiers']['size'][$i];
echo '<br>Type : '.$_FILES['fichiers']['type'][$i];
// Copie depuis le répertoire temporaire
$copie =
move_uploaded_file($_FILES['fichiers']['tmp_name'][$i],
$uploaddir.$_FILES['fichiers']['name'][$i]);
if($copie) echo '<br><b>Fichier copié</b></p>'; else echo
'<br><b>Erreur de copie</b></p>';
}
} else {
echo 'Aucun fichier envoyé';
}
}
?>