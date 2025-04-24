<?php

function addToCard($product_id)
{
    $_SESSION['cart'][] = $product_id;
}

function getCart()
{
  return $_SESSION['cart'] ?? [];
}

function clearCart()
{
  $_SESSION['cart'] = [];
}

function removeFromCart($product_id)
{
  $_SESSION['cart'] = array_diff($_SESSION['cart'], [$product_id]);
}