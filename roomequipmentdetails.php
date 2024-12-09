<?php
// room equipment details
$query_room_equipment = "SELECT room_id, equipment FROM rooms";
$result_room_equipment = $db->query($query_room_equipment);
$roomEquipment = [];
if ($result_room_equipment->num_rows > 0) {
    while ($row = $result_room_equipment->fetch_assoc()) {
        $roomEquipment[$row['room_id']] = $row['equipment'];
    }
}
?>