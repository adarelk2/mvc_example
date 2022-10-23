<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Const/response.php';
Class Response
{
    Public $status;
    Public $state;
    Public $msg;
    
    function __construct() //init response obj with state false, status success, msg null
    {
        $this->state = false;
        $this->status = STATUS_SUCCESS;
        $this->msg = "";
        return $this;
    }

    function setState($_state) //change the state of the response
    {
        $this->state = $_state;
        return $this;
    }

    function success() //change the status of the response to success
    {
        $this->status = STATUS_SUCCESS;
        return $this;
    }

    function created() //change the status of the response to created
    {
        $this->status = STATUS_CREATED;
        return $this;
    }

    function deleted() //change the status of the response to deleted
    {
        $this->status = STATUS_DELETED;
        return $this;
    }

    function bad_request() //change the status of the response to bad request
    {
        $this->status = STATUS_BAD_REQUEST;
        return $this;
    }

    function setMsg($_msg) //change the message of the response
    {
        $this->msg = $_msg;
        return $this;
    }

    function renderToEncode($encode = true) //return the response as json if true, else return the raw response obj
    {

        // if(!DEBUG){
        //     ob_clean();
        // }
        
	    if($encode)
	        return json_encode($this);
	    return $this;
    }

    function renderToDecode() //return the response
    {
        return $this;
    }
}

?>