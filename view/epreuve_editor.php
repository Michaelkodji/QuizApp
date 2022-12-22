<?php ob_start();?>
<h2>Editer épreuve</h2>
<form action="index.php?controller=control_epreuve" method="POST">
	<input type="text" name="duration" id="duration" placeholder="temps" required style="width:80px;" />
	<input type="text" name="word" id="word" placeholder="libelle de l'épreuve" required style="width:407px;" />
	<input type="hidden" name="test_id" id="test_id">
	<div id="btn"><input type="submit" name="btn" value="ajouter" /></div>
</form>
<?php $editor=ob_get_clean();?>