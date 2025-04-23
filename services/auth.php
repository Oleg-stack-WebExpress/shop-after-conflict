<?php
require_once(dirname(__DIR__, 1) . '/utils/paths.php');
require_once 'commons.php';

function login($email, $password)
{
  global $db;

  $hash_password = md5($password);

  $query = "SELECT id, email FROM users WHERE email = '$email' and password='$hash_password'";
  $result = $db->query($query);

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];

    return true;
  }

  return false;
}

function registration($email, $password, $name)
{
  global $db;

  $query = "SELECT id FROM users WHERE email = '$email'";
  $result = $db->query($query);

  if ($result->num_rows > 0) {
    return "Пользователь с таким именем или email уже существует";
  }

  $hash_password = md5($password);

  $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hash_password')";
  if ($db->query($query)) {
    return true;
  }

  return "Возникла ошибка при регистрации!";
}

function logoutUser()
{
  session_destroy();
  return true;
}

function isAuth()
{
  return isset($_SESSION['user_id']);
}
