<?php
session_start();

// Настройки базы данных
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'shop');

// Создаем соединение с базой данных
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

function redirect($url) {
  header("Location: $url");
  exit();
}

function showError($message) {
  echo '<div class="alert alert-danger">' . $message . '</div>';
}

function showSuccess($message) {
  echo '<div class="alert alert-success">' . $message . '</div>';
}

