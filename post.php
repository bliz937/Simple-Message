<?php

class post
{
    public $id;
    public $msg;
    public $date;
    public $person;
   
    function __construct($id, $msg, $date, $person)
    {
        $this->id = $id;
        $this->msg = $msg;
        $this->date = $date;
        $this->person = $person;
    }
}

?>