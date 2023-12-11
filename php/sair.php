<?php
	session_start();
	
	unset(
		$_SESSION['usuarioId'],
		$_SESSION['usuarioNome'],
		$_SESSION['usuarioEmail'],
		$_SESSION['usuarioNivelDeAcesso'],

		$_SESSION['registradoInseridoComSucesso'],
		$_SESSION['erroInserir'],
		$_SESSION['registradoDeletadoComSucesso'],
		$_SESSION['erroDeletar'],
		$_SESSION['registradoAtualizadoComSucesso'],
		$_SESSION['erroAtualizar'],

		$_SESSION['idAnoLetivo'],
		
		$_SESSION['RegistroAcademico'],
		$_SESSION['idadeEscolar'],
		$_SESSION['anoEscolar'],
		$_SESSION['NomeEstudante'],
		$_SESSION['NomeMateria'],
		$_SESSION['idMateriaSelect']

	);
	
	if($_SESSION['logged'] == False) {
		$_SESSION['logindeslogado'] = "Usúario não logado";
	}else{
		$_SESSION['logindeslogado'] = "Deslogado com sucesso";
	}
	//redirecionar o usuario para a página de login
	header("Location: ../tela/tela_login&register/login.php");
?>