<?php
require_once 'UserController.php';

// Extract the request information
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Extract the endpoint and parameters
$endpoint = rtrim(strtok($requestUri, '?'), '/');
$params = array_filter(explode('/', $endpoint));

// Instantiate the UserController
$userController = new UserController();

// Route the request based on the HTTP method and endpoint
switch ($requestMethod) {
    case 'GET':
        if ($endpoint === 'users') {
            if (isset($params[1])) {
                $userController->getUserById($params[1]);
            } else {
                $userController->getAllUsers();
            }
        } else {
            // Handle invalid endpoint
            http_response_code(404);
            echo 'Invalid endpoint';
        }
        break;
    case 'POST':
        if ($endpoint === 'users') {
            $userController->createUser();
        } else {
            // Handle invalid endpoint
            http_response_code(404);
            echo 'Invalid endpoint';
        }
        break;
    case 'PUT':
        if ($endpoint === 'users' && isset($params[1])) {
            $userController->updateUser($params[1]);
        } else {
            // Handle invalid endpoint
            http_response_code(404);
            echo 'Invalid endpoint';
        }
        break;
    case 'DELETE':
        if ($endpoint === 'users' && isset($params[1])) {
            $userController->deleteUser($params[1]);
        } else {
            // Handle invalid endpoint
            http_response_code(404);
            echo 'Invalid endpoint';
        }
        break;
    default:
        // Handle unsupported HTTP method
        http_response_code(405);
        echo 'Method not allowed';
        break;
}