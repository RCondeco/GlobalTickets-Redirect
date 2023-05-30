<?php
require_once 'url.class.php';

class UrlController
{
    private $user;

    public function getUserById($id)
    {
        $user = $this->user->getUserById($id);
        // Handle the response, e.g., return JSON
        header('Content-Type: application/json');
        echo json_encode($user);
    }

    public function createUser()
    {
        // Assuming the request data is sent as JSON
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'];
        $email = $data['email'];

        $userId = $this->user->createUser($name, $email);
        // Handle the response, e.g., return JSON
        header('Content-Type: application/json');
        echo json_encode(['id' => $userId]);
    }

    public function updateUser($id)
    {
        // Assuming the request data is sent as JSON
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'];
        $email = $data['email'];

        $result = $this->user->updateUser($id, $name, $email);
        // Handle the response, e.g., return JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    public function deleteUser($id)
    {
        $result = $this->user->deleteUser($id);
        // Handle the response, e.g., return JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }
}
