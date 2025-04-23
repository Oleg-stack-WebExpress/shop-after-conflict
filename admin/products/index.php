<?php
require_once(dirname(__DIR__, 2) . '/utils/paths.php');
require_once(getRootPath('templates/header.php'));
require_once(getRootPath('services/auth.php'));
require_once(getRootPath('services/products.php'));


if (!isAuth()) {
  redirect('/');
}

$s = isset($_GET['s']) ? htmlspecialchars($_GET['s']) : null;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$count = 8;

$title = "Админка - Продукты";

$products = getProducts($s, $page, $count);
?>


<h1 class="mb-4">Управление продуктами</h1>

<div class="d-flex justify-content-between mb-4">
  <div>
    <a href="/admin/products/create.php" class="btn btn-success">Добавить продукт</a>
  </div>

  <form action="/admin/products" method="GET" class="d-flex">
    <input class="form-control me-2" type="search" name="s" placeholder="Поиск продуктов..." value="<?= $s ?>"  >
    <button class="btn btn-outline-success" type="submit">Найти</button>
  </form>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Название</th>
      <th>Категория</th>
      <th>Цена</th>
      <th>Количество</th>
      <th>Действия</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products['items'] as $product): ?>
      <tr>
        <td><?php echo $product['id']; ?></td>
        <td><?php echo $product['name']; ?></td>
        <td><?php echo $product['category_name']; ?></td>
        <td><?php echo $product['price']; ?> руб.</td>
        <td><?php echo $product['quantity']; ?></td>
        <td>
          <a href="/admin/products/edit.php?id=<?php echo $product['id']; ?>"
            class="btn btn-sm btn-primary">Редактировать</a>
          <a href="/admin/products/remove.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-danger">Удалить</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <?php
    $totalPages = ceil($products['total_count'] / $count);
    for ($i = 1; $i <= $totalPages; $i++):
      ?>
      <li class="page-item <?= $i == $page ? 'active' : '' ?>">
        <a class="page-link" href="/admin/products/?page=<?= $i ?>&count=<?= $count ?>&s=<?= $s ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>

<?php require_once(getRootPath('templates/footer.php')); ?>