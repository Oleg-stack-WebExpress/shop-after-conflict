<?php
require_once('utils/paths.php');
require_once(getRootPath('services/commons.php'));
require_once(getRootPath('services/auth.php'));

if (logoutUser()) {
  redirect('/');
}

?>