<?php
require_once(dirname(__DIR__, 2) . '/utils/paths.php');
require_once(getRootPath('templates/header.php'));
require_once(getRootPath('services/auth.php'));
require_once(getRootPath('services/categories.php'));

if (!isAuth()) {
  redirect('/');
}

$s = isset($_GET['s']) ? htmlspecialchars($_GET['s']) : null;

$title = "Админка - Категории";
$categories = getCategories($s);
?>

<h1 class="mb-4">Управление категориями</h1>

<div class="d-flex justify-content-between mb-4">
  <a href="create.php" class="btn btn-success">Добавить категорию</a>
  <form action="#" method="GET" class="d-flex">
    <input class="form-control me-2" type="search" name="s" placeholder="Поиск категорий..." value="<?= $s ?>">
    <button class="btn btn-outline-success" type="submit">Найти</button>
  </form>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Название</th>
      <th>Описание</th>
      <th>Действия</th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = 0; $i < count($categories); $i++): ?>
      <tr>
        <td><?= $categories[$i]['id'] ?></td>
        <td><?= $categories[$i]['name'] ?></td>
        <td><?= $categories[$i]['description'] ?></td>
        <td>
          <a href="/admin/categories/edit.php?id=<?= $categories[$i]['id'] ?>"
            class="btn btn-sm btn-primary">Редактировать</a>
          <a href="/admin/categories/remove.php?id=<?= $categories[$i]['id'] ?>" class="btn btn-sm btn-danger">Удалить</a>
        </td>
      </tr>
    <?php endfor; ?>
  </tbody>
</table>


<?php require_once(getRootPath('templates/footer.php')); ?>