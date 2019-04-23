<?php
/**
 *  Set the error reporting
 */
error_reporting(-1);            // Report all errors
ini_set('display_errors', 1);   // Display all errors

/**
 *  Default exception handler
 */
set_exception_handler(function ($err) {
    echo '<p>Anax: Uncaught exception:</p><p>Line '
    . $err->getLine()
    . ' in file '
    . $err->getFile()
    . '</p><p><code>'
    . get_class($err)
    . '</code></p><p>'
    . $err->getMessage()
    . '</p><p>Code: '
    . $err->getCode()
    . '</p><pre>'
    . $err->getTraceAsString()
    . '</pre>';
});


// Start the session
session_name('guessGame');
session_start();
