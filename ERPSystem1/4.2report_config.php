<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ERPSystem1';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $startDate = $data['startDate'];
    $endDate = $data['endDate'];

    $sql = "
    SELECT 
        i.invoice_no AS 'Invoice Number', 
        i.date AS 'Invoiced Date', 
        CONCAT(c.first_name, ' ', c.last_name) AS 'Customer Name', 
        it.item_name AS 'Item Name', 
        it.item_code AS 'Item Code', 
        ic.category AS 'Item Category', 
        it.unit_price AS 'Item Unit Price'  -- Changed this line to match the HTML
    FROM 
        invoice i 
    JOIN 
        customer c ON i.customer = c.id 
    JOIN 
        invoice_master im ON i.invoice_no = im.invoice_no 
    JOIN 
        item it ON im.item_id = it.id 
    JOIN 
        item_category ic ON it.item_category = ic.id 
    WHERE 
        DATE(i.date) BETWEEN ? AND ?;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $startDate, $endDate);
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
}

$conn->close();
?>
