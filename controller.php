<?php 
	require("model.php");
	
	function control_login(){
		$sql=new crud(); $notice=(isset($_GET['notice']))? $_GET['notice'].'<br />' : '';
		if(isset($_POST["btn"])){
			$table="member"; $field="*"; $condition='member_phone=?'; $data=array($_POST["phone"]);
			$req=$sql->readWhere($table,$field,$condition,$data);
			if($req->rowCount()==1){
				$donnes=$req->fetch();
				if(password_verify($_POST['pwd'],$donnes['member_pwd'])){
					$_SESSION['member_id'] = $donnes["member_id"];
					$_SESSION['member_name'] = $donnes["member_name"];
					$_SESSION['member_phone'] = $donnes["member_phone"];
					$_SESSION['member_status'] = $donnes["member_status"];
					header("location:index.php?controller=control_epreuve");
				}else{
					$notice='<b>Erreur ! </b>Les mots de passes non conforme';
				}
			}else{
				$notice='<b>Erreur ! </b>Numero de telephone non conforme';
			}
		}
		require("./view/connexion.php");
	}
	
	function control_logout(){
		session_destroy();
		header('location:index.php');
	}
	
	function control_signup(){
		$sql=new crud(); $notice='';
		if(isset($_POST["btn"])){
			$table="member"; $field="member_id"; $condition="member_phone=?"; $data=array($_POST["phone"]);
			$req=$sql->readWhere($field,$table,$condition,$data);
			if($req->rowCount()!=0){ 
				$notice = '<b>Erreur ! </b>Ce numero de telephone est deja dans notre base</h1>';
			}else{
				if($_POST['pwd']!=$_POST['confirm']){
					$notice = "<b>Erreur ! </b>les mots de passe ne concorde pas";
				}else{
					$table="member"; $field='member_name,member_phone,member_mail,member_pwd'; $value='?,?,?,?';
					$data=array(htmlentities($_POST["name"]),htmlentities($_POST["phone"]),htmlentities($_POST["mail"]),htmlentities(password_hash($_POST['pwd'],PASSWORD_DEFAULT)));
					$sql->add($table,$field,$value,$data);
					$notice = "Felicitation ! votre compte est créé. veuillez vous authentifier";
					header('location: index.php?condition=control_login&notice='.$notice.'');
				}
			}
		}
		require("./view/signup.php");
	}
	
	function control_epreuve(){
        $sql=new crud(); $notice='';
        if(isset($_POST['btn']) && $_POST['btn']=='ajouter'){
			$table='test'; $field='test_word,test_duration,member_id'; $value='?,?,?'; $data=array($_POST['word'],$_POST['duration'],$_SESSION['member_id']);
            $sql->add($table,$field,$value,$data);
			$notice ='<b>Felicitation ! </b>la nouvelle épreuve a été créée avec succè';
        }elseif(isset($_POST['btn'])&& $_POST['btn']=='modifier'){
            $table='test'; $field='test_word=? , test_duration=?'; $condition='test_id =?'; $data=array($_POST['word'],$_POST['duration'],$_POST['test_id']);
            $sql->up($table,$field,$condition,$data);
			$notice ='<b>Felicitation ! </b>le libellé de l\'épreuve a été mise à jour';
        }
        if(isset($_GET['task']) && $_GET['task']=='sup'){
			$table='question'; $field='*'; $condition='test_id=?'; $data=array($_GET['test_id']);
			$req=$sql->readWhere($table, $field, $condition, $data);
			if($req->rowCount()!=0){
				while($dt=$req->fetch()){
					$table='answer'; $condition='question_id =?'; $data=array($dt['question_id']);
					$sql->del($table,$condition,$data);
				}
				$table='question'; $condition='test_id =?'; $data=array($_GET['test_id']);
				$sql->del($table,$condition,$data);
			}
			$table='test'; $condition='test_id =?'; $data=array($_GET['test_id']);
			$sql->del($table,$condition,$data);
			$notice ='<b>Felicitation ! </b>la suppression a été réalisé avec succès';
        }
		
        $table='test'; $field='*'; $condition='member_id=?'; $data=@array($_SESSION['member_id']);
        $req=$sql->readWhere($table,$field,$condition,$data);
        require('./view/epreuve.php');
    }

    function control_question(){
        $sql=new crud(); $notice='';
        if(isset($_POST['btn']) && $_POST['btn']=='ajouter'){
            $table='question'; $field='question_word,question_note,test_id'; $value='?,?,?'; $data=array($_POST['question_word'],$_POST['question_note'],$_POST['test_id']);
            $ib=$sql->add($table,$field,$value,$data);
            $table='answer'; $field='answer_word,answer_type,question_id'; $value='?,?,?'; $data=array($_POST['answer_good'],'good',$ib);
            $sql->add($table,$field,$value,$data);
            for($i=1;$i<=2;$i++){
                $table='answer'; $field='answer_word,answer_type,question_id'; $value='?,?,?'; $data=array($_POST['answer_bad'.$i],'bad',$ib);
                $sql->add($table,$field,$value,$data);
            }
			$notice='<b>Félicitation ! </b>Un nouveau questionnaire a été ajouté avec succè';
        }elseif(isset($_POST['btn']) && $_POST['btn']=='modifier'){
            $table='question'; $field='question_word=?,question_note=?'; $condition='question_id=?'; $data=array($_POST['question_word'],$_POST['question_note'],$_POST['question_id']);
            $sql->up($table,$field,$condition,$data);
            $table='answer'; $field='answer_word=?'; $condition='answer_id=?'; $data=array($_POST['answer_good'],$_POST['answer_good_id']);
            $sql->up($table,$field,$condition,$data);
			$data=array($_POST['answer_bad1'],$_POST['answer_bad1_id']);
			$sql->up($table,$field,$condition,$data);
			$data=array($_POST['answer_bad2'],$_POST['answer_bad2_id']);
			$sql->up($table,$field,$condition,$data);
			$notice='<b>Felicitation ! </b>Le questionnaire a été mise à jour';
        }
        if(isset($_GET['task']) && $_GET['task']=='del'){
            $table='question'; $condition='question_id=?'; $data=array($_GET['question_id']);
            $req=$sql->del($table,$condition,$data);
			$table='answer'; $condition='question_id=?'; $data=array($_GET['question_id']);
            $req=$sql->del($table,$condition,$data);
			$notice='<b>Felicitation ! </b>Le questionnaire a été supprimé';
        }
		$table='test'; $field='*'; $condition='member_id=?'; $data=@array($_SESSION['member_id']);
        $req1=$sql->readWhere($table,$field,$condition,$data);
		
        $table='question'; $field='*'; $condition='test_id=?'; $data=array($_GET['test_id']);
        $req=$sql->readWhere($table,$field,$condition,$data);
        require('./view/question.php');
    }
?>