<?php
require_once(dirname(__DIR__, 2) . '/utils/paths.php');
require_once(getRootPath('templates/header.php'));
require_once(getRootPath('services/auth.php'));
require_once(getRootPath('services/products.php'));
require_once(getRootPath('services/categories.php'));

if (!isAuth()) {
  redirect('/');
}

$categories = getCategories();

$title = "Админка - Создание продукта";
$error = null;

if (array_key_exists('name', $_POST) && array_key_exists('category_id', $_POST)) {
  if (!empty($_POST['name']) && !empty($_POST['category_id'])) {
    $name = htmlspecialchars($_POST['name']);
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null;
    $price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : null;
    $category_id = isset($_POST['category_id']) ? htmlspecialchars($_POST['category_id']) : null;
    $quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : null;

    echo $name . '<br>';
    echo $price . '<br>';
    echo $description . '<br>';
    echo $category_id . '<br>';
    echo $quantity . '<br>';

    if (addProduct($name, $price, $description, $category_id, $quantity)) {
      redirect('/admin/products');
    } else {
      $error = 'Ошибка при создании продукта';
    }
  } else {
    $error = 'Заполните все данные';
  }
}
?>

<h1 class="mb-4">Создание продукта</h1>

<?php
if ($error) {
  showError($error);
}
?>

<form action="#" method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">Название</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>

  <div class="mb-3">
    <label for="category" class="form-label">Категория</label>
    <select class="form-select" id="category" name="category_id" required>
      <option value="">Выберите категорию</option>
      <?php foreach ($categories as $category): ?>
        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="price" class="form-label">Цена</label>
    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
  </div>

  <div class="mb-3">
    <label for="quantity" class="form-label">Количество</label>
    <input type="number" class="form-control" id="quantity" name="quantity" required>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Описание</label>
    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Создать</button>
  <a href="/admin/products/" class="btn btn-secondary">Отмена</a>
</form>

<?php
require_once(getRootPath('templates/footer.php'));
?>