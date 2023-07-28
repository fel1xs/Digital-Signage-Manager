<?php
// Directory path to the "content" folder
$contentDirectory = 'content/';

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filename = basename($file['name']);
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Check if the file is a valid image file (e.g. with extensions .png, .jpg, .jpeg, etc.)
    $imageExtensions = array('png', 'jpg', 'jpeg', 'gif');
    if (in_array($extension, $imageExtensions)) {
        // Move the uploaded file to the "content" folder
        if (move_uploaded_file($file['tmp_name'], $contentDirectory . $filename)) {
            // Update file_order.txt with the new filename at the end of the order
            $fileOrder = file_get_contents('file_order.txt');
            $fileOrder .= "\n" . $filename;
            file_put_contents('file_order.txt', $fileOrder);

            echo json_encode(array('status' => 'success', 'message' => 'Datei erfolgreich hochgeladen.'));
        } else {
            // Upload error
            echo json_encode(array('status' => 'error', 'message' => 'Fehler beim Hochladen der Datei.'));
        }
    } else {
        // Invalid file format
        echo json_encode(array('status' => 'error', 'message' => 'Ungültiges Dateiformat. Erlaubte Formate: ' . implode(', ', $imageExtensions)));
    }
} else {
    // No file found
    echo json_encode(array('status' => 'error', 'message' => 'Keine Datei gefunden.'));
}
?>
