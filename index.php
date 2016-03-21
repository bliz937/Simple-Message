<?php

if(!isset($_COOKIE["msgbrd"]) && !isset($_POST["password"]) && !isset($_POST["username"]))
{    
    require __DIR__.'/html/login.html';
    return;
}

require 'db.php';
require 'person.php';

if(isset($_POST["password"]) && isset($_POST["username"]))
{
    $seshID = md5($_POST["username"].time());
    $nameTaken = personExists($_POST["username"]);
    
    if($nameTaken === FALSE)
    {
        $prsn = personRegister($_POST["username"], md5($_POST["password"]), $seshID);
        
        if($prsn === FALSE)
        {
            echo '<h1>Something went wrong registering you... :(';
            return;
        } 
        
        setcookie("msgbrd", $seshID, time() + 3600, "/");
        require __DIR__.'/html/message.html';        
    } else {        
        $prsn = personLogin($_POST["username"], md5($_POST["password"]), $seshID);
        
        if($prsn !== FALSE)
        {                        
            setcookie("msgbrd", $seshID, time() + 3600, "/");
            require __DIR__.'/html/message.html';         
        } else {
            require __DIR__.'/html/login.html';
        }
    }
} else {
    $prsn = personFromSesh($_COOKIE["msgbrd"]);
    
    if($prsn === FALSE)
    {
        require __DIR__.'/html/login.html';        
    } else {
        require __DIR__.'/html/message.html';   
    }
}


?>
