<?php

	function select() {

		$pessoas = array();
		$fp = fopen('pessoas.txt', 'r');

        if($fp) {
            while(!feof($fp)) {
				$arr = array();
                $id = fgets($fp);
				$dados = fgets($fp);
				if(!empty($dados)) {
					$arr = explode("#", $dados);
					$pessoas[$id] = $arr;
				}
			}
			fclose($fp);
		}

		return $pessoas;
	}

	function select_where($id) {

		$pessoas = select();

		foreach ($pessoas as $chave => $dados) {
			// echo "$cpf=$chave<br>";
			if(strcmp($id, trim($chave)) == 0) { 
				return $dados;
			}
		}

		return null;	
	}

	function insert($pessoas) {

		$fp = fopen('pessoas.txt', 'a+');

		if ($fp) {
			foreach($pessoas as $id => $dados) {
				if(!empty($dados)) {
					fputs($fp, $id);
					fputs($fp, "\n");
					$linha=$dados['nome']."#".$dados['endereco']."#".$dados['telefone'];
					fputs($fp, $linha);
					fputs($fp, "\n");
				}
			}
			fclose($fp);
			echo "<script> alert('[OK] Pessoa Cadastrada com Sucesso!') </script>";
		}
	}

	function update($new, $id) {

		$cursos = select();

		$fp = fopen('pessoas.txt', 'a+');

		if ($fp) {
			foreach($cursos as $chave => $dados) {
				if(!empty($dados)) {
					fputs($fp, $chave);
					if($id == trim($chave)){
						foreach($new as $new_id => $new_dados) {
							if(!empty($new_dados)) {
								$linha=$new_dados['nome']."#".$new_dados['endereco']."#".$new_dados['telefone']."\n";
							}
						}
					}
					else 
						$linha=$dados[0]."#".$dados[1]."#".$dados[2];
					fputs($fp, $linha);
				}
			}
			fclose($fp);
			echo "<script> alert('[OK] Pessoa Alterada com Sucesso!') </script>";

			unlink("pessoas.txt");
		}
	}

	function delete() {

	}

?>
