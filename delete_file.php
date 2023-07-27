<?php
// Verzeichnispfad zum "content"-Ordner
$contentDirectory = 'content/';

// Lese den Dateinamen von der POST-Anfrage
$data = json_decode(file_get_contents('php://input'), true);
$filename = $contentDirectory . $data['filename'];

// Überprüfe, ob die Datei existiert und lösche sie
if (file_exists($filename) && is_file($filename)) {
  if (unlink($filename)) {
    // Erfolgreich gelöscht
    echo json_encode(array('status' => 'success', 'message' => 'Datei erfolgreich gelöscht.'));
  } else {
    // Fehler beim Löschen
    echo json_encode(array('status' => 'error', 'message' => 'Fehler beim Löschen der Datei.'));
  }
} else {
  // Datei nicht gefunden
  echo json_encode(array('status' => 'error', 'message' => 'Datei nicht gefunden.'));
}
?>
