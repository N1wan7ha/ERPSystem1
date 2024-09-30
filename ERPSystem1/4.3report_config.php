<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ERPSystem1';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
SELECT DISTINCT 
    i.item_name AS 'Item Name', 
    ic.category AS 'Item Category', 
    isub.sub_category AS 'Item Subcategory', 
    i.quantity AS 'Item Quantity' 
FROM 
    item i 
JOIN 
    item_category ic ON i.item_category = ic.id 
JOIN 
    item_subcategory isub ON i.item_subcategory = isub.id 
ORDER BY 
    i.item_name;";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);

$result->free();
$stmt->close();

$conn->close();
?>
