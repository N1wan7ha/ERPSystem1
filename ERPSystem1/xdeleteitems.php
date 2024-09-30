<?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];

    if (!empty($item_id)) {
        $stmt = $conn->prepare("DELETE FROM item WHERE id = ?");
        $stmt->bind_param("i", $item_id); 
        if ($stmt->execute()) {
            echo "Item deleted successfully.";
        } else {
            echo "Error deleting item: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Item ID is required.";
    }
}

$conn->close();

header("Location: 3item.php");
exit();

?>
