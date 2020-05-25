<?php


namespace Tasks\Helper;


class SessionHelper
{
    const KEY_IS_ADMIN = 'is_admin';

    /**
     * @var SessionHelper
     */
    private static $instance;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $password;

    static function getInstance(): SessionHelper
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string[] $config
     */
    public function configure(array $config): void
    {
        $this->name = $config['name'];
        $this->password = $config['password'];
    }

    /**
     * @param string $name
     * @param string $password
     *
     * @return bool
     */
    public function logIn(string $name, string $password): bool
    {
        if ($this->name === $name && $this->password === $password ) {
            $_SESSION[self::KEY_IS_ADMIN] = true;
            return true;
        }

        return false;
    }

    public function logOut(): void
    {
        $_SESSION[self::KEY_IS_ADMIN] = false;
    }

    /**
     * @return bool
     */
    public function isLogIn(): bool
    {
        return !empty($_SESSION[self::KEY_IS_ADMIN]);
    }

    /**
     * @param string $key
     * @param mixed $default
     *
     * @return mixed|null
     */
    public function getValue(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function setValue(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return void
     */
    public function unsetValue(string $key): void
    {
        unset($_SESSION[$key]);
    }

    private function __construct()
    {
        session_start();
    }
}