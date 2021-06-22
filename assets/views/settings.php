<?php /***
* @var $this \core\View
 */

use core\form\Form;

?>

<link rel="stylesheet" href="../css/settings.css">

<br>
<br>
<br>
<br>
<div class="auth-box">

    <?php $form = Form::begin("/settings", "post", 'updateAccountData') ?>

    <?php echo $form->field(\core\Application::$app->user, 'username') ?>
    <?php echo $form->field(\core\Application::$app->user, 'adress') ?>
    <?php echo $form->field(\core\Application::$app->user, 'city') ?>

    <button type="submit" class="submit-btn space" id="submit-btn">Save</button>

    <?php echo Form::end() ?>

</div>