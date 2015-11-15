<?php

class Session
{
    
    public static function init()
    {
        @session_start();
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
        session_destroy();
    }

    public static function checkMember()
    {
        self::init();

        if (self::get('loggedIn') == false) {
            self::destroy();
            header('location: '.URL.'login?error=1');
            exit;
        }
    }

}