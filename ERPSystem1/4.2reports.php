<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>ERP System - Invoice Report</title>
</head>
<body>
    <div class="container-fluid bg-dark text-light py-3">
        <header class="text-center">
            <h1><a href="1main.php" class="text-light text-decoration-none">ERP System</a></h1>
        </header>

        <h2>Reports - Item Invoice</h2>
        <br>
        <form class="row g-3" id="invoiceReportForm">
            <!-- Date Range Selection -->
            <div class="col-md-6">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="startDate" required>
                <div class="invalid-feedback">
                    Please select a start date.
                </div>
            </div>

            <div class="col-md-6">
                <label for="endDate" class="form-label">End Date</label>
                <input type="date" class="form-control" id="endDate" required>
                <div class="invalid-feedback">
                    Please select an end date.
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <!-- Invoice Report Table -->
        <div class="container-fluid py-3">
            <h2>Invoice Report</h2>

            <table class="table table-striped mt-3 text-light">
                <thead>
                    <tr>
                        <th scope="col">Invoice Number</th>
                        <th scope="col">Invoiced Date</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Item Code</th>
                        <th scope="col">Item Category</th>
                        <th scope="col">Item Unit Price</th>
                    </tr>
                </thead>
                <tbody id="reportData">
                </tbody>
            </table>
        </div>

        <!-- JavaScript to handle form submission and display the results -->
        <script>
            document.getElementById('invoiceReportForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;

                if (new Date(startDate) > new Date(endDate)) {
                    alert('End Date must be after Start Date');
                    return;
                }

                // Send the date range to the backend to get the report
                fetch('4.2report_config.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ startDate, endDate })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data); // Log the returned data to see its structure
                    const reportData = document.getElementById('reportData');
                    reportData.innerHTML = ''; 

                    if (data.length > 0) {
                        data.forEach(row => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td>${row['Invoice Number']}</td>
                                <td>${row['Invoiced Date']}</td>
                                <td>${row['Customer Name']}</td>
                                <td>${row['Item Name']}</td>
                                <td>${row['Item Code']}</td>
                                <td>${row['Item Category']}</td>
                                <td>${row['Item Unit Price'] !== undefined ? row['Item Unit Price'] : 'N/A'}</td>
                            `;
                            reportData.appendChild(tr);
                        });
                    } else {
                        const tr = document.createElement('tr');
                        tr.innerHTML = '<td colspan="7" class="text-center">No invoices found for the selected date range</td>';
                        reportData.appendChild(tr);
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    alert('An error occurred while fetching data. Please try again.');
                });
            });
        </script>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl7TKY3IWO6QYhczDmxQz6bY3sI2bYHFAxZmt3j4I5lAgXRfbJIlp7T3iH5" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVQI2M4jzmsrIbJgIKntC5Q9mT5GyM5YpI61eaGFnJcZ59C1CPCIS7qBfElLG0C" crossorigin="anonymous"></script>
    </div>
</body>
</html>
