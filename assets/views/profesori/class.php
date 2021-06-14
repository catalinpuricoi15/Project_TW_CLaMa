<link rel="stylesheet" href="../../CSS/news.css">
<link rel="stylesheet" href="../../CSS/classes.css">
<div class="main-box ">

    <div id="info" class="page-aligned">
        <br><br><br>
        <h1 class="highlited " style="text-decoration: underline;">Informatii clasa</h1><br>
        <br>
        <span class="highlited"> Nume </span> <span id="name"> </span><br>
        <br>
        <span class="highlited"> Id </span> <span id="id"> </span><br>
        <br>
        <span class="highlited"> Platforme </span> Zoom, Discord
        <br><br>
        <span class="highlited"> Orar </span> Luni 9:00 - 12:00
        <br><br>
    </div>

    <br><br>

    <div id="actions" class="page-aligned">
        <button type="button" class="page-btn" onclick="doAction('/catalog')">catalog</button>
        <button type="button" class="page-btn" onclick="doAction('/requests')">requests</button>
        <button type="button" class="page-btn" onclick="doAction('/attendance')">prezenta curs</button>
    </div>

    <br><br>
    <br><br>
    <form class="post-form">
        <h2><b> Posteaza o noutate sau tema </b></h2><br><br>
        <input id="post_title" type="text" class="input-field" placeholder="Title" required><br><br>
        <input id="post_content" type="text" class="input-field" placeholder="Content" required><br><br>
        <div>
            <input type="checkbox" class="check-box" id="check-assignment" name="check-assignment"
                   onclick="postTypeChanged()">
            <label for="check-assignment">Tema</label>
        </div>
        <br>
        <div id="date-assignment-div" style="display:none">
            <label for="date-assignment">Data predarii </label>
            <input type="date" id="date-assignment" name="date-assignment" required>
        </div>
        <br>

        <label class="space" for="file-upload">Incarca un fisier:</label>
        <input type="file" id="file-upload" name="file-upload">

        <br>
        <button type="button" class="submit-btn space" onclick="postNews()">Post</button>
    </form>

    <br><br><br><br>

    <div class="news-title">
        <h3><b> Noutati si Teme </b></h3>
    </div>
    <div id="news" class="news-panel">
        <div id="post" class="post news">
            <div class="post-title"> Lectura de vacanta</div>
            <div class="post-info">
                <div class="post-date"> primavara 2021</div>
                <div class="post-author"> autor</div>
            </div>
            <div class="post-content news-description"> ...</div>
        </div>

        <div id="assignment-001" class="post assignment" onclick="assignmentClick('assignment-001')">
            <div class="post-title"> Tema 2021</div>
            <div class="post-info">
                <div class="post-date"> deadline: azi</div>
                <div class="post-author"> autor</div>
            </div>
            <div class="post-content assignment-description"> Buna ziua! Aceasta este tema pentru saptamana 2.
            </div>
        </div>
    </div>

</div>

<script src="../../JS/class.js"> </script>
<script src="../../JS/news.js"> </script>