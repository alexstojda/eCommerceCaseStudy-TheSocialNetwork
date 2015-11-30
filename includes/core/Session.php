<?php

/**
 * Class Session
 * Wrapper for all session things because laziness is an asset
 */
class Session
{
    public static function init()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return false;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function clear($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        @session_unset();
        @session_destroy();
    }

    //Sometimes needed cos sessions are being weird
    public static function commit()
    {
        session_write_close();
    }

    //DEBUG
    public static function file_info()
    {
        echo 'session file: ', ini_get('session.save_path') . '/' . 'sess_' . session_id(), ' ';
        echo 'size: ', filesize(ini_get('session.save_path') . '/' . 'sess_' . session_id()), '</br>';
    }

    public static function dump()
    {
        var_dump($_SESSION);
    }
}