<?php
require_once(dirname(__DIR__, 1) . '/utils/paths.php');
require_once 'commons.php';

function getProducts($search = null, $page = 1, $count = 8)
{
    global $db;

    $query = "SELECT products.*, categories.name as category_name FROM products, categories WHERE products.category_id = categories.id";

    // Количество всех продуктов
    $countQuery = "SELECT COUNT(*) as total FROM products, categories WHERE products.category_id = categories.id";

    // Поиск по названию
    if ($search) {
        $query .= ' AND products.name LIKE "%' . $search . '%"';
        $countQuery .= ' AND products.name LIKE "%' . $search . '%"';
    }

    // Пагинация
    if ($page && $count) {
        $query .= ' LIMIT ' . $count . ' OFFSET ' . (($page - 1) * $count);
    }

    $result = $db->query($query);
    $totalResult = $db->query($countQuery);
    $total = $totalResult->fetch_assoc()['total'];

    return [
        'total_count' => $total,
        'items' => $result->fetch_all(MYSQLI_ASSOC)
    ];
}

function getProduct($id)
{
    global $db;
    $query = "SELECT * FROM products WHERE id = $id";
    $result = $db->query($query);
    return $result->fetch_assoc();
}

function addProduct($name, $category_id, $price, $description, $quantity)
{
    global $db;
    $query = "INSERT INTO products (name, category_id, price, description, quantity) VALUES ('$name', $category_id, $price, '$description', $quantity)";
    return $db->query($query);
}

function updateProduct($id, $name, $price, $description, $category_id, $quantity)
{
    global $db;
    $query = "UPDATE products SET name = '$name', price = $price, description = '$description', category_id = $category_id, quantity = $quantity WHERE id = $id";
    return $db->query($query);
}
function removeProduct($id)
{
    global $db;
    $query = "DELETE FROM products WHERE id = $id";
    return $db->query($query);
}


