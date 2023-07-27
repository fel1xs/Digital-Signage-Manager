<?php
// Verzeichnispfad zum "content"-Ordner
$contentDirectory = 'content/';

// Array für die Bild-URLs
$imageUrls = array();

// Öffne das Verzeichnis und lese die Dateien
if ($handle = opendir($contentDirectory)) {
  while (false !== ($entry = readdir($handle))) {
    // Überprüfe, ob die Datei eine Bilddatei ist (z. B. mit Endungen .png, .jpg, .jpeg, etc.)
    $imageExtensions = array('png', 'jpg', 'jpeg', 'gif');
    $extension = strtolower(pathinfo($entry, PATHINFO_EXTENSION));
    if (in_array($extension, $imageExtensions)) {
      // Füge die Bild-URL zur Liste hinzu
      $imageUrls[] = $contentDirectory . $entry;
    }
  }
  closedir($handle);

  // Sortiere die Bild-URLs alphabetisch
  sort($imageUrls, SORT_STRING);
}

// Gib die Bild-URLs als Textzeilen zurück
echo implode("\n", $imageUrls);
?>
