<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite812a819f7b7d076077f8abcb3273270
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hybridauth\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hybridauth\\' => 
        array (
            0 => __DIR__ . '/..' . '/hybridauth/hybridauth/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite812a819f7b7d076077f8abcb3273270::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite812a819f7b7d076077f8abcb3273270::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite812a819f7b7d076077f8abcb3273270::$classMap;

        }, null, ClassLoader::class);
    }
}
