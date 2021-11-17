<!DOCTYPE html>
<html lang="ru">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/navbar.php'; ?>

<div class="row first-row">
	<ol class="col-12 breadcrumb">
		<li class="breadcrumb-item"><a href="/students">Студенты</a></li>
		<li class="breadcrumb-item active">Запись <?= $id; ?></li>
	</ol>
</div>

<div class="row row-content">
	<div class="col-12 col-md-9 offset-1">
		<form method="post" action="/students/index.php?id=<?= $id; ?>">
			<div class="form-group row">
				<label for="student-name" class="col-md-2 col-form-label">Имя студента</label>
				<div class="col-md-10">
					<input type="text" class="form-control" id="student-name" name="student-name"
					       placeholder="Имя студента(может только содержит латинские и русские буквы, пробелы и числа)"
					       value="<?= $student["name"] ?>" minlength="5" maxlength="250"
					       pattern="^[0-9A-Za-zА-Яа-яЁё\s]+$" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="group-id" class="col-md-2 col-form-label">Груупа</label>
				<div class="col-md-3">
					<select class="form-control" name="group-id" id="group-id" required>
						<option value="">None</option>
						<?php  while ($group = mysqli_fetch_array($groups))
						{
							$selected = $group["name"] == $student["group_"]
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
				<div class="col-md-10">
					<button type="submit" class="btn btn-primary" name="edit-student">Сохранить</button>
				</div>
			</div>
		</form>
	</div>
</div>
<footer></footer>
</body>
</html>
