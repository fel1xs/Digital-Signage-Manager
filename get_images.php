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
            $imageUrls[] = $entry;
        }
    }
    closedir($handle);

    // Sortiere die Bild-URLs nach Zahlen im Dateinamen
    usort($imageUrls, function($a, $b) {
        $numberA = intval(pathinfo($a, PATHINFO_FILENAME));
        $numberB = intval(pathinfo($b, PATHINFO_FILENAME));
        return $numberA - $numberB;
    });
}

// Gib die Bild-URLs als Textzeilen zurück
echo implode("\n", $imageUrls);
?>
