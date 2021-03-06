<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite62fa0755cf9184ed9bd8030b1910472
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'PhpOffice\\PhpSpreadsheet\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'PhpOffice\\PhpSpreadsheet\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpspreadsheet/src/PhpSpreadsheet',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite62fa0755cf9184ed9bd8030b1910472::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite62fa0755cf9184ed9bd8030b1910472::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
