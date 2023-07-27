<?php
// Verzeichnispfad zum "content"-Ordner
$contentDirectory = 'content/';

// Array für die Dateiliste
$fileList = array();

// Öffne das Verzeichnis und lese die Dateien
if ($handle = opendir($contentDirectory)) {
  while (false !== ($entry = readdir($handle))) {
    // Überprüfe, ob es sich um eine Datei handelt (kein Verzeichnis)
    if (is_file($contentDirectory . $entry)) {
      // Füge den Dateinamen zur Liste hinzu
      $fileList[] = $entry;
    }
  }
  closedir($handle);
}

// Gib die Dateiliste als JSON zurück
echo json_encode($fileList);
?>
