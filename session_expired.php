<?php
 

 
//Expiring the session in case the user is inactive for 30
//minutes or more.
$expireAfter = 180;
 
//Test to make sure if our "last action" session
//variable was set.
if(isset($_SESSION['last_action'])){
    
//Find out how many seconds have already passed
//since the user was active last time.
$secondsInactive = time() - $_SESSION['last_action'];
    
//Converting the minutes into seconds.
$expireAfterSeconds = $expireAfter * 60;
    
//Test to make sure if they have not been active for too long.
if($secondsInactive >= $expireAfterSeconds){
// The user has not been active for too long.
//Killing the session.
session_unset();
session_destroy();
$_SESSION['signin']='0';
}
    
}
 
//Assigning the current timestamp as the user's
// the latest action
$_SESSION['last_action'] = time();