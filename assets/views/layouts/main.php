<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php use core\Application;

        echo $this->title ?></title>

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/classes.css">
    <link rel="stylesheet" href="/css/news.css">
    <link rel="stylesheet" href="/css/settings.css">
    <link rel="stylesheet" href="/css/requests.css">
    <link rel="stylesheet" href="/css/helpers.css">
    <link rel="stylesheet" href="/css/catalog.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

<div class="sidebar box smallHidden">
    <div class=" btn-toolbox" onclick="goTo('/home')">
        <img src='/images/svg/LOGOweb.svg' class="align-center-svg" alt="LOGO web">
    </div>
    <div class="active btn-toolbox" onclick="goTo('/orar')">
        <img src='/images/svg/CalendarX.svg' class="align-center-svg" alt="Calendar">
        <div class="align-center-text space">Orar</div>
    </div>
    <div class=" btn-toolbox" onclick="goTo('/classes')">
        <img src='/images/svg/Users.svg' class="align-center-svg" alt="Users">
        <div class="align-center-text">Clase</div>
    </div>
    <div class=" btn-toolbox" onclick="goTo('/settings')">
        <img src='/images/svg/SettingsBtn.svg' class="align-center-svg" alt="Setting">
        <div class="align-center-text">Setari</div>
    </div>
    <div class=" btn-toolbox" onclick="goTo('/logout')">
        <img src='/images/svg/UserLogOut.svg' class="align-center-svg" alt='User LogOut'>
        <div class="align-center-text">Logout</div>
    </div>

</div>


<div class="content">

    <?php if (core\Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-succes">
            <?php echo core\Application::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <div id="header" class="header">

        <?php if (!core\Application::isGuest()): ?>
            <?php include_once "../assets/views/components/topNav.php" ?>
        <?php endif; ?>

    </div>
    {{content}}

</div>

<script src="/js/main.js"></script>

</body>

</html>