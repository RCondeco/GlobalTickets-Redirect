<?php
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

include_once 'UrlController.class.php';
// Check if the request method is valid
$allowedMethods = ['GET', 'POST', 'PUT', 'DELETE'];
$method = $_SERVER['REQUEST_METHOD'];

// Handle DELETE and PUT requests sent via Ajax
if ($method === 'POST') {
$httpMethod = isset($_POST['_method']) ? strtoupper($_POST['_method']) : null;
if ($httpMethod === 'DELETE' || $httpMethod === 'PUT') {
$method = $httpMethod;
}
}
// Check if the request is made to the URL endpoint
if ($_SERVER['REQUEST_URI'] !== '/GlobalTickets-Redirect/api/index.php/url') {
http_response_code(404); // Not Found
echo json_encode(array("message" => "Endpoint not found."));
exit();
}

// Retrieve the request data
$data = json_decode(file_get_contents('php://input'), true);

// Extract the required parameters
$uid = $_POST['uid'] ?? null;
$shortUrl = $_POST['short_url'] ?? null;
$longUrl = $_POST['long_url'] ?? null;
$url_id = $_POST['url_id'] ?? null;
$method = $_POST['method'] ?? null;

// Instantiate the URLController and handle the request
$controller = new UrlController($uid, $url_id, $shortUrl, $longUrl, $method);
$controller->requestHandler();

?>