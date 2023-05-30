<?php
include './include/autoloader.php';
session_start();

if ($_SESSION['userName']) {
    $user = $_SESSION['userName'];
    $userID = $_SESSION['userID'];
} else {
    header("location: ../index.php?error=notLogged");
}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        "50": "#eff6ff",
                        "100": "#dbeafe",
                        "200": "#bfdbfe",
                        "300": "#93c5fd",
                        "400": "#60a5fa",
                        "500": "#3b82f6",
                        "600": "#2563eb",
                        "700": "#1d4ed8",
                        "800": "#1e40af",
                        "900": "#1e3a8a"
                    }
                }
            },
            fontFamily: {
                'body': [
                    'Inter',
                    'ui-sans-serif',
                    'system-ui',
                    '-apple-system',
                    'system-ui',
                    'Segoe UI',
                    'Roboto',
                    'Helvetica Neue',
                    'Arial',
                    'Noto Sans',
                    'sans-serif',
                    'Apple Color Emoji',
                    'Segoe UI Emoji',
                    'Segoe UI Symbol',
                    'Noto Color Emoji'
                ],
                'sans': [
                    'Inter',
                    'ui-sans-serif',
                    'system-ui',
                    '-apple-system',
                    'system-ui',
                    'Segoe UI',
                    'Roboto',
                    'Helvetica Neue',
                    'Arial',
                    'Noto Sans',
                    'sans-serif',
                    'Apple Color Emoji',
                    'Segoe UI Emoji',
                    'Segoe UI Symbol',
                    'Noto Color Emoji'
                ]
            }
        }
    }
    </script>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Top navbar with logout -->
    <nav class=" w-full z-20 top-0 left-0 ">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="flex md:order-2">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Logout</button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            </div>
        </div>
    </nav>
    <!-- Jumbotron for a quick intro on the user main area -->
    <section>
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
            <h1
                class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Welcome back <?php echo $user; ?>
            </h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Here at
                Below you can find a table with all the your shortened URLS, aswell a input field where you can quickly
                create your own..</p>
        </div>
    </section>
    <!-- Table with shorten urls, with actions -->
    <section>
        <form id="hiddenForm" method="post">
            <input type="hidden" name="uid" value="<?php echo $userID;?>">
            <input type="hidden" name="method" value="GET">
        </form>
        <div class="flex justify-center mt-10">
            <!-- Input field to create the shorten url-->
            <section class="form w-2/3">
                <form id="urlForm" method="post">
                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Paste
                        your link</label>
                    <div class="relative">
                        <input type="hidden" name="uid" value="<?php echo $userID;?>">
                        <input type="text" id="long_link"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search" name="long_url" required>
                        <input type="hidden" name="method" value="POST">
                        <button type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Shorten</button>
                    </div>
                </form>
            </section>
        </div>

        <div class="flex justify-center mt-10">
            <table id="data-table" class="w-2/3 text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Shortened Url
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Original Url
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Modal -->
    <div id="myModal"
        class="modal hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-8 rounded">
            <h2 class="text-2xl font-semibold mb-4">Edit User</h2>
            <form id="myForm" method="POST">
                <label for="edit-name" class="block mb-2">Name</label>
                <input type="text" id="edit-name" name="edit-name"
                    class="border border-gray-300 rounded mb-4 px-3 py-2 w-full" required>
                <label for="edit-email" class="block mb-2">Email</label>
                <input type="email" id="edit-email" name="edit-email"
                    class="border border-gray-300 rounded mb-4 px-3 py-2 w-full" required>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Save</button>
                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-2"
                    onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>

    <!-- JavaScript to handle modal open and close functionality -->

    <script>
    function openModal(name, email) {
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-email').value = email;
        document.getElementById('myModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('myModal').classList.add('hidden');
    }
    $(document).ready(function() {

        var userID = $('input[name="uid"]').val();
        var method = $('input[name="method"]').val();
        $.ajax({
            url: './api/index.php/url',
            type: 'POST',
            data: {
                uid: userID,
                method: method
            },
            success: function(response) {
                var tableBody = $('#data-table tbody');

                response = JSON.parse(response);
                response.forEach(function(item) {
                    var row = $(
                        '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">'
                    );
                    row.append($('<td class="px-6 py-4">').text(item.Short_URL));
                    row.append($('<td class="px-6 py-4">').text(item.Long_URL));
                    row.append($('<td class="px-6 py-4">').html(
                        '<button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" onclick="openModal(\'' +
                        item.Short_URL + '\', \'' + item.Long_URL +
                        '\')">Edit</button>'));
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });


        // Handle form submission
        $('#urlForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Serialize the form data
            // Make an AJAX request to the API
            $.ajax({
                url: './api/index.php/url',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle the API response
                    console.log(response);
                    //Refresh page
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    console.error(error);
                }
            });
        });
    });
    </script>


</body>

</html>