<?php
include('../secure.php');
include_once('../connection.php');

$sql = "SELECT ingredient_id, ingredient_name FROM ingredient";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FSMS - Meal Status Checking</title>
  <link rel="icon" type="image/x-icon" href="../images/logo.png" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <div class="flex">
    <div class="w-1/4 h-screen bg-gray-900 text-white flex flex-col justify-center">
      <ul class="ml-3 mt-10">
        <li class="mb-4"><a href="../home.php" class="hover:text-blue-200 font-medium">Home</a></li>
        <li class="mb-4"><a href="../personal_info.php" class="hover:text-blue-200 font-medium">Personal Info</a></li>
        <li class="mb-4"><a href="../ingredient_addition/adding_ingredient.php" class="hover:text-blue-200 font-medium">Ingredient Addition</a></li>
        <li class="mb-4"><a href="status_checking.php" class="hover:text-blue-200 font-medium">Meal Status Checking</a></li>
        <li class="mt-10"><a class="block bg-white text-blue-500 py-2 px-2 rounded-full mr-6 text-center" href='../logout.php'>Logout</a></li>
      </ul>
    </div>
    <div class="w-3/4 h-screen bg-white flex flex-col justify-center items-center overflow-y-auto">
      <header class="w-full text-center py-4 text-black">
        <h1 class="text-2xl font-bold my-4">Meal Status Checking</h1>
        <h1 class="text-lg">Enter Meal Details</h1>
      </header>
      <main class="w-full">
        <div class="container mx-auto">
          <div class="rounded-lg shadow-lg bg-white p-6">
            <div class="flex items-center justify-center">
              <form class="w-1/4" action="process_status_checking.php" method="POST">
                <div class="mb-4">
                  <label class="block text-gray-700 font-bold mb-2">
                    Meal Name
                  </label>
                  <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" type="text" placeholder="Enter Meal Name" name="meal_name" />
                </div>
                <div class="mb-4">
                  <label class="block text-gray-700 font-bold mb-2">
                    Select Date
                  </label>
                  <input type="date" id="date-input" class="border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="action_date" />
                </div>
                <div class="mb-4">
                  <label class="block text-gray-700 font-bold mb-2">
                    Category
                  </label>
                  <select class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" name="meal_category">
                    <option value="Non-Vegetarian">Non-Vegetarian</option>
                    <option value="Vegetarian">Vegetarian</option>
                    <option value="Vegan">Vegan</option>
                  </select>
                </div>
                <div class="mb-4 relative inline-block text-left">
                  <button class="inline-flex w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 " id="dropdown-button">
                    Select Ingredients
                    <strong id="hero-icon" class="ml-6">˅</strong>
                  </button>
                  <div id="ingredients-container" class="py-1 hidden max-h-20 overflow-y-auto" role="none">
                    <?php while ($row = $result->fetch(PDO::FETCH_OBJ)) : ?>
                      <input type="checkbox" class="fetched-ingredients" value="<?php echo "$row->ingredient_id,$row->ingredient_name" ?>" name="selected_ingredients[]">
                      <span> <?php echo $row->ingredient_name ?> </span>
                    <?php endwhile; ?>
                  </div>
                  <input type="hidden" name="checked_status" value=1>
                  <input class="mt-6 bg-black text-white hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit" value="Check Status">
                </div>
                <div class="mb-4 mt-4">
                  <h1 class="block text-gray-700 font-bold mb-2">Selected Ingredients:</h1>
                  <ul id="selected-ingredients"></ul>
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="status_checking.js" defer></script>
</body>

</html>