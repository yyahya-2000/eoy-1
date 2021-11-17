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
					<th>Студент</th>
					<th>Предмет</th>
					<th>Оценка</th>
					<th>Действия</th>
				</tr>
				</thead>
				<tbody>
				<?php while($grade = mysqli_fetch_array($grades)) { ?>
					<tr>
						<td><?= $grade["id"]; ?></td>
						<td><?= $grade["student"]; ?></td>
						<td><?= $grade["discipline"]; ?></td>
						<td><?= $grade["grad"]; ?></td>
						<td>
							<div class="btn-group" role="group">
								<a role="button" class="btn btn-primary"
								   href="/grades/editGrade.php?id=<?= $grade["id"]; ?>">
									Изменить
								</a>
								<a role="button" class="btn btn-danger"
								   href="/grades/index.php?id-delete=<?= $grade["id"]; ?>">
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
		<button onclick="window.location='addGrade.php';"  class="btn btn-primary">Создать</button>
	</div>
</div>
<footer></footer>
<script src=""></script>
</body>
</html>
