<?php 

namespace Core\Classes;

use Symfony\Component\HttpFoundation\Session\Session;

class SessionData
{
    protected static $session;

    /**
     * Start session
     */
    public static function start()
    {
        if (self::$session === null) {
            self::$session = new Session();

            if (self::$session->isStarted() === false) {
                self::$session->start();
            }
        }
    }

    /**
     * Set session
     */
    public static function set(string $key, $value)
    {
        self::start();
        self::$session->set($key, $value);
    }

    /**
     * Get session
     *
     * @return Session
     */
    public static function get($key = null)
    {
        return $key != null ? self::$session->get($key) : self::$session;
    }
}
