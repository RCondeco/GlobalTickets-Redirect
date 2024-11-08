<?php
include './include/autoloader.php';
session_start();

if ($_SESSION['userName']) {
    $user = $_SESSION['userName'];
    $userID = $_SESSION['userID'];
} else {
    header("location: ./index.php?error=notLogged");
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
                <a href="include/logout.php"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Logout</a>
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
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">
                Below you can find a table with all the your shortened URLS, aswell a input field where you can quickly
                create your own..</p>
        </div>
    </section>
    <!-- Table with shorten urls, with actions -->
    <section>
        <form id="hiddenForm" method="post">
            <input type="hidden" name="uid" value="<?php echo $userID; ?>">
            <input type="hidden" name="method" value="GET">
        </form>
        <div class="flex justify-center mt-10">
            <!-- Input field to create the shorten url-->
            <section class="form w-2/3">
                <form id="urlForm" method="post">
                    <div class="relative">
                        <input type="hidden" name="uid" value="<?php echo $userID; ?>">
                        <input type="text" id="long_link"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="e.g. https://example.com" name="long_url" required>
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
                        <th scope="col" class="px-6 py-3 flex justify-end">
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
    <div id="editModal"
        class="modal hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-8 rounded">
            <h2 class="text-2xl font-semibold mb-4">Edit URLs</h2>
            <form id="urlFormEdit" method="post">
                <label for="short_url" class="block mb-2">Short Url</label>
                <input type="text" id="short_url" name="short_url"
                    class="border border-gray-300 rounded mb-4 px-3 py-2 w-full" required>
                <label for="long_url" class="block mb-2">Long Url</label>
                <input type="text" id="long_url" name="long_url"
                    class="border border-gray-300 rounded mb-4 px-3 py-2 w-full" required>
                <input type="hidden" id="url_id" name="url_id"
                    class="border border-gray-300 rounded mb-4 px-3 py-2 w-full">
                <input type="hidden" name="method" value="PUT">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Save</button>
                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-2"
                    onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Modal for delete confirmation -->
    <div id="deleteModal"
        class="modal hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-8 rounded">
            <h2 class="text-2xl font-semibold mb-4">Delete URL</h2>
            <p>Are you sure you want to delete the URL: <span id="delete_short_url"></span> ?</p>
            <form id="urlFormDelete" method="post">
                <input type="hidden" id="delete_url_id" name="url_id">
                <input type="hidden" id="delete_user_id" name="uid">
                <input type="hidden" name="method" value="DELETE">
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mt-4">Delete</button>
                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-2"
                    onclick="closeDeleteModal()">Cancel</button>
            </form>
        </div>
    </div>


    <!-- JavaScript to handle modal open and close functionality
    It also contains all the form handling for the form methods-->

    <script>
    function openModal(short_URL, long_URL, ID) {
        document.getElementById('short_url').value = short_URL;
        document.getElementById('long_url').value = long_URL;
        document.getElementById('url_id').value = ID;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openDeleteModal(userID, ID) {
        console.log(userID, ID);
        document.getElementById('delete_user_id').value = userID;
        document.getElementById('delete_url_id').value = ID;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
    $(document).ready(function() {

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
                    //Refresh page
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    console.log(error);
                }
            });
        });
        $('#urlFormEdit').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Serialize the form data
            // Make an AJAX request to the API
            $.ajax({
                url: './api/index.php/url',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle the API response
                    //Refresh page
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    console.log(error);
                }
            });
        });

        $('#urlFormDelete').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Serialize the form data
            // Make an AJAX request to the API
            $.ajax({
                url: './api/index.php/url',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle the API response
                    //Refresh page
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    console.log(error);
                }
            });
        });

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
                    row.append($('<td class="px-6 py-4">').html(
                        '<a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="./r/index.php?r=' +
                        encodeURIComponent(item.Short_URL) + '">' + item.Short_URL +
                        '</a>'));
                    row.append($('<td class="px-6 py-4">').text(item.Long_URL));
                    row.append($('<td class="px-6 py-4 flex justify-end">').html(
                        '<button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" onclick="openModal(\'' +
                        item.Short_URL + '\', \'' + item.Long_URL + '\', \'' + item
                        .ID +
                        '\')">Edit</button>' +
                        '<button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded ml-2" onclick="openDeleteModal(\'' +
                        item.User_ID + '\', \'' + item.ID +
                        '\')">Delete</button>'));
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });



    });
    </script>


</body>

</html>