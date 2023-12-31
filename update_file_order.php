<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);
    $newOrder = $requestData['order'];

    // Save the new order to a file
    $orderFile = 'file_order.txt';
    file_put_contents($orderFile, implode("\n", $newOrder));

    // Successfully updated
    echo json_encode(array('status' => 'success', 'message' => 'Dateireihenfolge erfolgreich aktualisiert.'));
} else {
    // Invalid request
    echo json_encode(array('status' => 'error', 'message' => 'Ungültige Anfrage.'));
}
?>
