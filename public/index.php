<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Guestbook</title>
	<link rel="stylesheet" href="https://cdn.rawgit.com/Chalarangelo/mini.css/v3.0.1/dist/mini-default.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
	<link rel="stylesheet" href="public/css/style.css">
</head>
<body>
	<header>
		<a href="#" class="logo">Guestbook</a>
	</header>
	<div class="container">
		<div class="row">			
			<div class="col-sm-7">
				<form method="post" action="controller/indexController.php" onSubmit="return processoValidacao();">
					<fieldset>
						<legend>Fill out the form below</legend>
						<div class="input-group fluid">
							<label >Name</label>
							<input  type="text" name="name" required>
						</div>
						<div class="input-group fluid">
							<label >Birth date</label>
							<input  type="text" id="birthdate" name="birthdate" required>
							<label >E-mail</label>
							<input  type="email" name="email" required>	
						</div>	
						<div class="input-group fluid">
							<label >Endereco</label>
							<input  type="text" id="address" name="address" required>
						</div>
						<div class="input-group fluid">
							<label >Postal-code</label>
							<input  type="text" id="postal" name="postal" required>
							<label >Fone</label>
							<input type="text" id="fone" name="fone" required>
						</div>
						<hr />
						<div class="input-group fluid">
							<input type="reset" value="Clean">
							<input type="submit" class="btn-register" value="Register" >							
						</div>
					</fieldset>
				</form>
			</div>
			<div class="col-sm-5 center">
				<div class="content">
					<h1>Guestbook<small>Visitor log-in with some basic fields and output to .xls file</small></h1>
					<i class="far fa-file-excel excel-ico"></i>
				</div>
			</div>
		</div>
	</div>		
	<script type="text/javascript" src="public/js/jquery-1.8.3.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="public/js/jquery.maskedinput.min.js"></script>	
	<script type="text/javascript" src="public/js/main.js"></script></script>	
</body>
</html>