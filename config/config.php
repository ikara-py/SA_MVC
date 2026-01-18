<?php

define('BASE_URL', '/SA_MVC');
function url($path = '') {
    $path = ltrim($path, '/');
    return BASE_URL . '/' . $path;
}
function asset($path = '') {
    $path = ltrim($path, '/');
    return BASE_URL . '/' . $path;
}