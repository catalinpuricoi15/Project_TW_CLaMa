<?php /***
 * @var $model \models\User;
 */
?>
<div class="main-box">
    <div class="page-aligned">

        <?php $form = \core\form\Form::begin('newClass', "post", 'newClass') ?>

        <?php echo $form->field($model, 'subject') ?>

        <input type="hidden" name="idUser" value="<?php echo \core\Application::$app->user->id; ?>">

        <?php echo $form->field($model, 'numberOfAssignments') ?>

        <button type="submit" class="submit-btn" name="addClass" id="addClass">Adauga clasa</button>

        <?php echo \core\form\Form::end() ?>

    </div>
</div>