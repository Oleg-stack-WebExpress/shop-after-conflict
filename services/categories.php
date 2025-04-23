<?php
require_once(dirname(__DIR__, 1) . '/utils/paths.php');
require_once 'commons.php';

function getCategories($search = null)
{
    global $db;
    $query = "SELECT * FROM categories";

    if ($search) {
        $query .= ' WHERE name LIKE "%' . $search . '%"';
    }
    
    $result = $db->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getCategory($id)
{
    global $db;
    $query = "SELECT * FROM categories WHERE id = $id";
    $result = $db->query($query);
    return $result->fetch_assoc();
}

function addCategory($name, $description)
{
    global $db;
    $query = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
    return $db->query($query);
}

function updateCategory($id, $name, $description)
{
    global $db;
    $query = "UPDATE categories SET name = '$name', description = '$description' WHERE id = $id";
    return $db->query($query);
}

function removeCategory($id)
{
    global $db;
    $query = "DELETE FROM categories WHERE id = $id";
    return $db->query($query);
}