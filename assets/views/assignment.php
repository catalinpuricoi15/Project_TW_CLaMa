<? php /***
 * @var $assignment \models\Assignment;
 * @var $works \models\Work;
 */
?>

<div class="main-box ">

    <div class="page-aligned">
        <?php use core\Application;
        use core\form\Form;
        use models\Assignment;
        use models\Attendance;

        if (Application::$app->user->isStudent() != 'student'): ?>
        <br><br>
        <h1 id="attendance-code">
            Generati codul pentru prezenta laborator:

            <?php $form = Form::begin('/createCodAttendance', "post", 'createCodAttendance') ?>
            <input type="hidden" class="" name="idAssignment" value="<?php echo $assignment->id ?>">
            <button type="submit" class="page-btn"> Cod prezenta</button>
            <?php echo Form::end() ?>
            <?php if ($assignment->code_attendance != ''): ?>
            <br>
                <h3>Codul este valabil 10 minute: <?php echo $assignment->code_attendance ?></h3>
            <?php endif; ?>

            <?php else: ?>

                <?php if (!Attendance::confirmAttendance(Application::$app->user->id, $assignment->id)
                    && $assignment->code_attendance != ""
                    && !Assignment::codeHasExpired($assignment->attendance_created_at)): ?>

                    <h3>Codul este valabil 10 minute. Adaugati codul pentru prezenta laborator:</h3>
                    <br>
                    <?php $form = Form::begin('/confirmAttendance', "post", 'confirmAttendance') ?>
                    <input type="hidden" class="" name="idAssignment" value="<?php echo $assignment->id ?>">
                    <input type="text" class="" name="codAttendance" placeholder="Adaugare cod">
                    <button type="submit" class="page-btn"> Cod prezenta</button>
                    <?php echo Form::end() ?>
                <?php endif; ?>
            <?php endif; ?>
        </h1>
        <br>
        <br>

        <h1>Istoric tema</h1>
        <br>
        <br>
    </div>

    <div id="news" class="news-panel">
        <?php if (Application::$app->user->isStudent() != 'professor'): ?>
            <?php foreach ($works as $work): ?>
                <div id="post1" class="post news">
                    <div class="post-title">
                        <div><?php echo $work->getStudent()->getFullName() ?>  </div>
                        <div class="align-start flex">Nota:
                            <?php $form = \core\form\Form::begin('/addGrade', "post", 'addGrade') ?>
                            <input type="text" name="grade" placeholder="Adauga o nota, ex = 9.50"
                                   value="<?php echo $work->grade != 0 ? $work->grade : '' ?>" class=""> / 10
                            <input type="hidden" name="idWork" value="<?php echo $work->id ?>">
                            <button type="submit"> Salveaza nota</button>
                            <?php echo \core\form\Form::end() ?>
                        </div>
                    </div>
                    <div class="post-content news-description"><?php echo $work->comment ?></div>
                    <a class="post-content news-description" href="<?php echo $work->file ?>" download="">Fisier
                        incarcat</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php if ($studentWork == false): ?>

                <?php $form = Form::begin('/newWork', "post", 'newWork') ?>

                <div class="post-form">
                    <h2><b> Incarca tema: </b></h2><br><br>

                    <?php echo $form->field($model, 'comment') ?>

                    <?php echo $form->field($model, 'file')->fileField() ?>

                    <input type="hidden" name="idAssignment" value="<?php echo $assignment->id; ?>">

                    <input type="hidden" name="idUser" value="<?php echo Application::$app->user->id; ?>">

                    <button type="submit" class="submit-btn space">Post</button>

                </div>
                <?php echo Form::end() ?>
            <?php else: ?>
                <div id="post1" class="post news">
                    <div class="post-title">
                        <div><?php echo $studentWork->getStudent()->getFullName() ?>  </div>
                        <div class="align-start flex">Nota: <?php echo $studentWork->getGrade() ?> / 10</div>
                    </div>
                    <div class="post-content news-description"><?php echo $studentWork->comment ?></div>
                    <a class="post-content news-description" href="<?php echo $studentWork->file ?>" download="">Fisier
                        incarcat</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>
