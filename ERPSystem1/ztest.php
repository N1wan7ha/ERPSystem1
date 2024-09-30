<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice List</title>
</head>
<body>
    <h1>View Invoices</h1>
    <p>Click the button below to fetch and display the invoices:</p>
    <button onclick="window.location.href='4.2report_config.php';">Show Invoices</button>
</body>
</html>




<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ERPSystem1';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$startDate = '2021-01-31';
$endDate = '2022-04-01';

$sql = "
SELECT 
    i.invoice_no AS 'Invoice Number', 
    i.date AS 'Invoiced Date', 
    CONCAT(c.first_name, ' ', c.last_name) AS 'Customer Name', 
    it.item_name AS 'Item Name', 
    it.item_code AS 'Item Code', 
    ic.category AS 'Item Category', 
    it.unit_price AS 'Unit Price' 
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Report</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Invoice Report</h1>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Invoiced Date</th>
                    <th>Customer Name</th>
                    <th>Item Name</th>
                    <th>Item Code</th>
                    <th>Item Category</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Invoice Number']; ?></td>
                        <td><?php echo $row['Invoiced Date']; ?></td>
                        <td><?php echo $row['Customer Name']; ?></td>
                        <td><?php echo $row['Item Name']; ?></td>
                        <td><?php echo $row['Item Code']; ?></td>
                        <td><?php echo $row['Item Category']; ?></td>
                        <td><?php echo $row['Unit Price']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No results found for the specified date range.</p>
    <?php endif; ?>

    <?php 
    $result->free();
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
