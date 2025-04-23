<?php
require_once('utils/paths.php');

require_once(getRootPath('services/products.php'));
require_once(getRootPath('templates/header.php'));


$s = isset($_GET['s']) ? htmlspecialchars($_GET['s']) : null;
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 1;
$count = isset($_GET['count']) ? htmlspecialchars($_GET['count']) : 8;
$products = getProducts($s, $page, $count);

session_start();

$title = "Главная";
?>


<!--Верстка-->
<h1 class="mb-3">Продукты</h1>

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
                    <a href="/?add=<?= $product['id'] ?>" class="btn btn-success">В корзину</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="/?page=1">1</a></li>
        <li class="page-item"><a class="page-link" href="/?page=2">2</a></li>
        <li class="page-item"><a class="page-link" href="/?page=3">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Вперед</a>
        </li>
    </ul>
</nav>

<?php require_once('templates/footer.php') ?>