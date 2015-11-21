<?php


class Session
{


    public static function init()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        //ALL THE SESSION DEBUGS...
        self::file_info();
        self::dump();

    }

    public static function file_info()
    {
        echo 'session file: ', ini_get('session.save_path') . '/' . 'sess_' . session_id(), ' ';
        echo 'size: ', filesize(ini_get('session.save_path') . '/' . 'sess_' . session_id()), '</br>';
    }

    public static function dump()
    {
        var_dump($_SESSION);
    }

    public static function clear($key) {
        unset($_SESSION[$key]);
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    //Authenticate on member only pages

    public static function destroy()
    {
        @session_unset();
        @session_destroy();
    }

    //Sometimes needed cos sessions are being weird

    //DEBUG

    public static function get($key)
    {
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return false;
    }

    public static function commit()
    {
        session_write_close();
    }

}