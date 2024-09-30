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

        <h2>Report - Invoice Item</h2>
        <br>

        <form class="row g-3" id="itemReportForm">
            <h2>Item Report</h2>
            <div class="col-12">
                <table class="table table-bordered mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Category</th>
                            <th scope="col">Item Subcategory</th>
                            <th scope="col">Item Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="itemReportData">
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <script>
        // JavaScript to fetch and display report data
        async function fetchItemReport() {
            const response = await fetch('4.3report_config.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    // Optionally add any filters here
                }),
            });
            const data = await response.json();
            const tableBody = document.getElementById('itemReportData');
            tableBody.innerHTML = ''; 

            data.forEach(item => {
                const row = `<tr>
                    <td>${item['Item Name']}</td>
                    <td>${item['Item Category']}</td>
                    <td>${item['Item Subcategory']}</td>
                    <td>${item['Item Quantity']}</td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        }

        window.onload = fetchItemReport;
    </script>
</body>
</html>
