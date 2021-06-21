

<div class="main-box ">

    <div id="actions" class="page-aligned">
        <br><br><br><br>
        <?php if (!core\Application::$app->user->isStudent()): ?>
            <a class="submit-btn" name="submit-btn" id="submit-btn" href="/newClass"> creeaza o noua clasa</a>
        <?php else: ?>

            <div id="actions" class="page-aligned">
                <br><br><br><br>
                <?php $form = \core\form\Form::begin('/newRequest', "post", 'newRequest') ?>
                <input type="text" class="input-field" placeholder="Introdu id-ul clasei" name="code" id="code" required>
                <input type="hidden" name="idUser" value="<?php echo \core\Application::$app->user->id ?>">
                <button type="submit" class="submit-btn" name="submit-btn" id="submit-btn"> adauga clasa</button>
                <?php echo \core\form\Form::end() ?>
            </div>
        <?php endif; ?>


    </div>
    <div id="classes" class="page-aligned">


        <?php foreach ($classes as $class): ?>
            <div id="class-123" class="class" onclick='goToClass(<?php echo $class->id ?>)'>
                <div class="class-name"><?php echo $class->subject ?></div>
                <div class="class-info">
                    <div class="class-id"> <?php echo $class->code ?></div>
                    <div class="class-supervisor"><?php echo $class->owner()->getFullName() ?></div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</div>

<script src="../js/classes.js"></script>
