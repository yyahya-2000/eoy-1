<!DOCTYPE html>
<html lang="ru">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
<script>
    window.onload = function () {
        document.getElementById('group-id').addEventListener('change', function () {
            let studentSelect = document.getElementById('student-id');
            while (studentSelect.options.length > 0) {
                studentSelect.remove(0);
            }

            let disciplineSelect = document.getElementById('discipline-id');
            while (disciplineSelect.options.length > 0) {
                disciplineSelect.remove(0);
            }

            if (this.value !== "") {
                let students = <?= json_encode($studentsByGroup); ?>;
                for (let i = 0; i < students[this.value].length; i++) {
                    if (students[this.value][i][0] !== "") {
                        let opt = document.createElement('option');
                        opt.value = students[this.value][i][0];
                        opt.innerHTML = students[this.value][i][1];
                        studentSelect.appendChild(opt);
                    }
                }

                let disciplines = <?= json_encode($disciplinesByGroup); ?>;
                for (let i = 0; i < disciplines[this.value].length; i++) {
                    if (disciplines[this.value][i][0] !== "") {
                        let opt = document.createElement('option');
                        opt.value = disciplines[this.value][i][0];
                        opt.innerHTML = disciplines[this.value][i][1];
                        disciplineSelect.appendChild(opt);
                    }
                }
            }
        });
    }
</script>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/navbar.php'; ?>
<div class="row first-row">
	<ol class="col-12 breadcrumb">
		<li class="breadcrumb-item"><a href="/grades">Оценки</a></li>
		<li class="breadcrumb-item active">Новая запись</li>
	</ol>
</div>

<div class="row row-content">
	<div class="col-12 col-md-9 offset-1">
		<form method="post" action="/grades/index.php">
			<div class="form-group row">
				<label for="group-id" class="col-md-2 col-form-label">Группа</label>
				<div class="col-md-3">
					<select class="form-control" name="group-id" id="group-id" required>
						<option value="">None</option>
						<?php while ($group = mysqli_fetch_array($groups)) { ?>
							<option value="<?= $group["name"]; ?>"><?= $group["name"]; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="student-id" class="col-md-2 col-form-label">Имя студента</label>
				<div class="col-md-3">
					<select class="form-control" name="student-id" id="student-id" required>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="discipline-id" class="col-md-2 col-form-label">Предмет</label>
				<div class="col-md-3">
					<select class="form-control" name="discipline-id" id="discipline-id" required>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="grade" class="col-md-2 col-form-label">Оценка</label>
				<div class="col-md-3">
					<input type="number" step="1" min="0" max="10" class="form-control" id="grade" name="grade"
					       placeholder="Оценка" required>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-10">
					<button type="submit" class="btn btn-primary" name="add-grade">Сохранить</button>
				</div>
			</div>
		</form>
	</div>
</div>
<footer></footer>
</body>
</html>
