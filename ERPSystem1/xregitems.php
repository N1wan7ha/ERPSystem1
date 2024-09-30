<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect('localhost', 'root', '', 'ERPSystem1') or die("Connection failed: " . mysqli_connect_error());

    if (isset($_POST['item_code'], $_POST['item_name'], $_POST['item_category'], 
                $_POST['item_subcategory'], $_POST['quantity'], $_POST['unit_price'])) {
        
        $item_code = mysqli_real_escape_string($conn, $_POST['item_code']);
        $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
        $item_category = mysqli_real_escape_string($conn, $_POST['item_category']);
        $item_subcategory = mysqli_real_escape_string($conn, $_POST['item_subcategory']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $unit_price = mysqli_real_escape_string($conn, $_POST['unit_price']);

        $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price) 
                VALUES ('$item_code', '$item_name', '$item_category', '$item_subcategory', '$quantity', '$unit_price')";

        if (mysqli_query($conn, $sql)) {
            echo 'Item registered successfully';
        } else {
            echo 'Item registration failed: ' . mysqli_error($conn);
        }
    } else {
        echo 'Please fill in all required fields.';
    }

    mysqli_close($conn);

    echo '<pre>';
print_r($_POST);
echo '</pre>';

header("Location: 3item.php");
exit();

}
?>
