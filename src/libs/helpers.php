<?php

function view(string $filename, array $data = []): void
{
    // create variables from the associative array
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once __DIR__ . "/../inc/" . $filename . '.php';
}

function is_post_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD'] === 'POST');
}

function is_get_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD'] === 'GET');
}

/**
 * Create error class function
 * @param array $errors
 * @param string $field
 * @return string
 */

function error_class(array $errors, string $field): string
{
    return isset($errors[$field]) ? 'error' : '';
}

/**
 * @param string $url
 * @return void
 */

function redirect_to(string $url): void
{
    header('Location:' . $url);
    exit;
}

/**
 * @param string $url
 * @param array $items
 * @return void
 */

function redirect_with(string $url, array $items): void
{
    foreach ($items as $key => $value) {
        $_SESSION[$key] = $value;
    }

    redirect_to($url);
}

function redirect_with_message(string $url, string $message, string $type = FLASH_SUCCESS): void
{
    flash('flash_' . uniqid(), $message, $type);
    redirect_to($url);

}

/**
 * Flash data specified by $keys from the $_SESSION
 * @param ...$keys
 * @return array
 */
function session_flash(...$keys): array
{
    $data = [];
    foreach ($keys as $key) {
        if (isset($_SESSION[$key])) {
            $data[] = $_SESSION[$key];
            unset($_SESSION[$key]);
        } else {
            $data[] = [];
        }
    }
    return $data;
}