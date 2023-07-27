<?php
// Verzeichnispfad zum "content"-Ordner
$contentDirectory = 'content/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);
    $filename = $requestData['filename'];

    // Überprüfe, ob die Datei existiert
    if (file_exists($contentDirectory . $filename)) {
        // Datei löschen
        unlink($contentDirectory . $filename);

        // Remove the filename from the file_order.txt file
        $fileOrder = file_get_contents('file_order.txt');
        $fileOrderLines = explode("\n", $fileOrder);
        $updatedOrderLines = array();
        foreach ($fileOrderLines as $orderLine) {
            if (trim($orderLine) !== $filename) {
                $updatedOrderLines[] = $orderLine;
            }
        }
        $updatedFileOrder = implode("\n", $updatedOrderLines);
        file_put_contents('file_order.txt', $updatedFileOrder);

        // Erfolgreich gelöscht
        echo json_encode(array('status' => 'success', 'message' => 'Datei erfolgreich gelöscht und aus der Reihenfolge entfernt.'));
    } else {
        // Datei existiert nicht
        echo json_encode(array('status' => 'error', 'message' => 'Die Datei existiert nicht.'));
    }
} else {
    // Ungültige Anfrage
    echo json_encode(array('status' => 'error', 'message' => 'Ungültige Anfrage.'));
}
?>
