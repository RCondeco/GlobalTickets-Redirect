<?php
include_once '../classes/conn.class.php';
class URLRedirector extends Conn
{

    public function processRedirect()
    {
        if (isset($_GET['r'])) {
            $shortCode = $_GET['r'];

            $originalURL = $this->getOriginalURL($shortCode);

            if ($originalURL) {
                $this->redirectToURL($originalURL);
                exit;
            }
        }

        // Redirect failed, handle accordingly
        echo "Invalid or missing URL";
    }

    private function getOriginalURL($shortCode)
    {
        $stmt = $this->connect()->prepare('SELECT Long_url FROM url WHERE Short_url = :shortCode');
        $stmt->bindParam(':shortCode', $shortCode);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['Long_url'])) {
            return $result['Long_url'];
        }

        return null;
    }

    private function redirectToURL($url)
    {
        header("Location: https://" . $url);
    }
}

$redirector = new URLRedirector();
$redirector->processRedirect();