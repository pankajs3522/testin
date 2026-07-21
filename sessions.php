<?php

// Function to start a sessionunction startSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Function to set session variables
function setSession($key, $value) {
    $_SESSION[$key] = $value;
}

// Function to get session variables
function getSession($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}

// Function to delete a session variable
function deleteSession($key) {
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}

// Function to destroy a session
function destroySession() {
    if (session_status() !== PHP_SESSION_NONE) {
        session_destroy();
        $_SESSION = [];
    }
}

?>