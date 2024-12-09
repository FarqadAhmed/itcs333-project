<?php
// For Example the time range for the report 
$startDate = '2024-12-01';
$endDate = '2024-12-31';

// room popularity stats based on a given period
$query_room_popularity = "SELECT room_id, COUNT(*) as booking_count FROM bookings WHERE booking_date BETWEEN '$startDate' AND '$endDate' GROUP BY room_id";
$result_room_popularity = $db->query($query_room_popularity);
$roomPopularityStats = [];
if ($result_room_popularity->num_rows > 0) {
    while ($row = $result_room_popularity->fetch_assoc()) {
        $roomPopularityStats[] = $row;
    }
}
?>