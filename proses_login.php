<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug data form
    var_dump($_POST);

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        die("Username dan password harus diisi!");
    }

    // Query database
    $qry = $koneksi->prepare("SELECT * FROM users WHERE username=?");
    if (!$qry) {
        die("Error prepare: " . $koneksi->error);
    }
    $qry->bind_param("s", $username);
    if (!$qry->execute()) {
        die("Error execute: " . $qry->error);
    }

    $result = $qry->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['status_login'] = true;
            $_SESSION['username'] = $username; 
            $_SESSION['user_id'] = $user['id']; 
            header("Location: index.php");
            exit;
        } else {
            die("Password salah!");
        }
    } else {
        die("User tidak ditemukan!");
    }
} else {
    die("Metode request tidak valid!");
}
?>
