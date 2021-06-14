<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php use core\Application;

        echo $this->title ?></title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>

<div class="sidebar box">
    <div class=" btn-toolbox" onclick="goTo('/home')">
        <img src='../images/svg/LOGOweb.svg' class="align-center-svg" alt="LOGO web">
    </div>
    <div class="active btn-toolbox" onclick="goTo('/orar')">
        <img src='../images/svg/CalendarX.svg' class="align-center-svg" alt="Calendar">
        <div class="align-center-text space">Orar</div>
    </div>
    <div class=" btn-toolbox" onclick="goTo('/classes')">
        <img src='../images/svg/Users.svg' class="align-center-svg" alt="Users">
        <div class="align-center-text">Clase</div>
    </div>
    <div class=" btn-toolbox" onclick="goTo('/settings')">
        <img src='../images/svg/SettingsBtn.svg' class="align-center-svg" alt="Setting">
        <div class="align-center-text">Setari</div>
    </div>
    <div class=" btn-toolbox" onclick="goTo('/logout')">
        <img src='../images/svg/UserLogOut.svg' class="align-center-svg" alt='User LogOut'>
        <div class="align-center-text">Logout</div>
    </div>

</div>


<div class="content">

    <div id="header" class="header">

        <?php if(!core\Application::isGuest()): ?>
            <?php include_once "../assets/views/components/topNav.php"?>
        <?php endif; ?>
        {{content}}

    </div>

</div>

<script src="../js/main.js"></script>

</body>

</html>