<!DOCTYPE html>
<html lang="ru">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/navbar.php'; ?>

<div class="row first-row">
	<ol class="col-12 breadcrumb">
		<li class="breadcrumb-item"><a href="/grades">Оценки</a></li>
		<li class="breadcrumb-item active">Запись <?= $id; ?></li>
	</ol>
</div>

<div class="row row-content">
	<div class="col-12 col-md-9 offset-1">
		<form method="post" action="/grades/index.php?id=<?= $id; ?>">
			<div class="form-group row">
				<label for="student-id" class="col-md-2 col-form-label">Имя студента</label>
				<div class="col-md-3">
					<select class="form-control" name="student-id" id="student-id" required disabled="disabled">
						<option selected>
							<?= $grade["student"]; ?>
						</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="discipline-id" class="col-md-2 col-form-label">Предмет</label>
				<div class="col-md-3">
					<select class="form-control" name="discipline-id" id="discipline-id" required disabled="disabled">
						<option selected>
							<?= $grade["discipline"]; ?>
						</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="grade" class="col-md-2 col-form-label">Оценка</label>
				<div class="col-md-3">
					<input type="number" step="1" min="0" max="10" class="form-control" id="grade" name="grade"
					       placeholder="Оценка" value="<?= $grade["grade"]; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-10">
					<button type="submit" class="btn btn-primary" name="edit-grade">Сохранить</button>
				</div>
			</div>
		</form>
	</div>
</div>
<footer></footer>
</body>
</html>
