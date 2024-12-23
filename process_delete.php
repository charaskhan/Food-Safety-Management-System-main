<?php
include('./secure.php');
include_once('./connection.php');

if (isset($_POST['delete_chef'])) {
    $chef_username = $_POST['delete_chef'];
    $query = $conn->prepare("DELETE FROM chef WHERE chef_username = ?");
    $query->execute([$chef_username]);

    header('Location: signup.html');
    exit();
}

if (isset($_POST['delete_ingredient'])) {
    $ingredient_id = $_POST['delete_ingredient'];
    $query = $conn->prepare("DELETE FROM ingredient WHERE ingredient_id = ?");
    $query->execute([$ingredient_id]);

    header('Location: home.php');
    exit();
}

if (isset($_POST['delete_allergy'])) {
    $allergy_num = $_POST['delete_allergy'];
    $query = $conn->prepare("DELETE FROM allergy WHERE allergy_num = ?");
    $query->execute([$allergy_num]);

    header('Location: home.php');
    exit();
}

if (isset($_POST['delete_supplier'])) {
    $supp_num = $_POST['delete_supplier'];
    $query = $conn->prepare("DELETE FROM supplier WHERE supp_num = ?");

    try {
        $query->execute([$supp_num]);
    } catch (Exception $e) {
        echo "failed: $e";
    }
    header('Location: home.php');
    exit();
}
