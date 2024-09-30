<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php'; 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    // Debugging output
    echo "Attempting to delete customer with ID: " . htmlspecialchars($customer_id) . "<br>";

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("DELETE FROM customer WHERE id = ?");
    
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit();
    }

    $stmt->bind_param("i", $customer_id);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['message'] = "Customer deleted successfully.";
    } else {
        session_start();
        $_SESSION['message'] = "Error deleting customer: " . $stmt->error;
    }

    $stmt->close();
} else {
    session_start();
    $_SESSION['message'] = "Invalid request. Please ensure the customer ID is set.";
}

$conn->close();

header("Location: 2.1customer.php");
exit();
?>
