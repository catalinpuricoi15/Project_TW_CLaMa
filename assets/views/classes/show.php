<?php

use core\form\Form;
use models\Assignment;
use models\ClassForm;

?>

<div class="main-box ">

    <div id="info" class="page-aligned">
        <br><br><br>
        <h1 class="highlited " style="text-decoration: underline;">Informatii clasa</h1><br>
        <br>
        <span class="highlited">Nume: </span> <span id="name"> <?php echo $class->subject ?>  </span><br>
        <br>
        <span class="highlited"> Codul: </span> <span id="id"> <?php echo $class->code ?>  </span><br>
        <br>
        <span class="highlited"> Platforme: </span> Zoom, Discord
        <br><br>
        <span class="highlited"> Orar: </span> Luni 9:00 - 12:00
        <br><br>
    </div>

    <br><br>

    <?php if (!core\Application::$app->user->isStudent()): ?>

        <div id="actions" class="page-aligned">
            <a class="page-btn" href="/class/catalog/<?php echo $class->id ?>">catalog</a>
            <a class="page-btn" href="/class/request/<?php echo $class->id ?>">requests</a>
        </div>

        <br><br>
        <br><br>
        <?php if ($class->numberOfAssignments != 0): ?>
            <?php $form = Form::begin('/newAssignment', "post", 'newAssignment') ?>

            <div class="post-form">
                <h2><b> Posteaza o noutate sau tema </b></h2><br><br>

                <?php echo $form->field($model, 'title') ?>

                <?php echo $form->field($model, 'requirement') ?>

                <input type="hidden" name="idClass" value="<?php echo $class->id; ?>">

                <?php echo $form->field($model, 'deadline')->dateField() ?>

                <?php echo $form->field($model, 'file')->fileField() ?>

                <button type="submit" class="submit-btn space">Post</button>
            </div>
            <?php echo Form::end() ?>
        <?php else: ?>
            <?php $form = Form::begin("/changeNrOfAssignments/$class->id", "post", 'changeNrAssignment') ?>
            <?php echo $form->field($class, 'numberOfAssignments') ?>
            <button type="submit" class="submit-btn space">Post</button>
            <?php echo Form::end() ?>
        <?php endif; ?>

        <br><br><br><br>

    <?php endif; ?>

    <div class="news-title">
        <h3><b> Noutati si Teme </b></h3>
    </div>

    <?php foreach ($assignments as $assignment): ?>

        <a  class="news-panel" href="/class/assignment/<?php echo $assignment->id ?>">
            <div  class="post news">
                <div class="post-title">
                    <div class="post-title"> <?php echo $assignment->title ?></div>
                    <div class="post-info">
                        <div class="post-date">Deadline: <?php echo $assignment->deadline ?> </div>
                        <div class="post-author"> <?php echo $class->owner()->getFullName() ?> </div>
                    </div>
                    <div class="post-content news-description"> <?php echo $assignment->requirement ?></div>
                    <?php if ($assignment->file != ''): ?>
                        <a class="post-content news-description" href="<?php echo $assignment->file ?>" download="">Fisier
                            incarcat</a>
                    <?php endif; ?>
                </div>
            </div>
        </a>
    <?php endforeach; ?>

</div>