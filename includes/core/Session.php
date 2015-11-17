<?php


class Session
{


    public static function init()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        //ALL THE SESSION DEBUGS...
        //echo 'Login Status : ' . self::get('Status') . '         ' . '</br>';
        echo 'session file: ', ini_get('session.save_path') . '/' . 'sess_'.session_id(), ' ';
        echo 'size: ', filesize(ini_get('session.save_path') . '/' . 'sess_'.session_id()), "</br>";
        self::dump();

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
        if (!self::get('Status')) {
            header('Location: ../login?error=2');
            exit;
        }
    }

    public static function commit()
    {
        session_write_close();
    }

    public static function dump()
    {
        var_dump($_SESSION);
    }

}