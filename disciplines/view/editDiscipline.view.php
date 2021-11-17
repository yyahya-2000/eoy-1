<!DOCTYPE html>
<html lang="ru">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/navbar.php'; ?>
<div class="row first-row">
	<ol class="col-12 breadcrumb">
		<li class="breadcrumb-item"><a href="/disciplines">Предметы</a></li>
		<li class="breadcrumb-item active">Запись <?= $id; ?></li>
	</ol>
</div>

<div class="row row-content">
	<div class="col-12 col-md-9 offset-1">
		<form method="post" action="/disciplines/index.php?id=<?= $id; ?>">
			<div class="form-group row">
				<label for="discipline-name" class="col-md-3 col-form-lable">Название предмета</label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="discipline-name" name="discipline-name"
					       placeholder="Название предмета(может только содержит латинские и русские буквы, пробелы и числа)"
					       value="<?= $discipline["name"] ?>" minlength="5" maxlength="250"
					       pattern="^[0-9A-Za-zА-Яа-яЁё\s]+$" required>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-10">
					<button type="submit" class="btn btn-primary" name="edit-discipline">Сохранить</button>
				</div>
			</div>
		</form>
	</div>
</div>
<footer></footer>
</body>
</html>
