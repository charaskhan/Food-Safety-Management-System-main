<?php
include('./secure.php');
include_once('./connection.php');

define('INGREDIENT_ID', $_GET['ingredient_id']);
$query_result = $conn->prepare("SELECT * FROM ingredient WHERE ingredient_id = ?");
$query_result->execute([INGREDIENT_ID]);

while ($ingredient_row = $query_result->fetch(PDO::FETCH_OBJ)) {
  $ingredient_name = $ingredient_row->ingredient_name;
  $ingredient_cost = $ingredient_row->ingredient_cost;
  $purchase_date = $ingredient_row->purchase_date;
  $expire_date = $ingredient_row->expire_date;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FSMS - Updating Ingredient</title>
  <link rel="icon" type="image/x-icon" href="../images/logo.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .btn:hover {
      background-color: #ffff00;
      color: #000;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <header class="text-center py-4">
    <h1 class="text-2xl font-bold">Updating Ingredient</h1>
  </header>

  <main>
    <div class="container mx-auto mt-4">
      <form action="process_update.php" method="POST">
        <div class="rounded-lg shadow-lg bg-white p-6">
          <div class="flex items-center justify-center">
            <div class="w-1/4">
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                  Update Name
                </label>
                <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" id="ingredient-name" type="text" value="<?php echo $ingredient_name ?>" name="ingredient_name" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                  Update Ingredient
                </label>
                <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" id="ingredient-cost" value="<?php echo $ingredient_cost ?>" name="ingredient_cost" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                  Update Purchase Date
                </label>
                <input type="date" id="purchase-date" class="border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $purchase_date ?>" name="purchase_date" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                  Update Expire Date
                </label>
                <input type="date" id="expire-date" class="border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $expire_date ?>" name="expire_date" />
              </div>
              <div class="mb-4">
                <input type="hidden" name="update_ingredient" value="<?php echo INGREDIENT_ID; ?>" />
                <input type="submit" class="btn" value="Update" />
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</body>

</html>