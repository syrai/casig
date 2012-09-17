<?php
if(isset($_FILES) && is_array($_FILES)) {
// Nombre de fichiers envoyés
$nb = count($_FILES['f']['name']);
echo $nb;
// Chemin destination (répertoire courant + /upload/)
$dir = realpath('.').'/test/';
if($nb>0) {
for($i=0;$i<$nb;$i++) {
echo '<p>Fichier : '.$_FILES['f']['name'][$i];
echo '<br>Taille : '.$_FILES['f']['size'][$i];
echo '<br>Type : '.$_FILES['f']['type'][$i];
// Copie depuis le répertoire temporaire
$copie =
move_uploaded_file($_FILES['f']['tmp_name'][$i],
$uploaddir.$_FILES['f']['name'][$i]);
if($copie) echo '<br><b>Fichier copié</b></p>'; else echo
'<br><b>Erreur de copie</b></p>';
}
} else {
echo 'Aucun fichier envoyé';
}
}
?>