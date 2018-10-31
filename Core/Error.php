<?php

namespace Core;

/**
 * Error and exception handler
 *
 * Class Error
 * @package Core
 */
class Error
{

    /**
     * @param $level
     * @param $message
     * @param $file
     * @param $line
     * @throws \ErrorException
     */
    public static function errorHandler($level, $message, $file, $line)
    {
        if(error_reporting() !== 0) {   // to keep the @ operator working
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Exception handler
     *
     * @param \Exception $exception
     *
     * @return void
     */
    public static function exceptionHandler(\Exception $exception): void
    {
        echo "<h1>Fatal error</h1>";
        echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
        echo "<p>Message: '" . $exception->getMessage() . "'</p>";
        echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
    }
}