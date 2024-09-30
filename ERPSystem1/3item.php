<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Web_Reg</title>

    <script>
        function fillForm(item) {
            document.getElementsByName('item_code')[0].value = item.item_code;
            document.getElementsByName('item_name')[0].value = item.item_name;
            document.getElementById('item_category').value = item.item_category;
            document.getElementById('item_subcategory').value = item.item_subcategory; 
            document.getElementsByName('quantity')[0].value = item.quantity;
            document.getElementsByName('unit_price')[0].value = item.unit_price;

            document.getElementsByName('item_id')[0].value = item.id; // Assuming the ID is stored in 'id' key
        }

        function deleteItem() {
            const itemId = document.getElementsByName('item_id')[0].value;
            if (itemId) {
                document.getElementById('deleteItemForm').item_id.value = itemId; 
                document.getElementById('deleteItemForm').submit(); 
            } else {
                alert("Please select an item to delete.");
            }
        }
    </script>
</head>
<body>
    <div class="container-fluid bg-dark text-light py-3">
        <header class="text-center">
            <h1><a href="1main.php" class="text-light text-decoration-none">ERP System</a></h1>
        </header>
<br>
        <h2>Items - Register</h2>
        <form action="xregitems.php" method="POST" class="row g-4 container-fluid bg-dark text-light py-5" id="ItemForm">
            <input type="hidden" name="item_id" value=""> 

            <div class="form-group col-md-6">
    <label for="item_code" class="form-label">Item Code:</label>
    <select id="item_code" name="item_code" class="form-select" required>
        <option selected disabled value="">Choose...</option>
        <option value="JK007" data-name="HP Laser printer">JK007</option>
        <option value="CS6656" data-name="Lenovo Ideapad 300">CS6656</option>
        <option value="KL9956" data-name="Samsung touch display">KL9956</option>
        <option value="HH7565" data-name="Colour ink">HH7565</option>
        <option value="SM3534" data-name="Dell latitude">SM3534</option>
        <option value="KM6526" data-name="Samsung headset">KM6526</option>
    </select>
</div>

<div class="form-group col-md-6">
    <label for="item_name" class="form-label">Item Name:</label>
    <select id="item_name" name="item_name" class="form-select" required>
        <option selected disabled value="">Choose...</option>
        <option value="HP Laser printer" data-code="JK007">HP Laser printer</option>
        <option value="Lenovo Ideapad 300" data-code="CS6656">Lenovo Ideapad 300</option>
        <option value="Samsung touch display" data-code="KL9956">Samsung touch display</option>
        <option value="Colour ink" data-code="HH7565">Colour ink</option>
        <option value="Dell latitude" data-code="SM3534">Dell latitude</option>
        <option value="Samsung headset" data-code="KM6526">Samsung headset</option>
    </select>
</div>
<script>
    document.getElementById('item_code').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var itemName = selectedOption.getAttribute('data-name'); 
        document.getElementById('item_name').value = itemName; 
    });

    document.getElementById('item_name').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var itemCode = selectedOption.getAttribute('data-code'); 
        document.getElementById('item_code').value = itemCode; 
    });
</script>


            <div class="form-group col-md-6">
                <label for="item_category" class="form-label">Item Category:</label>
                <select id="item_category" name="item_category" class="form-select" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="1">Printers</option>
                    <option value="2">Laptops</option>
                    <option value="3">Gadgets</option>
                    <option value="4">Ink Bottles</option>
                    <option value="5">Cartridges</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="item_subcategory" class="form-label">Item Subcategory:</label>
                <select id="item_subcategory" name="item_subcategory" class="form-select" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="1">HP</option>
                    <option value="2">Dell</option>
                    <option value="3">Lenovo</option>
                    <option value="4">Acer</option>
                    <option value="5">Samsung</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="unit_price">Unit Price:</label>
                <input type="text" name="unit_price" class="form-control" required>
            </div>
            <br>
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary me-2">Register Item</button>
                <button type="submit" formaction="xupdateitems.php" class="btn btn-primary me-2">Update Item</button>
                <button type="button" class="btn btn-primary" onclick="deleteItem();">Delete Item</button>
            </div>
        </form>

        <form id="deleteItemForm" action="xdeleteitems.php" method="POST" style="display: none;">
            <input type="hidden" name="item_id" value="">
        </form>

        <!-- Regitem  -->
        <div class="row g-4 container-fluid bg-dark py-5" id="reg_item">
            <div class="card">
                <div class="card container-fluid bg-dark text-white">
                    <h4>Item List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Item Code</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Item Category</th>
                                    <th scope="col">Item Subcategory</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Unit Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'xitems.php'; 

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr onclick='fillForm(" . json_encode($row) . ")'>";
                                        echo "<td>" . (!empty($row['item_code']) ? $row['item_code'] : '-') . "</td>";
                                        echo "<td>" . (!empty($row['item_name']) ? $row['item_name'] : '-') . "</td>";
                                        echo "<td>" . (!empty($row['item_category']) ? $row['item_category'] : '-') . "</td>";
                                        echo "<td>" . (!empty($row['item_subcategory']) ? $row['item_subcategory'] : '-') . "</td>";
                                        echo "<td>" . (!empty($row['quantity']) ? $row['quantity'] : '-') . "</td>";
                                        echo "<td>" . (!empty($row['unit_price']) ? $row['unit_price'] : '-') . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No items found.</td></tr>";
                                }
                                ?>Sithumal
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
