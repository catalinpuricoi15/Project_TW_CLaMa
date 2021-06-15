<? php /***
 * @var $model \models\User;
 */
?>

<div class="main-box ">

    <div id="info" class="page-aligned">
        <br><br><br>
        <h1 class="highlited " style="text-decoration: underline;">Informatii clasa</h1><br>
        <br>
        <span class="highlited">Name: </span> <span id="name"> <?php echo $class->subject ?>  </span><br>
        <br>
        <span class="highlited"> Codul: </span> <span id="id"> <?php echo $class->code ?>  </span><br>
        <br>
        <span class="highlited"> Platforme </span> Zoom, Discord
        <br><br>
        <span class="highlited"> Orar </span> Luni 9:00 - 12:00
        <br><br>
    </div>

    <br><br>

    <?php if (!core\Application::$app->user->isStudent()): ?>

        <div id="actions" class="page-aligned">
            <button type="button" class="page-btn" onclick="doAction('/catalog')">catalog</button>
            <a class="page-btn" href="/class/request/<?php echo $class->id ?>">requests</a>
            <button type="button" class="page-btn" onclick="doAction('/attendance')">prezenta curs</button>
        </div>

        <br><br>
        <br><br>
        <?php if ($class->numberOfAssignments != 0): ?>
            <?php $form = \core\form\Form::begin('/newAssignment', "post", 'newAssignment') ?>

            <div class="post-form">
                <h2><b> Posteaza o noutate sau tema </b></h2><br><br>

                <?php echo $form->field($model, 'title') ?>

                <!--            <input id="post_title" type="text" class="input-field" placeholder="Title" required><br><br>-->

                <?php echo $form->field($model, 'requirement') ?>

                <input type="hidden" name="idClass" value="<?php echo $class->id; ?>">

                <?php echo $form->field($model, 'deadline')->dateField() ?>

                <button type="submit" class="submit-btn space">Post</button>
            </div>
            <?php echo \core\form\Form::end() ?>
        <?php else: ?>
            <?php $form = \core\form\Form::begin("/changeNrOfAssignments/$class->id", "post", 'changeNrAssignment') ?>
            <?php echo $form->field($class, 'numberOfAssignments') ?>
            <button type="submit" class="submit-btn space">Post</button>
            <?php echo \core\form\Form::end() ?>
        <?php endif; ?>

        <br><br><br><br>

    <?php endif; ?>

    <div class="news-title">
        <h3><b> Noutati si Teme </b></h3>
    </div>

    <?php foreach ($assignments as $assignment): ?>
        <div id="news" class="news-panel">
            <div id="post" class="post news">
                <div class="post-title"> <?php echo $assignment->title ?></div>
                <?php var_dump($assignment->getStudentsWork()) ?>
                <div class="post-info">
                    <div class="post-date"> <?php echo $assignment->created_at ?> </div>
                    <div class="post-date"> <?php echo $assignment->deadline ?> </div>
                    <div class="post-author"> autor</div>
                </div>
                <div class="post-content news-description"> <?php echo $assignment->requirement ?></div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<!---->
<!--<script src="../../JS/class.js"></script>-->
<!--<script src="../../JS/news.js"></script>-->