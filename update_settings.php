<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);
    $settings = array(
        'duration' => isset($requestData['duration']) ? intval($requestData['duration']) : 0,
        'start_time' => isset($requestData['start_time']) ? sanitizeTime($requestData['start_time']) : '00:00',
        'end_time' => isset($requestData['end_time']) ? sanitizeTime($requestData['end_time']) : '23:59'
    );

    // Validate the settings data here (e.g., check if 'duration' is a positive integer,
    // and 'start_time' and 'end_time' are valid time formats HH:mm).

    // Save the settings to the "settings.txt" file
    $settingsContent = "duration: " . $settings['duration'] . "\n";
    $settingsContent .= "start_time: " . $settings['start_time'] . "\n";
    $settingsContent .= "end_time: " . $settings['end_time'] . "\n";

    // The "settings.txt" file path
    $settingsFilePath = 'settings.txt';

    // Write the settings to the file
    file_put_contents($settingsFilePath, $settingsContent);

    // Send a response indicating success
    echo json_encode(array('status' => 'success', 'message' => 'Einstellungen erfolgreich aktualisiert.'));
} else {
    // Invalid request method
    echo json_encode(array('status' => 'error', 'message' => 'Ungültige Anfrage.'));
}

// Helper function to sanitize time input
function sanitizeTime($time) {
    // Regular expression to match HH:mm format
    $pattern = '/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/';
    if (preg_match($pattern, $time)) {
        return $time;
    }
    // Return a default value if input is invalid
    return '00:00';
}
?>
