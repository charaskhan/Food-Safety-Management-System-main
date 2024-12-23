<?php

include_once('./connection.php');
session_start();

if (isset($_POST['logged_in'])) {
    $chef_username = $_POST['chef_username'];
    $chef_password = $_POST['chef_password'];

    $hashed_chef_password = password_hash($chef_password, PASSWORD_DEFAULT);

    $query = $conn->prepare("SELECT * FROM chef WHERE chef_username = ?");
    $query->execute([$chef_username]);

    $row = $query->fetch(PDO::FETCH_OBJ);

    if ($chef_username === $row->chef_username && password_verify($chef_password, $row->chef_password)) {
        $_SESSION['chef_username'] = $chef_username;
        $_SESSION['chef_password'] = $hashed_chef_password;

        header('Location: home.php');
        exit();
    } else {
        header('Location: login.html');
        echo 'Invalid username or password';
    }
}

if (isset($_POST['signed_up'])) {
    $chef_username = $_POST['chef_username'];
    $chef_fname = $_POST['chef_fname'];
    $chef_lname = $_POST['chef_lname'];
    $chef_age = $_POST['chef_age'];
    $chef_gender = $_POST['chef_gender'];
    $chef_password = $_POST['chef_password'];

    $hashed_chef_password = password_hash($chef_password, PASSWORD_DEFAULT);

    $query = $conn->prepare("INSERT INTO chef VALUES (?, ?, ?, ?, ?, ?)");
    $query->execute([$chef_username, $chef_fname, $chef_lname, $chef_age, $chef_gender, $hashed_chef_password]);

    $_SESSION['chef_username'] = $chef_username;
    $_SESSION['chef_password'] = $hashed_chef_password;

    header('Location: login.html');
}
