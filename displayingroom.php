<?php
require 'connection 1.php';
// Example of displaying room usage stats in a table
echo "<h2>Room Usage Statistics</h2>";
echo "<table border='1'>";
echo "<tr><th>Room ID</th><th>Booking Count</th><th>Equipment</th></tr>";
foreach ($roomStatsWithEquipment as $room_id => $stats) {
    echo "<tr><td>$room_id</td><td>" . $stats['booking_count'] . "</td><td>" . $stats['equipment'] . "</td></tr>";
}
echo "</table>";
?>