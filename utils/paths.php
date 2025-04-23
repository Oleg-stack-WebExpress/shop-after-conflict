<?php
define('ROOT_PATH', dirname(__DIR__));

function getRootPath($path) {
    return ROOT_PATH . '/'. ltrim($path, '/');
}