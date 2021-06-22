<?php /***
 * @var $model \models\User;
 */

use core\form\Form;

?>

<!--Login-->
<?php $form = Form::begin('login', "post", 'login') ?>

<?php echo $form->field($model, 'email') ?>

<?php echo $form->field($model, 'password') ?>

<button type="submit" class="submit-btn" name="button-login" id="button-login">Log In</button>

<?php echo Form::end() ?>

<!--Register-->


<?php $form = Form::begin('register', "post", 'register') ?>

<?php echo $form->field($model, 'username') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo $form->field($model, 'firstname') ?>
<?php echo $form->field($model, 'lastname') ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<?php echo $form->field($model, 'confirmPassword')->passwordField() ?>

<p class="space">Doresc sa creez un cont de:</p>
<div class="space">
    <input type="radio" name="type" id="radio-student" value="student">
    <label>Student</label>

    <input type="radio" name="type" id="radio-profesor" value="profesor">
    <label>Profesor </label>
</div>

<button type="submit" class="submit-btn" name="button-register" id="button-register">Register</button>

<?php echo Form::end() ?>

