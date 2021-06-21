<?php
/** @var $this \core\View */

$this->title = 'ClassHub-Settings';

?>

<link rel="stylesheet" href="../css/settings.css">

<br>
<br>
<br>
<br>
<div class="auth-box">

    <?php $form = \core\form\Form::begin("/settings", "post", 'updateAccountData') ?>

    <?php echo $form->field(\core\Application::$app->user, 'username') ?>
    <?php echo $form->field(\core\Application::$app->user, 'adress') ?>
    <?php echo $form->field(\core\Application::$app->user, 'city') ?>

    <button type="submit" class="submit-btn space" id="submit-btn">Save</button>

    <?php echo \core\form\Form::end() ?>

</div>

<script src="../js/home.js"></script>