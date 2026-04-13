<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: Georgia, serif;
            margin: 0;
            background: #f6f7fb;
            color: #1f2937;
        }
        .container {
            width: 90%;
            max-width: 860px;
            margin: 0 auto;
            padding: 24px 0 40px;
        }
        .hero {
            background: linear-gradient(120deg, #0f172a, #1d4ed8);
            color: #fff;
            padding: 28px 0;
        }
        .hero h1 {
            margin: 0;
            font-size: 2rem;
        }
        .hero p {
            margin: 8px 0 0;
            opacity: 0.9;
        }
        .nav {
            margin-top: 12px;
        }
        .nav a {
            color: #dbeafe;
            margin-right: 14px;
            text-decoration: none;
            font-size: 0.95rem;
        }
        .post-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
        }
        .post-card h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }
        .post-card a,
        .post-link {
            color: #1d4ed8;
            text-decoration: none;
        }
        .meta {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 14px;
        }
        .notice {
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            color: #3730a3;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 14px;
        }
        .error {
            color: #991b1b;
            margin-bottom: 12px;
        }
        .field {
            margin-bottom: 12px;
        }
        .field label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        .field input,
        .field textarea,
        .field select {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font: inherit;
        }
        .btn {
            display: inline-block;
            background: #1d4ed8;
            color: #fff;
            text-decoration: none;
            border: 0;
            border-radius: 6px;
            padding: 10px 14px;
            cursor: pointer;
            font: inherit;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>
<body>
<header class="hero">
    <div class="container">
        <h1>CodeIgniter Weblog</h1>
        <p>MySQL-backed training app for CodeIgniter 2.2.0</p>
        <nav class="nav">
            <a href="<?php echo site_url('blog'); ?>">Blog</a>
            <?php if ($this->session->userdata('user_id')): ?>
                <a href="<?php echo site_url('admin'); ?>">Admin</a>
                <a href="<?php echo site_url('logout'); ?>">Logout (<?php echo $this->session->userdata('username'); ?>)</a>
            <?php else: ?>
                <a href="<?php echo site_url('login'); ?>">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
