<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $conn = mysqli_connect('localhost', 'root', '', 'ERPSystem1') or die("Connection failed: " . mysqli_connect_error());

    if (!empty($_POST['title']) && !empty($_POST['first_name']) && !empty($_POST['middle_name']) && !empty($_POST['last_name']) 
    && !empty($_POST['contact_no']) && !empty($_POST['district'])) {
        
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $contact_number = mysqli_real_escape_string($conn, $_POST['contact_no']); // Updated line
        $district = mysqli_real_escape_string($conn, $_POST['district']);

        // SQL query to insert data
        $sql = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district) 
                VALUES ('$title', '$first_name', '$middle_name', '$last_name', '$contact_number', '$district')";

        if (mysqli_query($conn, $sql)) {
            echo 'Registered successfully';
        } else {
            echo 'Registration failed: ' . mysqli_error($conn);
        }
    } else {
        echo 'Please fill in all required fields.';
    }

    mysqli_close($conn);

    header("Location: 2.1customer.php");
    exit();
}
?>
