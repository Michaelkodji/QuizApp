<?php
	require('./view/epreuve_editor.php');
	ob_start();
	echo '<h2>Les épreuves</h2>';
	echo '<table border="0" width="100%" bgcolor="#acacac" cellspacing="1" cellpadding="4">';
	$bg = '#ffffff';
	if($req->rowCount()==0){
		echo '<tr><td align="center" height="100" bgcolor="#ffffff">Votre base de données d\'épreuve est vide</td></tr>';
	}else{
		while($dt=$req->fetch()){
			$data = $dt['test_id'].';'.$dt['test_word'].';'.$dt['test_duration'];
			echo '<tr>';
			echo '<td bgcolor="'.$bg.'" width="16"><a onClick="testUpdate(\''.$data.'\')" style="color:#000000; font-weight:bold;">&#9998;</a></td>';
			echo '<td bgcolor="'.$bg.'" width="16"><a href="index.php?controller=control_epreuve&task=sup&test_id='.$dt['test_id'].'" style="color:#000000; font-weight:bold;">&cross;</a></td>';
			echo '<td bgcolor="'.$bg.'"><a href="index.php?controller=control_question&test_id='.$dt['test_id'].'" style="color:#000000;" >'.$dt['test_word'].'</a></td>';
			echo '<td bgcolor="'.$bg.'"><a href="index.php?controller=control_question&test_id='.$dt['test_id'].'" style="color:#000000;" >'.$dt['test_duration'].'</a></td>';
			echo '</tr>';
			$bg = ($bg=='#efefef')? '#ffffff' : '#efefef';
		}
	}
	
	echo '</table>';
	$content=ob_get_clean();
	require('template.php');
?>