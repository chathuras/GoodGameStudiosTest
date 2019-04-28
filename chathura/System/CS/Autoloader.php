<?php

namespace CS;

/**
 * Class Autoloader
 * @package CS
 */
class Autoloader
{

    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    /**
     * PSR-0 autoload
     * @param $className
     */
    public function autoload($className)
    {
        $className = ltrim($className, '\\');
        $fileName = '';
        $namespace = '';

        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }

        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        require $fileName;
    }

}