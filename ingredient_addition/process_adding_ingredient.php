
<?php
include('../secure.php');

if (isset($_GET['ingredient_submitted'])) {
    include_once('../connection.php');


    $ingredient_name = $_GET['ingredient_name'];
    $ingredient_id = strtolower(substr(str_replace(" ", "", $ingredient_name), 0, 4)) . substr(time(), -4);

    $ingredient_cost = $_GET['ingredient_cost'];
    $purchase_date = $_GET['purchase_date'];
    $expire_date = $_GET['expire_date'];

    $supp_name = $_GET['supp_name'];
    $supp_phone = $_GET['supp_phone'];
    $supp_country = $_GET['supp_country'];

    $allergy_type = $_GET['allergy_type'];
    $allergy_severity = $_GET['severity_level'];

    $query = $conn->prepare("INSERT INTO allergy (allergy_type, allergy_severity) VALUES (?, ?)");
    $query->execute([$allergy_type, $allergy_severity]);

    $query = $conn->prepare("INSERT INTO supplier (supp_name, supp_phone, supp_country) VALUES (?, ?, ?)");
    $query->execute([$supp_name, $supp_phone, $supp_country]);

    $query = $conn->query("SELECT allergy_num FROM allergy ORDER BY allergy_num DESC LIMIT 1");
    $row = $query->fetch(PDO::FETCH_OBJ);
    $allergy_num = $row->allergy_num;

    $query = $conn->query("SELECT supp_num FROM supplier ORDER BY supp_num DESC LIMIT 1");
    $row = $query->fetch(PDO::FETCH_OBJ);
    $supp_num = $row->supp_num;

    $query = $conn->prepare("INSERT INTO ingredient (ingredient_id, ingredient_name, ingredient_cost, purchase_date, expire_date, allergy_type, supplier) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->execute([$ingredient_id, $ingredient_name, $ingredient_cost, $purchase_date, $expire_date, $allergy_num, $supp_num]);

    echo "Ingredient Added Successfully In the Inventory\n";
    header("Location: ../home.php");
} else {
    echo "Ingredient Addion Failed\n";
}
