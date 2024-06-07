<?php ob_start(); ?>
<form method="post" action="<?= URL ?>projets/validationCreation" enctype="multipart/form-data">
  <div class="form-group">
    <label for="project_name">Nom du projet</label>
    <input type="text" name="project_name" class="form-control" id="project_name" aria-describedby="project_nameHelp">
  </div>
  <div class="form-group">
    <label for="project_description">Description</label>
    <input type="text" name="project_description" class="form-control" id="project_description" aria-describedby="project_descriptionHelp">
  </div>
  <div class="form-group">
    <label for="project_stack">Stack</label>
    <input type="text" name="project_stack" class="form-control" id="project_stack" aria-describedby="project_stackHelp">
  </div>
  <div class="form-group">
    <label for="project_image">Image</label>
    <input type="file" name="project_image" class="form-control-file" id="project_image" aria-describedby="project_imageHelp">
  </div> 
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php
$content = ob_get_clean();
$titre = "Creation nouveau projet";
require_once "view/component/template.php";