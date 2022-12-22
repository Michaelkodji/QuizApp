<html>
    <head><link rel="stylesheet" type="text/css" href="./public/ui.css" /></head>
    <body>
		<header>
			<h1>QCM Editor</h1>
			<nav>
				<ul>
					<li><a href="index.php?controller=control_epreuve">editer epreuve</a></li>
					<li><a>exporter en json</a></li>
					<li><a href="index.php?controller=control_logout">deconnexion</a></li>
				</ul>
			</nav>
		</header>
		<?php
			if($notice!=''){
				echo '<div style="width:1000px; margin:auto; margin-top:20px; padding:10px; text-align:center; border:1px solid #acacac; background:#efefef;">'.$notice.'</div>';
			}
		?>
		<section>
			<div class="ui"><?=$content ?></div>
			<div class="ui"><?=$editor ?></div>
		</section>
		<footer></footer>
        <script src="./public/ui.js"></script>
    </body>
</html>