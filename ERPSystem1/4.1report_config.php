<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost'; 
$dbname = 'ERPSystem1'; 
$username = 'root';
$password = ''; 
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$startDate = $data['startDate'];
$endDate = $data['endDate'];

$sql = "
    SELECT i.invoice_no AS 'Invoice Number', 
           i.date AS 'Date', 
           CONCAT(c.first_name, ' ', c.last_name) AS 'Customer', 
           d.district AS 'Customer District', 
           i.item_count AS 'Item Count', 
           i.amount AS 'Invoice Amount'
    FROM invoice i
    JOIN customer c ON i.customer = c.id
    JOIN district d ON c.district = d.id
    WHERE i.date BETWEEN ? AND ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $startDate, $endDate);

$stmt->execute();
$result = $stmt->get_result();

$invoices = [];
while ($row = $result->fetch_assoc()) {
    $invoices[] = $row;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($invoices);
?>
