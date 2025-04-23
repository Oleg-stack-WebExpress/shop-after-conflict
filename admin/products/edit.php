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

$title = "Админка - Редактирование продукта";
$error = null;

$product_id = $_GET['id'] ?? null;
if ($product_id == null) {
  redirect('/admin/products');
}

$product = getProduct($product_id);

if (array_key_exists('name', $_POST) && array_key_exists('category_id', $_POST)) {
  if (!empty($_POST['name']) && !empty($_POST['category_id'])) {
    $name = htmlspecialchars($_POST['name']);
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null;
    $price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : null;
    $category_id = isset($_POST['category_id']) ? htmlspecialchars($_POST['category_id']) : null;
    $quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : null;

    if (updateProduct($product_id, $name, $price, $description, $category_id, $quantity)) {
      redirect('/admin/products');
    } else {
      $error = 'Ошибка при редактировании продукта';
    }
  } else {
    $error = 'Заполните все данные';
  }
}
?>

<h1 class="mb-4">Редактирование продукта <?php echo $product['name']; ?></h1>

<?php
if ($error) {
  showError($error);
}
?>

<form action="#" method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">Название</label>
    <input type="text" class="form-control" id="name" name="name" value="<?= $product['name']; ?>" required>
  </div>

  <div class="mb-3">
    <label for="category" class="form-label">Категория</label>
    <select class="form-select" id="category" name="category_id" required>
      <option value="">Выберите категорию</option>
      <?php foreach ($categories as $category): ?>
        <option value="<?php echo $category['id']; ?>" <?php echo $product['category_id'] == $category['id'] ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="price" class="form-label">Цена</label>
    <input type="number" class="form-control" id="price" name="price" value="<?= $price['price']; ?>" required>
  </div>

  <div class="mb-3">
    <label for="quantity" class="form-label">Количество</label>
    <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>"
      required>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Описание</label>
    <textarea class="form-control" id="description" name="description"
      rows="3"><?= $product['description']; ?></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Сохранить</button>
  <a href="/admin/products" class="btn btn-secondary">Отмена</a>
</form>

<?php require_once(getRootPath('templates/footer.php')); ?>