<?php
/** @var $this \core\View  */

$this->title = 'ClassHub-Settings';

?>

<link rel="stylesheet" href="../css/settings.css">

<br>
<br>
<br>
<br>
<div class="auth-box">

    <form id="register" class="register-group">
        <input type="text" class="input-field" placeholder="Utilizator" name="username" id="username" required>
        <input type="text" class="input-field" placeholder="Noua parola:" name="password" id="password"
               required>
        <input type="text" class="input-field space" placeholder="Confirma parola" name="password"
               id="confirmPassword" required>
        <input type="text" class="input-field space" placeholder="Adresa" name="adress" id="adress" required>
        <input type="text" class="input-field space" placeholder="Oras" name="city" id="city" required>
        <input type="text" class="input-field space" placeholder="Facultate" name="facultate" id="facultate"
               required>
        <button type="submit" class="submit-btn space" name="submit-btn" id="submit-btn">Save</button>

    </form>
</div>

<script src="../js/home.js"> </script>