<?php
if(isset($_POST["view"])) {
    if($_POST["view"] == "view")
    {
        require __DIR__.'/html/message.view.html';
    } else if($_POST["view"] == "post") {
	require __DIR__.'/html/message.post.html';
    }
} else if(isset($_POST["post"])) {
    require 'person.php';
    require 'db.php';
    $prsn = personFromSesh($_COOKIE["msgbrd"]);
    $res = postMsg($prsn->id, $_POST["post"], date("Y-m-d H:i:s"));

    if($res == FALSE)
    {
	echo "Oh no! :(<hr>Didn't post.";
    } else {
        require __DIR__.'/html/message.post.suc.html';
    }
} else if(isset($_POST["viewMsg"])) {
    $msgID = $_POST["viewMsg"];
    require __DIR__.'/html/message.view.html';    
}

?>
