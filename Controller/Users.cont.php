<?php
class Users_Control
{
    public $errors = array();
    public $method = "";
    public $params = "";
    
    /* getting 2 params in __construct
    1. $_method -> The name of the method in this class that you want to call
    2. $params -> save all params that the client sent to server(like filters and more)
    */
    function __construct($_method, $params) 
    {
       $methodExist = method_exists($this, $_method);//check if the name of the method exist
        if($methodExist)
        {
            $this->method = $_method;
            $this->params = $params;
        }
        else
        {
            array_push($this->errors, RESPONSE_INVALID_COMMAND);///if the name of the method doesnt exist
        }

    }

    /*
        call api for get new users then its save it in database
    */
    function saveUsers()
    {
        $response = RESPONSE_SUCCESS;
        $count = (isset($this->params['count']) && $this->params['count']) ? $this->params['count'] : 0;

        $Model = new Users_Model();

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => USERS_LIST."?results=$count",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $Model->saveUsers(json_decode(curl_exec($curl), true)['results']);
        

        if(!empty($Model->errors))
        {
            $this->errors = $Model->errors;
            $response = $this;
        }

        return $response;
    }

    /*
        get all users in database ->there is an option to filter rows in server side look in $Model->getAllUsers()
    */
    function getUsers()
    {
        $Model = new Users_Model();
        $response = $Model->getAllUsers();

        return $response;
    }
}
?>