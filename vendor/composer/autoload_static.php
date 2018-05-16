<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf914392ee3270385ccfbad1e1233d0d5
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInitf914392ee3270385ccfbad1e1233d0d5::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf914392ee3270385ccfbad1e1233d0d5::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}