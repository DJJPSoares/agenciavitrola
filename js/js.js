	function verificarCampos() {

		d = document.contato;

		if(d.nome.value == '') {
			alert("Por favor, o campo nome deve ser preenchido!");
			d.nome.focus();
			return false;
		}

		//Validar e-mail
		if(d.email.value == '') {
			alert("Por favor, o campo e-mail deve ser preenchido!");
			d.email.focus();
			return false;
		}

		let valido;
	    let str = d.email.value;
	    let filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    	if(filter.test(str)) {
	         valido = true;
	    	} else {
	         alert("Por favor, digite um endereço de e-mail válido!");
	          valido = false;
	          return valido;  
			}
		//Fim validar e-mal	

		if(d.celular.value == '' || d.celular.value.length < 13) {
			alert("Por favor, o campo telefone deve ser preenchido corretamente, incluindo o DDD!");
			d.celular.focus();
			return false;
	 	}

	 	if(d.assunto.value == '') {
			alert("Por favor, o campo assunto deve ser preenchido!");
			d.assunto.focus();
			return false;
		}

		if(d.mensagem.value == '') {
			alert("Como podemos ajudá-lo?");
			d.mensagem.focus();
			return false;
		}    
	}

	function mascara(objeto) {
	   if(objeto.value.length == 0)
	     objeto.value = '(' + objeto.value;

	   if(objeto.value.length == 3)
	      objeto.value = objeto.value + ')';

	    let cel_ou_fixo = objeto.value;

	    if(cel_ou_fixo.indexOf("9") == 4) {
	      if(objeto.value.length == 9)
	      objeto.value = objeto.value + '-';
	      objeto.maxLength = "14";
	 } else {
	      if(objeto.value.length == 8)
	      objeto.value = objeto.value + '-';
	      objeto.maxLength = "13";
	 }
}

	function bloqueiaLetras(evento) {
		let tecla;

	 		if(window.event) { // Internet Explorer
	  			tecla = event.keyCode;
	 		} else { // Firefox
	  			tecla = evento.which;
	 		} 
	 
	        if(tecla >= 48 && tecla <= 57 || tecla == 8) return true;
	   		return false;
	}