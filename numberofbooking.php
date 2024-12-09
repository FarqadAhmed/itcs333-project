<?php
//the number of bookings per room
$query_room_usage = "SELECT room_id, COUNT(*) as booking_count FROM bookings WHERE booking_date >= CURDATE() GROUP BY room_id";
$result_room_usage = $db->query($query_room_usage);
$roomUsageStats = [];
if ($result_room_usage->num_rows > 0) {
    while ($row = $result_room_usage->fetch_assoc()) {
        $roomUsageStats[] = $row;
    }
}