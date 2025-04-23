<?php
require_once(dirname(__DIR__, 2) . '/utils/paths.php');

require_once(getRootPath('services/auth.php'));
require_once(getRootPath('services/categories.php'));

if (!isAuth()) {
    redirect('/');
  }

  $category_id = $_GET['id'] ?? null;
if ($category_id == null) {
  redirect('/admin/categories');
}

if (removeCategory($category_id)){
    redirect('/admin/categories');
}else{
    //...
    redirect('/admin/categories');
}