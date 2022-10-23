<?php
/*
    this class manage the all data of the users
*/
class Users_Model
{
    public $errors = array();

    //save new user in database
    function saveUsers($_users)
    {
        foreach($_users as $_user)
        {
            $userObj = array("name"=>['s',$_user['name']['first']." ". $_user['name']['last']],
            "age"=>['i',$_user['dob']['age']],"country"=>['s',$_user['location']['country']],
            "email"=>['s',$_user['email']],"profile_pic"=>['s',$_user['picture']['thumbnail']]);
    
            $insert = SQL_InsertBind($userObj,"Users");
            if(!$insert)
            {
                array_push($this->errors,"unSuccess User: ".$_user['name']['first']);
            }
        }

       return $this;
    }

    ///for the future - if want to filter rows by server side (array(name=>['s','test']))
    function getAllUsers($_filters = array())
    {
        if(empty($_filters))
        {
           $_filters = array("active"=>['i',1]);
        }
        return SQL_SelectBind($_filters, "Users", false)->fetch_all(MYSQLI_ASSOC);
    }
}
?>