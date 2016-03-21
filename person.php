<?php 

class person {
    public $id;
    public $username;
    public $seshID;
       
    function __construct($id, $username, $seshID)
    {
        $this->id = $id;
        $this->username = $username;
        $this->seshID = $seshID;
    }
    
}

?>