<?php ob_start(); ?>
<form method="POST" action="<?= URL ?>connexion">
  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
$content = ob_get_clean();
$titre = "Login";
require_once "view/component/template.php";