<div class="topNav">
    <div class="logo">
        <img src='/images/svg/ClassHub.svg' class="imageClassHub" alt="ClassHub">
    </div>
    <div class="user">
        <div class="col-2 flex-container flex-row">
            <div class="userImage">
                <img src='/images/svg/UserCircle.svg' class="userImage2" alt="User Circle" onclick=goTo('/settings')>
            </div>
            <a class="row-2">
                <?php echo core\Application::$app->user->getDisplayType() ?>
            </a>
        </div>

        <div class="col-2">
            <?php echo core\Application::$app->user->getFullName() ?>
        </div>
    </div>
</div>
