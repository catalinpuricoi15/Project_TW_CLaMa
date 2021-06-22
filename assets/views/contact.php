<?php /***

* @var $this \core\View
* @var $model \models\ContactForm
*/

use core\form\Form;
use core\form\TextareaField;

?>

    <h1> Contact </h1>
<?php $form = Form::begin('', 'post', '') ?>

<?php echo $form->field($model, 'subject') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new TextareaField($model, 'body')?>
    <button type="submit" class="btn btn-primary">Trimite</button>

<?php Form::end() ?>
