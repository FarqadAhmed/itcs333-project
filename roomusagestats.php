<?php
require 'connection 1.php';
// Combine room usage stats with equipment information
$roomStatsWithEquipment = []; 
foreach ($roomUsageStats as $usage) {
    $roomStatsWithEquipment[$usage['room_id']] = [
        'booking_count'=> $usage['booking_count'],
        'equipment' => isset($roomEquipment[$usage['room_id']]) ? $roomEquipment[$usage['room_id']] : 'No equipment listed',
    ];
}?>