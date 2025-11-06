<?php
    // ====================================================================
    // KONFIGURASI UNTUK WINDOWaS (XAMPP / WAMP)
    // ====================================================================

    // $host = "localhost";
    // $user = "root";
    // $pass = "";
    // $db   = "sewa_mobil";

    // $conn = mysqli_connect($host, $user, $pass, $db);

    // if (!$conn) {
    //     die("Koneksi gagal (Windows): " . mysqli_connect_error());
    // }

    // if (session_status() == PHP_SESSION_NONE) {
    //     session_start();
    // }


    // ====================================================================
    // KONFIGURASI UNTUK LINUX (Fedora / Ubuntu / Apache)
    // ====================================================================

    $host = "127.0.0.1";
    $user = "admin";                   // user MySQL Linux
    $pass = "royhanganteng123";        // password MySQL Linux
    $db   = "sewa_mobil";

    // Koneksi database
    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Koneksi gagal (Linux): " . mysqli_connect_error());
    }

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
