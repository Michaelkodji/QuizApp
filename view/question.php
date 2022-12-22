<?php
    require('./view/epreuve_list.php');
    ob_start();
?>
<h2>Les questionnaires</h2>
<form action="index.php?controller=control_question&test_id=<?=$_GET['test_id'] ?>" method="POST">
	<input type="text" name="question_note" id="question_note" placeholder="point" required /><br />
	<input type="text" name="question_word" id="question_word" placeholder="Intitulé de la question" required style="width:407px;" /><br />
	<input type="text" name="answer_good" id="answer_good" placeholder="Bonne réponse" required style="width:407px;" /><br>
	<input type="text" name="answer_bad1" id="answer_bad1" placeholder="Mauvaise réponse" required style="width:407px;" /><br>
	<input type="text" name="answer_bad2" id="answer_bad2" placeholder="Mauvaise réponse" required style="width:407px;" /><br>
	
	<input type="hidden" name="test_id" id="test_id" value="<?=$_GET['test_id'] ?>" readonly />
	<input type="hidden" name="question_id" id="question_id" readonly />
	<input type="hidden" name="answer_good_id" id="answer_good_id" readonly />
	<input type="hidden" name="answer_bad1_id" id="answer_bad1_id" readonly />
	<input type="hidden" name="answer_bad2_id" id="answer_bad2_id" readonly />
	<div id="btn"><input type="submit" name="btn" value="ajouter" /></div>
</form>
<?php 
	if($req->rowCount()==0){
		echo '<table border="0" width="600" bgcolor="#acacac" cellspacing="1" cellpadding="4">';
		echo '<tr><td height="100" align="center" bgcolor="#ffffff">Aucune question inscrite pour cette épreuve</td></tr>';
		echo '</table>';
	}else{
		$ini=0;
		while($dt=$req->fetch()){
			if($ini==0){
				echo '<table border="0" width="600" bgcolor="#acacac" cellspacing="1" cellpadding="4">'; 
				$ini++;
			}else{
				echo '<br /><table border="0" width="600" bgcolor="#acacac" cellspacing="1" cellpadding="4">';
			}
			echo '<tr><td bgcolor="#ffffff" colspan="2"><b>Q: '.$dt['question_word'].'</b></td></tr>';
			echo '<tr><td bgcolor="#efefef" colspan="2" style="font-weigth:bold"> Points :  '.$dt['question_note'].'</td></tr>';
			$field='*'; $table='answer'; $condition='question_id=?'; $data=array($dt['question_id']);
			$r=$sql->readWhere($table,$field,$condition,$data);
			$idrep=''; $tyrep=''; $rep=''; $cp=0;
			while($dt1=$r->fetch()){
				if($dt1['answer_type']=='good'){
					echo '<tr><td width="30%" bgcolor="#ffffff">bonne reponse</td><td bgcolor="#ffffff">'.$dt1['answer_word'].'</td></tr>';
				}else{
					echo '<tr><td width="30%" bgcolor="#ffffff">Mauvaise reponse</td><td bgcolor="#ffffff">'.$dt1['answer_word'].'</td></tr>';
				}            
				$idrep.=($cp==0)? $dt1['answer_id'] : ';'.$dt1['answer_id'];
				$rep.=($cp==0)? $dt1['answer_word'] : ';'.$dt1['answer_word'];
				$tyrep.=($cp==0)? $dt1['answer_type'] : ';'.$dt1['answer_type'];
				$cp++;
			}
			$data = $_GET['test_id'].';'.$dt['question_id'].';'.$dt['question_word'].';'.$dt['question_note'];
			echo '<tr><td bgcolor="#ffffff" colspan="2">';
			echo '<a onClick="questionUpdate(\''.$data.'\',\''.$idrep.'\',\''.$rep.'\',\''.$tyrep.'\')"><b>&#9998;</b></a> &nbsp; ';
			echo '<a href="index.php?controller=control_question&task=del&test_id='.$_GET['test_id'].'&question_id='.$dt['question_id'].'"><b>&cross;</b></a>';
			echo '</td></tr></table>';
		}
	}
	$editor=ob_get_clean();
	require('template.php');
?>