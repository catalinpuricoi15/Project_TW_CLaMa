<?php

use core\Application;

?>

<!DOCTYPE html> 
<html lang="en">

<head>
    <title>ClassHub</title>
    <link rel="stylesheet" href="/css/auth.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ClassHub">
</head>

<body>

<div class="main-box ">
    <?php if (Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-succes">
            <?php echo Application::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
</div>

<div class="auth-section">
    <div>
        <img src='/images/svg/ClassHub.svg' alt='Official logo' class="logo">
    </div>

    <div class="auth-box">
        <div class="button-auth-box">
            <div id="btn"></div>
            <button type="button" name="btnLogin" class="toggle-btn" onclick="login()">Log In</button>
            <button type="button" name="btnRegister" class="toggle-btn" onclick="register()">Register</button>
        </div>

        {{content}}

    </div>
</div>

<script src="/js/auth.js"></script>

</body>

</html>