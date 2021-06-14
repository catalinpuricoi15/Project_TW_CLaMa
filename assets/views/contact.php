<?php
use core\form\TextareaField;

/** @var $this \core\View */
/** @var $model \models\ContactForm */

$this->title = 'ClassHub-Contact';

?>

    <h1> Contact </h1>
<?php $form = \core\form\Form::begin('', 'post', '') ?>

<?php echo $form->field($model, 'subject') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new TextareaField($model, 'body')?>
    <button type="submit" class="btn btn-primary">Trimite</button>

<?php \core\form\Form::end() ?>
