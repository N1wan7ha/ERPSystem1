ERP System

Overview
As for the functionalities of this ERP system, users are able to input and process customer and item information, as well as retrieve usable reports from the system, whilst the CRUD (Create, Read, Update, Delete) operations included the following. To enhance the front end, Bootstrap, CSS, and JavaScript are major frameworks used to sustain the front end.

Assumptions
    • Database Setup: Creation of the database is done using MYSQL and there is an SQL file that contains table definitions of a database.
    • Environment: The application is designed to be running on the top of local server environment like XAMMP, WAMP or other.
    • Validation: There is form validation for data validation purposes in the current project.

System Features
    • Customer Management:
        1. Register customers with fields: Title,First Name,Last Name,Phone Number,District.
        2. Used to access and monitor customer information.

    • Item Management:
        1. Register items with fields: There are five fields for Item Table, They are Item Code, Item Name, Item Category, Item Subcategory, Quantity, Unit Price.
        2. View and manage item records.

    • Reports:

        1. Invoice Report: Invoices should be generated from a to date with the to date specified.
        2. Invoice Item Report: The ledgers showing particular invoiced items on a period of time.
        3. Item Report: Summary of items by name, category and subcategory.

How to Setup the Project Locally
Prerequisites
            ▪ PHP 7.0 or higher
            ▪ MySQL
            ▪ Apache which is a part of XAMPP or WAMP software.

Installation Steps
            ▪ Download the Project:
Copy or get the project files onto your own device.
(:\xampp\htdocs\ERPSystem1)

            ▪ Setup the Database:
Open phpMyAdmin (usually at http://localhost/phpmyadmin).
Make a new database which could be ERPSystem1.
Import the given SQL file to create some tables needed for this database.

Configure Database Connection:

            ▪ Most of the time, you do not need to change anything in the config.php file but if you want to change the database credentials then you need to do it.


Run the Local Server:

    • Ensure that you have opened your local server that may be XAMPP/WAMP.
    • Navigate to the project directory in your web browser (e.g., http:It will assume http://localhost/ERPSystem1/.

Access the Application:

    • Register customers and items through electronic interface, generate reports and control the accumulated data.

Usage
    • Use only menu to move through the application.
    • Make sure all the necessary forms are filled properly to be validated.
    • Get reports using the right date prompts Choose the correct date parameters to get the desired reports.

