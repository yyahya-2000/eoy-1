<!DOCTYPE html>
<html lang="ru">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/navbar.php'; ?>

<div class="row first-row">
	<ol class="col-12 breadcrumb">
		<li class="breadcrumb-item"><a href="/groups">Группы</a></li>
		<li class="breadcrumb-item active">Запись <?= $id; ?></li>
	</ol>
</div>

<div class="row row-content">
	<div class="col-12 col-md-9 offset-1">
		<form method="post" action="/groups/index.php?id=<?= $id; ?>">
			<div class="form-group row">
				<label for="groupname" class="col-md-2 col-form-lable">Название группы</label>
				<div class="col-md-10">
					<input type="text" class="form-control" id="groupname" name="groupname"
					       placeholder="Название группы(может только содержит латинские и русские буквы, пробелы и числа)"
					       value="<?= $group["name"] ?>" minlength="5" maxlength="250"
					       pattern="^[0-9A-Za-zА-Яа-яЁё\s]+$" required>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-10">
					<button type="submit" class="btn btn-primary" name="edit-group">Сохранить</button>
				</div>
			</div>
		</form>
	</div>
</div>
<footer></footer>
</body>
</html>
