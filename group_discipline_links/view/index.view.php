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
					<th>Группа</th>
					<th>Предмет</th>
					<th>Действия</th>
				</tr>
				</thead>
				<tbody>
				<?php while($gdLink = mysqli_fetch_array($gdLinks)) { ?>
					<tr>
						<td><?= $gdLink["group_"]; ?></td>
						<td><?= $gdLink["discipline"]; ?></td>
						<td>
							<div class="btn-group" role="group">
								<a role="button" class="btn btn-primary"
								   href="/group_discipline_links/editGDLink.php?id-group=<?= $gdLink["id_group"]; ?>&
									id-discipline=<?= $gdLink["id_disc"]; ?>">
									Изменить
								</a>
								<a role="button" class="btn btn-danger"
								   href="/group_discipline_links/index.php?
									id-group-delete=<?= $gdLink["id_group"]; ?>&
									id-discipline-delete=<?= $gdLink["id_disc"]; ?>">
									Удалить
								</a>
							</div>
						</td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-12 col-sm-9 offset-1">
		<button onclick="window.location='addGDLink.php';"  class="btn btn-primary">Создать</button>
	</div>
</div>
<footer></footer>
</body>
</html>
