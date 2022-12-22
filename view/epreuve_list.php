<?php
	ob_start();
	echo '<h2>Les épreuves</h2>';
	echo '<table border="0" width="100%" bgcolor="#acacac" cellspacing="1" cellpadding="4">';
	while($dt1=$req1->fetch()){
		echo '<tr>';
		if(isset($_GET['test_id']) && $_GET['test_id']==$dt1['test_id']){
			$bg='#efefef';
			echo '<td bgcolor="'.$bg.'"><a style="color:#000000">'.$dt1['test_word'].'</a></td>';
		}else{
			echo '<td bgcolor="#ffffff"><a href="index.php?controller=control_question&test_id='.$dt1['test_id'].'" style="color:#000000" title="consultez le jeu de questionnaire">'.$dt1['test_word'].'</a></td>';
		}
		echo '</tr>';
	}
	echo '</table>';
	$content = ob_get_clean();
