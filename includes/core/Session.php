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
            return null;
    }
    
    public static function destroy()
    {
        @session_unset();
        @session_destroy();
    }

    public static function checkMember()
    {
        self::init();
        echo 'check ';
        echo self::get('loggedIn');
        if (self::get('loggedIn')) {
            header('Location: ../login?error=2');
            exit;
        }
    }

}