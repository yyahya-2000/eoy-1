<!DOCTYPE html>
<html lang="ru">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/common/navbar.php'; ?>

<div class="row row-content first-row">
	<div class="col-12 col-md-9 offset-1">
		<form method="GET" action="">
			<div class="form-group row">
				<label for="group-id" class="col-md-2 col-form-label">Груупа</label>
				<div class="col-md-3 offset-md-1">
					<select class="form-control" name="group-id" id="group-id">
						<?php while ($group = mysqli_fetch_array($groups)) { ?>
							<option value="<?= $group["id"]; ?>"><?= $group["name"]; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-10">
					<button type="submit" class="btn btn-primary">Построить рейтинг</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-12 col-md">
	</div>
</div>
<div class="row row-content ">
	<div class="col-12 col-sm-9 offset-1">
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead class="thead-dark">
				<tr>
					<th>Студенты</th>
					<?php
					if (isset($_GET["group-id"]))
					{
						while ($disc = mysqli_fetch_array($disciplinesResult))
						{
							?>
							<th><?= $disc["name"]; ?></th>
							<?php
							$disciplines[] = $disc["name"];
						}
					}
					?>
				</tr>
				</thead>
				<tbody>
				<?php
				if (isset($_GET["group-id"]))
				{
					while ($row = mysqli_fetch_array($studentRating))
					{
						?>
						<tr>
							<th><?= $row["name"]; ?></th>
							<?php
							$grades = explode(";", $row["grades"]);
							$i = 1;
							$grade = explode("->", $grades[0]);
							foreach ($disciplines as $discipline)
							{
								?>
								<td class="text-center"
								    bgcolor="<?= $grade[0] == $discipline && $grade[1] < 4 ? "red" : "" ?>">
									<?php
									if ($grade[0] == $discipline)
									{

										echo $grade[1];
										$grade = explode("->", $grades[$i++]);
										continue;
									}
									echo "";
									?>
								</td>
								<?php
							}
							?>
						</tr>
						<?php
					}
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-12 col-sm-3"></div>
</div>
<footer></footer>
</body>
</html>
