<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb69d286c02b8d0dda10f4e3909229ecd
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitb69d286c02b8d0dda10f4e3909229ecd', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb69d286c02b8d0dda10f4e3909229ecd', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb69d286c02b8d0dda10f4e3909229ecd::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
