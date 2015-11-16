<?php


class Session
{
    
    public static function init()
    {
        session_start();
    }
    
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key)
    {
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return false;
    }
    
    public static function destroy()
    {
        @session_unset();
        @session_destroy();
    }

    //Authenticate on member only pages
    public static function checkMember()
    {
        if (self::get('loggedIn') === false) {
            header('Location: ../login?error=2');
            exit;
        }
    }

}