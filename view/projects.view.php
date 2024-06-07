<?php ob_start(); ?>
<table class="table">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nom</th>
			<th scope="col">Description</th>
			<th scope="col">Stack</th>
			<th scope="col">IMG</th>
			<th scope="col" colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($projects as $project) : ?>
			<?php if (empty($_POST['project_id']) || $_POST['project_id'] !== (string)$project['project_id']) : ?>
				<tr>
					<td><?= $project['project_id'] ?></td>
					<td><?= $project['project_name'] ?></td>
					<td><?= $project['project_description'] ?></td>
					<td><?= $project['project_stack'] ?></td>
					<td><img width="50px" height="50px" src="<?= URL ?>public/image/<?= $project['project_image'] ?>" alt="">

					<td>
						<form method="post" action="">
							<input type="hidden" name="project_id" value=<?= $project['project_id'] ?>>
							<button class="btn btn-warning m-2">Modifier</button>
						</form>
					</td>
					<td>
						<form method="post" action="<?= URL ?>projets/validationSuppression" onSubmit="return confirm('Voulez-vous vraiment supprimé?')">
							<input type="hidden" name="project_id" value=<?= $project['project_id'] ?>>
							<button class="btn btn-danger m-2">Supprimer</button>
						</form>
					</td>
				</tr>
			<?php else : ?>
				<form method="post" action="<?= URL ?>projets/validationModification" enctype="multipart/form-data">
					<tr>
						<td>
							<?= $project['project_id'] ?>
						</td>
						<td>
							<input class="form-control" type="text" name="project_name" value=<?= $project['project_name'] ?>>
						</td>
						<td>
							<textarea class="form-control" type="text" name="project_description" rows="3"><?= $project['project_description'] ?></textarea>
						</td>
						<td>
							<textarea class="form-control" type="text" name="project_stack" rows="3"><?= $project['project_stack'] ?></textarea>
						</td>
						<td>
							<div>
								<label for="project_image">Image</label>
								<input type="file" name="project_image" class="form-control-file" id="project_image" aria-describedby="project_imageHelp">

							</div>
							<img class="m-2" width="30px" height="30px" src="<?= URL ?>public/image/<?= $project['project_image'] ?>" alt="<?= $project['project_name'] ?>">

						</td>
						<td colspan="2">
							<input type="hidden" name="project_id" value=<?= $project['project_id'] ?>>
							<button class="btn btn-warning m-2">Valider</button>
						</td>
					</tr>
				</form>
			<?php endif ?>
		<?php endforeach; ?>
	</tbody>
</table>

<?php
$content = ob_get_clean();
$titre = "Mes Projects";
require_once "view/component/template.php";
