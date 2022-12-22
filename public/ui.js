function _(elt){return document.getElementById(elt)}

function testUpdate(data){
	var tab = data.split(';');
	_('test_id').value=tab[0]; _('word').value=tab[1]; _('duration').value=tab[2];
	_('btn').innerHTML='<input type="submit" name="btn" value="modifier" />';
}

function questionUpdate(data, idrep, rep, tyrep){
	var tab = data.split(';'), answer_id=idrep.split(';'), answer_word=rep.split(';'), answer_type=tyrep.split(';');
	_('test_id').value=tab[0]; _('question_id').value=tab[1]; _('question_word').value=tab[2]; _('question_note').value=tab[3];
	var cp=1;
	for(var i=0; i<answer_type.length; i++){
		if(answer_type[i]=='good'){
			_('answer_good').value=answer_word[i]; _('answer_good_id').value=answer_id[i];
		}else{
			_('answer_bad'+cp).value=answer_word[i]; _('answer_bad'+cp+'_id').value=answer_id[i];
			cp++;
		}
	}
	_('btn').innerHTML='<input type="submit" name="btn" value="modifier" />';
}

function condition_enabled(){
	_('button').disabled=false;
}