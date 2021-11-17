<!DOCTYPE html>
<html lang="ru">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/navbar.php'; ?>

<div class="row row-content first-row">
	<div class="col-12 col-sm-9 offset-1">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead class="thead-dark">
				<tr>
					<th>id</th>
					<th>Предмет</th>
					<th>Действия</th>
				</tr>
				</thead>
				<tbody>
				<?php while($discipline = mysqli_fetch_array($disciplines)) { ?>
					<tr>
						<td><?= $discipline["id"]; ?></td>
						<td><?= $discipline["name"]; ?></td>
						<td>
							<div class="btn-group" role="group">
								<a role="button" class="btn btn-primary"
								   href="/disciplines/editDiscipline.php?id=<?= $discipline["id"]; ?>">
									Изменить
								</a>
								<a role="button" class="btn btn-danger"
								   href="/disciplines/index.php?id-delete=<?= $discipline["id"]; ?>">
									Удалить
								</a>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-12 col-sm-9 offset-1">
		<button onclick="window.location='addDiscipline.php';"  class="btn btn-primary">Создать</button>
	</div>
</div>
<footer></footer>
</body>
</html>
