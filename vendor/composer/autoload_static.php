<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita12a37f7fe86cfbefae68e4ed11edc17
{
    public static $files = array (
        '9b552a3cc426e3287cc811caefa3cf53' => __DIR__ . '/..' . '/topthink/think-helper/src/helper.php',
        '35fab96057f1bf5e7aba31a8a6d5fdde' => __DIR__ . '/..' . '/topthink/think-orm/stubs/load_stubs.php',
        '1cfd2761b63b0a29ed23657ea394cb2d' => __DIR__ . '/..' . '/topthink/think-captcha/src/helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'think\\captcha\\' => 14,
            'think\\' => 6,
        ),
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'think\\captcha\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-captcha/src',
        ),
        'think\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/framework/src/think',
            1 => __DIR__ . '/..' . '/topthink/think-helper/src',
            2 => __DIR__ . '/..' . '/topthink/think-orm/src',
        ),
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita12a37f7fe86cfbefae68e4ed11edc17::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita12a37f7fe86cfbefae68e4ed11edc17::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita12a37f7fe86cfbefae68e4ed11edc17::$classMap;

        }, null, ClassLoader::class);
    }
}
