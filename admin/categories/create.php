<?php
require_once(dirname(__DIR__, 2) . '/utils/paths.php');
require_once(getRootPath('templates/header.php'));
require_once(getRootPath('services/auth.php'));
require_once(getRootPath('services/categories.php'));

if (!isAuth()) {
  redirect('/');
}

$title = "Админка - Создание категории";
$error = null;

if (array_key_exists('name', $_POST)) {
  if (!empty($_POST['name'])) {

    $name_categories = htmlspecialchars($_POST['name']);
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null;


    if (addCategory($name_categories, $description)) {
      redirect('/admin/categories');
    } else {
      $error = 'Ошибка при создании категории';
    }
  }else{
    $error = 'Заполните все данные';
  }
}
?>

<h1 class="mb-4">Создание категории</h1>

<?php
if ($error) {
  showError($error);
}
?>

<form action="#" method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">Название</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Описание</label>
    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Создать</button>
  <a href="/admin/categories/" class="btn btn-secondary">Отмена</a>
</form>

<?php
require_once(getRootPath('templates/footer.php'));
?>