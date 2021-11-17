<!DOCTYPE html>
<html lang="ru">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/navbar.php'; ?>

<div class="row first-row">
	<ol class="col-12 breadcrumb">
		<li class="breadcrumb-item"><a href="/group_discipline_links">
				Связь: группы-предметы</a></li>
		<li class="breadcrumb-item active">Запись <?= $_GET["id-group"] . " " . $_GET["id-discipline"]; ?></li>
	</ol>
</div>

<?php

?>

<div class="row row-content">
	<div class="col-12 col-md-9 offset-1">
		<form method="post" action="/group_discipline_links/index.php?id-group=<?= $idGroup; ?>&
				id-discipline=<?= $idDiscipline; ?>">
			<div class="form-group row">
				<label for="group-id" class="col-md-2 col-form-label">Группа</label>
				<div class="col-md-3">
					<select class="form-control" name="group-id" id="group-id" required>
						<option value="">None</option>
						<?php while ($group = mysqli_fetch_array($groups))
						{
							$selected = $group["name"] == $gdLink["group_"]
							?>
							<option <?= $selected ? "selected" : ""; ?> value="<?= $group["id"]; ?>">
								<?= $group["name"]; ?>
							</option>
							<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="discipline-id" class="col-md-2 col-form-label">Предмет</label>
				<div class="col-md-3">
					<select class="form-control" name="discipline-id" id="discipline-id" required>
						<option value="">None</option>
						<?php while ($discipline = mysqli_fetch_array($disciplines))
						{
							$selected = $discipline["name"] == $gdLink["discipline"]
							?>
							<option <?= $selected ? "selected" : ""; ?> value="<?= $discipline["id"]; ?>">
								<?= $discipline["name"]; ?>
							</option>
							<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-10">
					<button type="submit" class="btn btn-primary" name="edit-g-d-link">Сохранить</button>
				</div>
			</div>
		</form>
	</div>
</div>
<footer></footer>
</body>
</html>
