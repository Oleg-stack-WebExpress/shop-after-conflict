<?php
require_once(dirname(__DIR__, 2) . '/utils/paths.php');

require_once(getRootPath('services/auth.php'));
require_once(getRootPath('services/products.php'));
require_once(getRootPath('services/categories.php'));

if (!isAuth()) {
    redirect('/');
  }

  $product_id = $_GET['id'] ?? null;
if ($product_id == null) {
  redirect('/admin/products');
}

if (removeProduct( $product_id)){
    redirect('/admin/products');
}else{
    //...
    redirect('/admin/products');
}