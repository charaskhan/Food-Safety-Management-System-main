<?php
include('./secure.php');
include_once('./connection.php');

if (isset($_POST['update_chef'])) {

    $chef_username = $_POST['update_chef'];
    $chef_fname = $_POST['chef_fname'];
    $chef_lname = $_POST['chef_lname'];
    $chef_age = $_POST['chef_age'];
    $chef_gender = $_POST['chef_gender'];
    $chef_password = $_POST['chef_password'];

    $query = $conn->prepare("UPDATE chef SET chef_fname = ?, chef_lname = ?, chef_age = ?, chef_gender = ?, chef_password = ? WHERE chef_username = ?");
    $query->execute([$chef_fname, $chef_lname, $chef_age, $chef_gender, $chef_password, $chef_username]);

    header("Location: personal_info.php");
}

if (isset($_POST['update_ingredient'])) {

    $ingredient_id = $_POST['update_ingredient'];
    $ingredient_name = $_POST['ingredient_name'];
    $ingredient_cost = $_POST['ingredient_cost'];
    $purchase_date = $_POST['purchase_date'];
    $expire_date = $_POST['expire_date'];

    $query = $conn->prepare("UPDATE ingredient SET ingredient_name = ?, ingredient_cost = ?, purchase_date = ?, expire_date = ? WHERE ingredient_id = ?");
    $query->execute([$ingredient_name, $ingredient_cost, $purchase_date, $expire_date, $ingredient_id]);

    header("Location: home.php");
}
