<?php
include_once 'Url.class.php';
class UrlController extends Url {

   private $uid;
   private $url_id;
   private $short_url;
   private $long_url;
   private $method;


    public function __construct($uid, $url_id,$short_url, $long_url, $method){
        $this->uid = $uid;
        $this->url_id = $url_id;
        $this->short_url = $short_url;
        $this->long_url = $long_url;
        $this->method = $method;

    }

    public function requestHandler(){
        switch($this->method){
            case 'GET':
                $this->getURL();
                break;
            case 'POST':
                $this->creatURL();
                break;
            case 'PUT':
                $this->updateURL();
                break;
            case 'DELETE':
                $this->deleteURL();
                break;
            default:
                http_response_code(405); // Method Not Allowed
                echo json_encode(array("message" => "Method not allowed."));
                break;
        }
    }

    public function getURL(){
         $url = $this->readUserURL($this->uid);
         echo json_encode($url);
    }
    public function creatURL(){
        $this->createURL($this->long_url, $this->uid);
        echo json_encode(array("message" => "URL created successfully."));
    }
    public function updateURL(){
        $this->updateUserURL($this->short_url, $this->long_url, $this->url_id);
        echo json_encode(array("message" => "URL updated successfully."));
        
    }
    public function deleteURL(){
        $this->deleteUserURL($this->url_id, $this->uid);
        echo json_encode(array("message" => "URL deleted successfully."));
    }

}
?>