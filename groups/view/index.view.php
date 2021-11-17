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
					<th>Группа</th>
					<th>Действия</th>
				</tr>
				</thead>
				<tbody>
				<?php while($group = mysqli_fetch_array($groups)) { ?>
					<tr>
						<td><?= $group["id"]; ?></td>
						<td><?= $group["name"]; ?></td>
						<td>
							<div class="btn-group" role="group">
								<a role="button" class="btn btn-primary"
								   href="/groups/editGroup.php?id=<?= $group["id"]; ?>">
									Изменить
								</a>
								<a role="button" class="btn btn-danger"
								   href="/groups/index.php?id-delete=<?= $group["id"]; ?>">
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
		<button onclick="window.location='addGroup.php';"  class="btn btn-primary">Создать</button>
	</div>
</div>
<footer></footer>
</body>
</html>
