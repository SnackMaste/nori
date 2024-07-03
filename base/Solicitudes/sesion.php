<?php
require_once "UserSession.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userSession = new UserSession();
    $currentUser = $userSession->getCurrentUser();
    
    if(isset($currentUser)){
        echo "Sesion_Iniciada";
    } else {
        echo "Sesion_No_Iniciada";
    }
}