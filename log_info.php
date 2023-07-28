<?php
function logPlayerInfo() {
    $requestData = json_decode(file_get_contents('php://input'), true);
    $name = $requestData['name'];
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $currentTimeStamp = date("Y-m-d H:i:s");
    $logText = "$name:\nlast-ip: $ipAddress\nlast-online: $currentTimeStamp\n";

    // Read the current content of log.txt
    $logFile = 'log.txt';
    $currentLogContent = file_get_contents($logFile);

    // Check if an entry with the given name already exists
    $namePattern = "/^$name:\nlast-ip: (.*)\nlast-online: (.*)$/m";
    if (preg_match($namePattern, $currentLogContent, $matches)) {
        // If the entry exists, update the IP address and timestamp
        $oldIPAddress = $matches[1];
        $oldTimeStamp = $matches[2];
        $updatedLogText = str_replace("last-ip: $oldIPAddress", "last-ip: $ipAddress", $currentLogContent);
        $updatedLogText = str_replace("last-online: $oldTimeStamp", "last-online: $currentTimeStamp", $updatedLogText);
        file_put_contents($logFile, $updatedLogText);
    } else {
        // If the entry does not exist, add a new entry
        file_put_contents($logFile, $logText . PHP_EOL, FILE_APPEND);
    }
}

logPlayerInfo();
?>
