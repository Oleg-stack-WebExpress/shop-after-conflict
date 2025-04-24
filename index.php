<?php
session_start();

$title = "Главная";
require_once('utils/paths.php');

require_once(getRootPath('services/products.php'));
require_once(getRootPath('services/cart.php'));
require_once(getRootPath('templates/header.php'));


$s = isset($_GET['s']) ? htmlspecialchars($_GET['s']) : null;
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 1;
$count = isset($_GET['count']) ? htmlspecialchars($_GET['count']) : 8;
$products = getProducts($s, $page, $count);

$succsess = null;

if (isset($_GET['add'])) {
    $product_id = isset($_GET['add']) ? htmlspecialchars($_GET['add']) : null;
    addToCard($product_id);
    $succsess = "Товар добавлен в корзину";
}
?>

<!--Верстка-->
<h1 class="mb-3">Продукты</h1>

<?php if ($succsess) {
    showSuccess($succsess);
} ?>

<div class="row mb-3">
    <div class="col-md-3">
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Поиск продуктов..." name="s" value="<?= $s ?>">
            <button class="btn btn-outline-success" type="submit">Найти</button>
        </form>
    </div>
</div>

<div class="row">

    <!--Вставка php, которая выдает нужное количество карточек продуктов на страницу-->
    <?php foreach ($products['items'] as $product): ?>
        <div class="col-md-3 mb-3">
            <div class="card h-55">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['name']; ?></h5>
                    <p class="card-text"><?= $product['description']; ?></p>
                    <p class="text-muted"><?= $product['price']; ?> руб.</p>
                    <a href="/?add=<?= $product['id'] ?>" class="btn btn-success"><i class="icon-cart-plus"></i>В
                        корзину</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php
        $totalPages = ceil($products['total_count'] / $count);
        for ($i = 1; $i <= $totalPages; $i++):
            ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="/?page=<?= $i ?>&count=<?= $count ?>&s=<?= $s ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<?php require_once(getRootPath('templates/footer.php')) ?>