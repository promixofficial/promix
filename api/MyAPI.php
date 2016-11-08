<?php
session_start();
require_once 'API.class.php';
require_once 'conexaobd.php';
class MyAPI extends API
{
    protected $User;
    public $propriedades;
        
    public function __construct($request, $origin) {
        parent::__construct($request);
        
        
         $this->User = new stdClass();
        if(isset($_SESSION['usuario'])){
            $this->User->name = $_SESSION['usuario'];
        }else{
            $this->User->name = "akiraa";
        }
        $this->propriedades = new stdClass();
        $this->propriedades->method = $this->method;
        $this->propriedades->endpoint = $this->endpoint;
        $this->propriedades->verb = $this->verb;
        $this->propriedades->args = $this->args;
        $this->propriedades->file = $this->file;
        $this->propriedades->User = $this->User;
        
        // Abstracted out for example
        /*$APIKey = new Models\APIKey();
        $User = new Models\User();

        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (array_key_exists('token', $this->request) &&
             !$User->get('token', $this->request['token'])){

            throw new Exception('Invalid User Token');
        }

        $this->User = $User;*/
        /*$this->User = new stdClass();
        $this->User->name = "akira";*/
    }
    

    /**
     * Example of an Endpoint
     */
     protected function email() {
        include_once 'v1/email.php';
        return apiEmail($this->propriedades);
     }
     
 }

 
// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new MyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}


 
 
 
?>


