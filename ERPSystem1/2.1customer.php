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
</head>
<body>
    <div class="container-fluid bg-dark text-light py-3">
        <header class="text-center">
            <h1><a href="1main.php" class="text-light text-decoration-none">ERP System</a></h1>
        </header>
        <br>
        <h2>Customer - Register</h2>
    </div>
    
    <form action="zaddcustomer.php" method="POST" class="row g-4 container-fluid bg-dark text-light py-5" id="customerForm">
        <div class="col-md-6">
            <label for="title" class="form-label">Title</label>
            <select id="title" name="title" class="form-select" required>
                <option selected disabled value="">Choose...</option>
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Miss">Miss</option>
                <option value="Dr">Dr</option>
            </select>
            <div class="invalid-feedback">Please select a title.</div>
        </div>
        
        <div class="col-md-6">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" name="first_name" required>
            <div class="invalid-feedback">Please enter your first name.</div>
        </div>

        <div class="col-md-6">
            <label for="middleName" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middleName" name="middle_name" required>
            <div class="invalid-feedback">Please enter your middle name.</div>
        </div>
    
        <div class="col-md-6">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="last_name" required>
            <div class="invalid-feedback">Please enter your last name.</div>
        </div>
    
        <div class="col-md-6">
            <label for="contactNumber" class="form-label">Contact Number</label>
            <input type="tel" class="form-control" id="contactNumber" name="contact_no" pattern="[0-9]{10}" required>
            <div class="invalid-feedback">Please enter a valid contact number (10 digits).</div>
        </div>
        
        <div class="col-md-6">
            <label for="district" class="form-label">District</label>
            <select id="district" name="district" class="form-select" required>
                <option selected disabled value="">Choose...</option>
                
                <option value="1">Ampara</option>
                <option value="2">Anuradhapura</option>
                <option value="3">Badulla</option>
                <option value="4">Batticaloa</option>
                <option value="5">Colombo</option>
                <option value="6">Galle</option>
                <option value="7">Gampaha</option>
                <option value="8">Hambantota</option>
                <option value="9">Jaffna</option>
                <option value="10">Kalutara</option>
                <option value="11">Kandy</option>
                <option value="12">Kegalle</option>
                <option value="13">Kilinochchi</option>
                <option value="14">Kurunegala</option>
                <option value="15">Mannar</option>
                <option value="16">Matale</option>
                <option value="17">Matara</option>
                <option value="18">Moneragala</option>
                <option value="19">Mullaitivu</option>
                <option value="20">Nuwara Eliya</option>
                <option value="21">Polonnaruwa</option>
                <option value="22">Puttalam</option>
                <option value="23">Rathnapura</option>
                <option value="24">Vavuniya</option>
                <option value="25">Trincomalee</option>
            </select>
            <div class="invalid-feedback">Please select a district.</div>
        </div>

        <div class="col-12 d-flex justify-content-center">
    <button type="submit" name="submit" class="btn btn-primary me-2">Register</button>
    <button type="button" class="btn btn-primary me-2" id="updateButton" onclick="updateCustomer()">Update</button>
    <button type="button" class="btn btn-primary " onclick="deleteCustomer()">Delete</button>
</div>

    </form>

    <!-- Reg Customers-->
    <div class="row g-4 container-fluid bg-dark py-5" id="reg_customer">
        <div class="card">
            <div class="card container-fluid bg-dark text-white">
                <h4>Registered Customer List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Middle Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">District</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'zcustomer.php'; 

                           
                            if ($result->num_rows > 0) {
                             
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr onclick='fillForm(" . json_encode($row) . ")'>";
                                    echo "<td>" . (!empty($row['id']) ? $row['id'] : '-') . "</td>";
                                    echo "<td>" . (!empty($row['title']) ? $row['title'] : '-') . "</td>";
                                    echo "<td>" . (!empty($row['first_name']) ? $row['first_name'] : '-') . "</td>";
                                    echo "<td>" . (!empty($row['middle_name']) ? $row['middle_name'] : '-') . "</td>";
                                    echo "<td>" . (!empty($row['last_name']) ? $row['last_name'] : '-') . "</td>";
                                    echo "<td>" . (!empty($row['contact_no']) ? $row['contact_no'] : '-') . "</td>";
                                    echo "<td>" . (!empty($row['district']) ? $row['district'] : '-') . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                           
                                echo "<tr><td colspan='7'>No registered customers found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        let customerId = null; 

        function deleteCustomer() {
            if (customerId === null) {
                alert("Please select a customer to delete.");
                return;
            }

            if (confirm("Are you sure you want to delete customer ID: " + customerId + "?")) {
                const form = document.createElement("form");
                form.method = "POST";
                form.action = "zdeletecustomer.php";

                const input = document.createElement("input");
                input.type = "hidden";
                input.name = "customer_id";
                input.value = customerId;
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            }
        }

        function updateCustomer() {
   
    if (!document.getElementById("customerForm").checkValidity()) {
        alert("Please fill out the form correctly before updating.");
        return;
    }

    const formData = new FormData(document.getElementById("customerForm"));
    formData.append("customer_id", customerId); 
    fetch("zupdatecustomer.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); 
        location.reload();  
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

function fetchCustomerList() {
    fetch("zcustomer.php") 
        .then(response => response.text())
        .then(data => {
            document.querySelector("#reg_customer .table-responsive tbody").innerHTML = data;
        })
        .catch(error => console.error("Error fetching customer list:", error));
}


        function fillForm(customerData) {
            document.getElementById("title").value = customerData.title;
            document.getElementById("firstName").value = customerData.first_name;
            document.getElementById("middleName").value = customerData.middle_name;
            document.getElementById("lastName").value = customerData.last_name;
            document.getElementById("contactNumber").value = customerData.contact_no;
            document.getElementById("district").value = customerData.district;

            customerId = customerData.id;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybZgAkZ+6I8x8wO+U5BcE8moG+rK6O4Y+P4yY1hoDgf69N7kd" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-44y4cqgRqP8phk67nZg5o6FcHhH4M2y3g2GkpHykhPEooWxOZ2WvB+wxE3dH4Djp" crossorigin="anonymous"></script>
</body>
</html>
