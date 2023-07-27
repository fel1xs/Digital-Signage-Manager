<?php
// Verzeichnispfad zum "content"-Ordner
$contentDirectory = 'content/';

if (isset($_FILES['file'])) {
  $file = $_FILES['file'];
  $filename = $contentDirectory . basename($file['name']);

  // Überprüfe, ob die Datei gültig ist und verschiebe sie in den "content"-Ordner
  if (move_uploaded_file($file['tmp_name'], $filename)) {
    // Erfolgreich hochgeladen
    echo json_encode(array('status' => 'success', 'message' => 'Datei erfolgreich hochgeladen.'));
  } else {
    // Fehler beim Hochladen
    echo json_encode(array('status' => 'error', 'message' => 'Fehler beim Hochladen der Datei.'));
  }
} else {
  // Keine Datei gefunden
  echo json_encode(array('status' => 'error', 'message' => 'Keine Datei gefunden.'));
}
?>
