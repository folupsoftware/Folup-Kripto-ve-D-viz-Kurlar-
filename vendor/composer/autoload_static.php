<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit793b7163eda6d05c33b2c3e2427bd4a7
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'FolupExchange\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'FolupExchange\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit793b7163eda6d05c33b2c3e2427bd4a7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit793b7163eda6d05c33b2c3e2427bd4a7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit793b7163eda6d05c33b2c3e2427bd4a7::$classMap;

        }, null, ClassLoader::class);
    }
}
