
<div class="logo">
    <img src='../Images/SVG/ClassHub.svg' class="imageClassHub" alt="ClassHub">
</div>
<div class="user">
    <div class="col-2 flex-container flex-row">
        <div class="userImage">
            <img src='../Images/SVG/UserCircle.svg' class="userImage2" alt="User Circle">
        </div>
        <a class="row-2" href="/profile" onclick="">
            <?php echo core\Application::$app->user->getDisplayType() ?>
        </a>
    </div>

    <div class="col-2">
        <?php echo core\Application::$app->user->getDisplayUsername() ?>
    </div>
</div>
