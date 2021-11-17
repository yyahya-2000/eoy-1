<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand mr-auto" href="/"><img src="/images/logo.png" height="30" width="130"></a>
		<div class="collapse navbar-collapse" id="Navbar">
			<ul class="navbar-nav">
				<li class="nav-item <?= $_SERVER["REQUEST_URI"] == "/" ? "active" : "" ?>">
					<a class="nav-link" href="/"> Рейтинг студентов </a>
				</li>
				<li class="nav-item <?= strpos($_SERVER["REQUEST_URI"], '/groups/') !== false ?
					"active" : "" ?>">
					<a class="nav-link" href="/groups"> Группы</a>
				</li>
				<li class="nav-item <?= strpos($_SERVER["REQUEST_URI"], '/students/') !== false ?
					"active" : "" ?>">
					<a class="nav-link" href="/students"> Студенты </a>
				</li>
				<li class="nav-item <?= strpos($_SERVER["REQUEST_URI"], '/grades/') !== false ?
					"active" : "" ?>">
					<a class="nav-link" href="/grades"> Оценки </a>
				</li>
				<li class="nav-item <?= strpos($_SERVER["REQUEST_URI"], '/disciplines/') !== false ?
					"active" : "" ?>">
					<a class="nav-link" href="/disciplines"> Предметы </a>
				</li>
				<li class="nav-item <?= strpos($_SERVER["REQUEST_URI"], '/group_discipline_links/') !== false ?
					"active" : "" ?>">
					<a class="nav-link" href="/group_discipline_links"> Связь: группы-предметы </a>
				</li>
			</ul>
		</div>
	</div>
</nav>