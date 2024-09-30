<?php
include 'config.php'; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id']; 
    $item_code = $_POST['item_code']; 
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    $sql = "UPDATE item SET item_code = ?, item_name = ?, item_category = ?, item_subcategory = ?, quantity = ?, unit_price = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssii", $item_code, $item_name, $item_category, $item_subcategory, $quantity, $unit_price, $item_id);

        if ($stmt->execute()) {
            echo "Item updated successfully!";
        } else {
            echo "Error updating item: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
header("Location: 3item.php");
exit();
?>
