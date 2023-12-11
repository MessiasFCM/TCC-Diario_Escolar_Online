<?php
	session_start();	
	//Incluindo a conexão com banco de dados
	include_once("conexao.php");	

	//O campo usuário e senha preenchido entra no if para validar
	if((isset($_POST['txtloginUsuario'])) && (isset($_POST['txtsenhaUsuario']))){
		$usuario = mysqli_real_escape_string($conn, $_POST['txtloginUsuario']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
		$senha = mysqli_real_escape_string($conn, $_POST['txtsenhaUsuario']);
		$senha = md5($senha);

		//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
		$result_usuario = "SELECT * FROM deo.Estudante WHERE (EmailEstudante = '$usuario' && SenhaEstudante = '$senha') || (RegistroAcademico = '$usuario' && SenhaEstudante = '$senha') LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		$resultado = mysqli_fetch_assoc($resultado_usuario);
		
		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		if(isset($resultado)){
			$_SESSION['usuarioId'] = $resultado['RegistroAcademico'];
			$_SESSION['usuarioNome'] = $resultado['NomeEstudante'];
			$_SESSION['usuarioEmail'] = $resultado['EmailEstudante'];
			$_SESSION['usuarioNivelDeAcesso'] = 1;
			$_SESSION['logged'] = True;
			header("Location: ../tela/tela_inicial/menu.php");

		//Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		//redireciona o usuario para a página de login
		}else{
			if((isset($_POST['txtloginUsuario'])) && (isset($_POST['txtsenhaUsuario']))){
				$result_usuario = "SELECT * FROM deo.Professor WHERE EmailProfessor = '$usuario' && SenhaProfessor = '$senha' LIMIT 1";
				$resultado_usuario = mysqli_query($conn, $result_usuario);
				$resultado = mysqli_fetch_assoc($resultado_usuario);
	
				if(isset($resultado)){
					$_SESSION['usuarioId'] = $resultado['idProfessor'];
					$_SESSION['usuarioNome'] = $resultado['NomeProfessor'];
					$_SESSION['usuarioEmail'] = $resultado['EmailProfessor'];
					$_SESSION['usuarioNivelDeAcesso'] = 2;
					$_SESSION['logged'] = True;
					header("Location: ../tela/tela_inicial/menu.php");
				}else{	
					if((isset($_POST['txtloginUsuario'])) && (isset($_POST['txtsenhaUsuario']))){
						$result_usuario = "SELECT * FROM deo.Instituicao WHERE EmailInstituicao = '$usuario' && SenhaInstituicao = '$senha' && InstituicaoAprovada = 1 LIMIT 1";
						$resultado_usuario = mysqli_query($conn, $result_usuario);
						$resultado = mysqli_fetch_assoc($resultado_usuario);

						$result_usuario_andamento = "SELECT * FROM deo.Instituicao WHERE EmailInstituicao = '$usuario' && SenhaInstituicao = '$senha' && InstituicaoAprovada = 0 LIMIT 1";
						$resultado_usuario_andamento = mysqli_query($conn, $result_usuario_andamento);
						$resultado_andamento = mysqli_fetch_assoc($resultado_usuario_andamento);
			
						if(isset($resultado_andamento)){
							$_SESSION['loginAndamento'] = "Instituição em espera de confirmação";
							header("Location: ../tela/tela_login&register/login.php");
						}

						if(isset($resultado)){
							$_SESSION['usuarioId'] = $resultado['IdInstituicao'];
							$_SESSION['usuarioNome'] = $resultado['NomeInstituicao'];
							$_SESSION['usuarioEmail'] = $resultado['EmailInstituicao'];
							$_SESSION['usuarioNivelDeAcesso'] = 3;
							$_SESSION['logged'] = True;
							header("Location: ../tela/tela_inicial/menu.php");
						}else{	
							if((isset($_POST['txtloginUsuario'])) && (isset($_POST['txtsenhaUsuario']))){
								$result_usuario = "SELECT * FROM deo.Administrador WHERE EmailAdministrador = '$usuario' && SenhaAdministrador = '$senha' LIMIT 1";
								$resultado_usuario = mysqli_query($conn, $result_usuario);
								$resultado = mysqli_fetch_assoc($resultado_usuario);
					
								if(isset($resultado)){
									$_SESSION['usuarioId'] = $resultado['idAdministrador'];
									$_SESSION['usuarioNome'] = $resultado['NomeAdministrador'];
									$_SESSION['usuarioEmail'] = $resultado['EmailAdministrador'];
									$_SESSION['usuarioNivelDeAcesso'] = 4;
									$_SESSION['logged'] = True;
									header("Location: ../tela/tela_inicial/menu.php");
								}else{	
									//Váriavel global recebendo a mensagem de erro
									$_SESSION['loginErro'] = "Usuário ou senha Inválido";
									header("Location: ../tela/tela_login&register/login.php");
								}
							}
						}
					}
				}
			}
		}
	//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
	}else{
		$_SESSION['loginErro'] = "Usuário ou senha inválido";
		header("Location: ../tela/tela_login&register/login.php");
	}
?>
