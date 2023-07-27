<?php
// Verzeichnispfad zum "content"-Ordner
$contentDirectory = 'content/';

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filename = basename($file['name']);
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Überprüfe, ob die Datei eine gültige Bilddatei ist (z. B. mit Endungen .png, .jpg, .jpeg, etc.)
    $imageExtensions = array('png', 'jpg', 'jpeg', 'gif');
    if (in_array($extension, $imageExtensions)) {
        // Verschiebe die hochgeladene Datei in den "content"-Ordner
        if (move_uploaded_file($file['tmp_name'], $contentDirectory . $filename)) {
            // Erfolgreich hochgeladen

            // Update file_order.txt with the new filename at the end of the order
            $fileOrder = file_get_contents('file_order.txt');
            $fileOrder .= "\n" . $filename;
            file_put_contents('file_order.txt', $fileOrder);

            echo json_encode(array('status' => 'success', 'message' => 'Datei erfolgreich hochgeladen.'));
        } else {
            // Fehler beim Hochladen
            echo json_encode(array('status' => 'error', 'message' => 'Fehler beim Hochladen der Datei.'));
        }
    } else {
        // Ungültiges Dateiformat
        echo json_encode(array('status' => 'error', 'message' => 'Ungültiges Dateiformat. Erlaubte Formate: ' . implode(', ', $imageExtensions)));
    }
} else {
    // Keine Datei gefunden
    echo json_encode(array('status' => 'error', 'message' => 'Keine Datei gefunden.'));
}
?>
