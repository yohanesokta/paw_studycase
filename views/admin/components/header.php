<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Laundry Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/admin.css">
</head>
<body>

<?php require 'sidebar.php'; ?>

<div class="main-content">
    <nav class="navbar navbar-light bg-white rounded shadow-sm mb-4 p-3">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 fw-bold text-secondary">
                <?= isset($title) ? $title : 'Dashboard' ?>
            </span>
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted small">Halo, Admin</span>
                <img src="<?= $_SESSION['userdata']['profile'] ?> ?>" class="rounded-circle border" alt="Profile">
            </div>
        </div>
    </nav>