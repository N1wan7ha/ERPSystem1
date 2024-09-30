<?php
include 'config.php'; 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district = $_POST['district'];

    $sql = "UPDATE customer SET title = ?, first_name = ?, middle_name = ?, last_name = ?, contact_no = ?, district = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssi", $title, $first_name, $middle_name, $last_name, $contact_no, $district, $customer_id);

        if ($stmt->execute()) {
            echo "Customer updated successfully!";
        } else {
            echo "Error updating customer: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();

?>
