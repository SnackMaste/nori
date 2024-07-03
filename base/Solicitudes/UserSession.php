<?php 
class UserSession {

    public function __construct(){
        ini_set('session.gc_maxlifetime', 1800);
        session_start([
            'cookie_samesite' => 'Lax'
        ]);
    }

    public function setCurrentUser($user){
        $_SESSION['user'] = $user;
    }

    public function getCurrentUser(){
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        } else {
            return null;
        }
    }    

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}