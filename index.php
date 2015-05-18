<?php ob_start();  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Cadastro de Usuarios</title>
	<style>
		 html { 
			 font: 13px Arial, sans-serif; 
			 width: 510px; 
			 margin-left: 10%;
			 margin-top: 5%; 
		 } 
		 
		 .blue { 
		 	  color: #0000FF;
			  font-size: 14px;
			  font-family: verdana;
		 } 
		 
		 .red { 
		 	  color: red; 
		 	  font-size: 14px;
			  font-family: verdana;
		 } 
		 
		 label { 
			 display: block; 
			 clear: both; 
			 width: 200px; 
			 color: black; 
			 font-size: 13px; 
		 } 
		 
		 input { 
		 	 border: 1px solid #E6E6FA;
		 	 padding-left: 5px; 
		 } 
		 
		 input[type="submit"],input[type="reset"] { 
			 width: 100px; 
			 height: 30px; 
			 background: #32CD32; 
			 color: white; 
			 margin-left: 10px; 
		 } 
		 
		 fieldset{ 
			 border: 1px solid #E6E6FA; 
			 color: black; 
			 font-size:	20px; 
		 } 
		 
		 .form_inp { 
			 float: right; 
			 margin-top: -17px; 
			 height: 13px;
			 clear: both; 
		 }
		 
		 hr {
		 	border: 1px solid #E6E6FA; 
		 }
	</style>
	<script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
	
	<script type="text/javascript">
	    $(function() {
	        $.mask.definitions['~'] = "[+-]";
	        $("#dtnascimento").mask("99/99/9999");
	        $("#rg").mask("99.999.999-9");
	        $("#cpf").mask("999.999.999-99");
	        $("#cep").mask("99999-999");
	        $("#telefone").mask("(99) 99999-9999");	   

	    });	    	
	</script>	
	
	<script type="text/javascript">

			function processoValidacao() {
				var result = validaCPF();

				if(result == false) {
					alert("Por favor. Para continuar, informe um CPF valido.");
				}

				return result;
			}

            function validaCPF() { // Validando cpf para prosseguir...
	        	var value =  $("#cpf").val();
	        	var value_1 =  value.replace('.', '');
	        	var value_2 =  value_1.replace('.', '');
	        	var value_3 =  value_2.replace('-', '');

				var cpf = value_3;
	        	
	        	var numeros, digitos, soma, i, resultado, digitos_iguais;
        	    digitos_iguais = 1;
        	    
        	    if (cpf.length < 11)
        	          return false;
        	    for (i = 0; i < cpf.length - 1; i++)
        	          if (cpf.charAt(i) != cpf.charAt(i + 1))
        	                {
        	                digitos_iguais = 0;
        	                break;
        	                }
        	    if (!digitos_iguais)
        	          {
        	          numeros = cpf.substring(0,9);
        	          digitos = cpf.substring(9);
        	          soma = 0;
        	          for (i = 10; i > 1; i--)
        	                soma += numeros.charAt(10 - i) * i;
        	          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        	          if (resultado != digitos.charAt(0))
        	                return false;
        	          numeros = cpf.substring(0,10);
        	          soma = 0;
        	          for (i = 11; i > 1; i--)
        	                soma += numeros.charAt(11 - i) * i;
        	          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        	          if (resultado != digitos.charAt(1))
        	                return false;
        	          return true;
        	          }
        	    else
        	        return false;
            }
	</script>	
</head>
<body>
	
	<?php if (isset($_GET['menoridade'])) { echo '<span class="red">Atencao. Cadastros de menores de idade nao sao permitidos!</span><br /><br />'; }?>
	<?php if (isset($_GET['sucesso'])) { echo '<span class="blue">Cadastro efetuado com sucesso! Obrigado</span><br /><br />'; }?>
		
	<form method="post" action="controller/indexController.php" onSubmit="return processoValidacao();">
		<fieldset>
			<legend>Preencha o formulario abaixo</legend><br />
			
			<label class="borda">Nome Completo: </label>
			<input class="form_inp" type="text" name="nomeCompleto" size="50" required><br />
			
			<label class="borda">Data nascimento:</label>
			<input class="form_inp" type="text" id="dtnascimento" name="dtnascimento" required><br />
			
			<label class="borda">Email: </label>
			<input class="form_inp" type="email" name="email" size="40" required><br /><br />
			
			<label class="borda">Facebook: </label>
			<input  class="form_inp"type="text" placeholder="facebook.com/seunome" name="facebook" size="40" required><br />						
			<hr />			
			<label class="borda">RG: </label>
			<input class="form_inp" type="text" id="rg" name="rg" required><br />
			
			<label class="borda">CPF: </label>
			<input class="form_inp" type="text" id="cpf"  name="cpf" required><br /><br />
			<hr />
			<label class="borda">Endereco: </label>
			<input class="form_inp" type="text" name="endereco" placeholder="Ex: Rua Tal, 30, complemento ap 23" size="50" required><br />
			
			<label class="borda">CEP: </label>
			<input class="form_inp" type="text" id="cep" name="cep" required><br />
			
			<label class="borda">Telefone: </label>
			<input class="form_inp"type="text" id="telefone" name="telefone" required><br /><br />
			<hr />
			<input type="submit" style="float: right;" value="Cadastrar" >
			<input type="reset" style="float: right;" value="Limpar">
			
		</fieldset>
	</form>
</body>
</html>