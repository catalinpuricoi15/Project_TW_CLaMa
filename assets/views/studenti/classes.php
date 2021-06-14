<link rel="stylesheet" href="../../CSS/clases.css">

<div class="main-box ">

    <div id="actions" class="page-aligned">
        <br><br><br><br>
        <input type="text" class="input-field" placeholder="Introdu id-ul clasei" name="id" id="id" required>
        <button type="submit" class="submit-btn" name="submit-btn" id="submit-btn"> adauga clasa</button>

    </div>

    <div id="classes" class="page-aligned">


        <div id="class-123" class="class" onclick='goToClass("123")'>
            <div class="class-name"> Tehnologii WEB</div>
            <div class="class-info">
                <div class="class-id"> #123</div>
                <div class="class-supervisor"> Prof. Cosmin Varlan <br> Prof. Buraga Sabin</div>
            </div>
        </div>


        <div id="class-321" class="class" onclick='goToClass("321")'>
            <div class="class-name"> SGBD</div>
            <div class="class-info">
                <div class="class-id"> #321</div>
                <div class="class-supervisor"> Prof. Cosmin Varlan</div>
            </div>
        </div>


    </div>

</div>

<script src="../../JS/clases.js"></script>
