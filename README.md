# GlobalTickets-Redirect

Prerequisites:

    Download and install XAMPP on the target machine. You can find the installation package on the official XAMPP website (https://www.apachefriends.org).

Installation Steps:

    Copy the project files to the appropriate location in the XAMPP installation directory. Typically, you can place the files in the htdocs folder located at C:\xampp\htdocs on Windows or /opt/lampp/htdocs on Linux.
    Start XAMPP by running the XAMPP control panel.
    In the XAMPP control panel, start the Apache and MySQL services by clicking on the "Start" buttons next to their respective names.
    Open a web browser and enter http://localhost/phpmyadmin in the address bar to access the phpMyAdmin interface.
    In phpMyAdmin, create a new database with the name gt-redirect and ensure that the character set is set to utf8mb4_general_ci.
    Import the provided SQL file into the newly created database. To do this, click on the "Import" tab in phpMyAdmin, choose the SQL file from your project files, and click the "Go" button to initiate the import process.
    Once the import is completed, you should see the tables and data in the database.

Running the Project:

    Open a web browser and enter http://localhost in the address bar.
    You should see the default XAMPP page. To access the downloaded project, append the project's directory name to the URL. In this case it will be http://localhost/GlobalTickets-Redirect/.
