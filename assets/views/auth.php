<? php /***
 * @var $model \models\User;
 */
?>

    <!--Login-->
    <?php $form = \core\form\Form::begin('', "post", 'login') ?>

        <?php echo $form->field($model, 'email') ?>

        <?php echo $form->field($model, 'password') ?>

        <button type="submit" class="submit-btn" name="button-login" id="button-login">Log In</button>

    <?php echo \core\form\Form::end() ?>

    <!--Register-->
    <?php $form = \core\form\Form::begin('', "post", 'register') ?>

        <?php echo $form->field($model, 'username') ?>
        <?php echo $form->field($model, 'email') ?>
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

    <?php echo \core\form\Form::end() ?>

