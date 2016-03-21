<?php
//Connection details
define("HOST", "localhost");
define("USER", "root");
define("PASS", "password");
define("DATABASE", "msgbrd");

//Creates the connection string
function ConnectionString()
{
    $con;
    
    try
    {        
        $con = mysqli_connect(HOST,USER,PASS,DATABASE);
    }
    catch(Exception $e)
    {
        echo "MySQL exception!" . $e;
        return;   
    }
    
    if (mysqli_connect_errno()) {
        echo "<h1>Failed to connect to MySQL: <h1>" . mysqli_connect_error();
        return;
    }
    
    return $con;
}

//Returns user session ID if exists (and correct password), FALSE otherwise
function personLogin($name, $pass, $seshID)
{
    $con = ConnectionString();
    
    $sql = "UPDATE mb_user SET usr_SeshID = '$seshID' WHERE usr_Name = '$name' AND usr_Pass = '$pass';";
    $retn = FALSE;
    
    if($con->query($sql) === TRUE && $con->affected_rows == 1)
    {    
        $sql = "SELECT usr_ID FROM mb_user WHERE usr_SeshID = '$seshID';";
        $result = $con->query($sql);
        
        if($result->num_rows === 1)
        {
            $row = $result->fetch_assoc();
            $retn = new person($row["usr_ID"], $name, $seshID);   
        }
    }
        
    $con->close();
    return $retn;
}

//Checks if user exists
function personExists($name)
{
    $con = ConnectionString();
    
    $sql = "SELECT usr_ID FROM mb_user WHERE usr_Name = '$name';";
    $retn = FALSE;
    $result = $con->query($sql);    
    
    if($result !== FALSE && $result->num_rows === 1)
    {
        $retn = TRUE;   
    }
    
    $con->close();
    return $retn;
}

//registers a new user. True if success
function personRegister($name, $pass, $seshID)
{
    $con = ConnectionString();
    $retn = FALSE;
    
    $sql = "INSERT INTO mb_user (usr_Name, usr_Pass, usr_SeshID) VALUES ('$name', '$pass', '$seshID');";
    
    if($con->query($sql) === TRUE)
    {
        $retn = new person($con->insert_id, $name, $seshID);
    }
    
    $con->close();
    return $retn;
}

//Return the person from a given session id
function personFromSesh($seshID)
{
    $con = ConnectionString();
    $retn = FALSE;
    
    $sql = "SELECT usr_ID, usr_Name FROM mb_user WHERE usr_SeshID = '$seshID';";
    $result = $con->query($sql);

 
    if($result->num_rows == 1)
    {
        $row = $result->fetch_assoc();        
        $retn = new person($row["usr_ID"], $row["usr_Name"], $seshID);   
    }

    
    $con->close();
    return $retn;
}

//Posts a mesage
function postMsg($prsnID, $msg, $date)
{
    $con = ConnectionString();
    $retn = FALSE;

    $sql = "INSERT INTO mb_posts (usr_ID, pst_Post, pst_Date) VALUES ('$prsnID', '$msg', '$date');";
    
    if($con->query($sql) == TRUE) 
    {
	$retn = $con->insert_id;
    }	
    
    $con->close();
    return $retn;
}

//given an id, get the message
function viewMsg($id)
{
    $con = ConnectionString();
    $retn = FALSE;

    if($id == -1)
    {
        $sql = "SELECT pst_ID, usr_Name, pst_Post, pst_Date FROM mb_posts LEFT JOIN mb_user ON mb_user.usr_ID = mb_posts.usr_ID ORDER BY pst_ID DESC LIMIT 0, 1;";
    } else {
        $sql = "SELECT pst_ID, usr_Name, pst_Post, pst_Date FROM mb_posts LEFT JOIN mb_user ON mb_user.usr_ID = mb_posts.usr_ID WHERE pst_ID = '$id';";
    }
    $result = $con->query($sql);
    
    if($result->num_rows == 1)
    {
        $row = $result->fetch_assoc();
        $retn = new post($row["pst_ID"], $row["pst_Post"], $row["pst_Date"], $row["usr_Name"]);
    }


    $con->close();
    return $retn;
}
?>
