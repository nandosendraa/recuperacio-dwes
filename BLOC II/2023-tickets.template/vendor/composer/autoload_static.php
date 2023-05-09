<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf1aeddc2e1bd807cee617fc939cea619
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Webmozart\\Assert\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Webmozart\\Assert\\' => 
        array (
            0 => __DIR__ . '/..' . '/webmozart/assert/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf1aeddc2e1bd807cee617fc939cea619::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf1aeddc2e1bd807cee617fc939cea619::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf1aeddc2e1bd807cee617fc939cea619::$classMap;

        }, null, ClassLoader::class);
    }
}