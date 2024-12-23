<?php
session_start();
if (!isset($_SESSION['chef_username']) || !isset($_SESSION['chef_password'])) {
    header("Location: index.html");
    exit();
}
