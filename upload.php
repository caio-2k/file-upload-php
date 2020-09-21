<!-- A seguir um código simples em PHP para realizar upload de arquivos
apartir de um formulário -->

<!-- Ínicio do formulário -->
<form method="POST" enctype="multipart/form-data">
<!-- Utilizando o método "POST" para enviar o arquivo para o servidor e utilizando
o atributo "enctype" para definir o tipo de informação a ser enviada, no caso
iremos enviar valores binários pelo formulário e não string. -->

	<input type="file" name="fileUpload">

	<button type="submit">Send</button>
	
</form>
<!-- Fim do formulário -->


<?php
//Pegando variável de ambiente guardando o tipo da solicitação (get, post, etc..)
if ($_SERVER['REQUEST_METHOD'] === "POST") { //Se o método requisitado for POST

	//Guardar o arquivo que estamos recebendo (nome, tamanho, se há erro)
	$file = $_FILES['fileUpload']; //Passando o nome do input para a requisição

	//Forçando uma exception caso haja erro
	if ($file['error']) {

		throw new Exception("Error: ".$file['error']);		

	}

  //Variavel recebendo o nome do diretório que vai receber o arquivo enviado 
  //*deve ter permissao de escrita*
	$dirUploads = "uploads"; //Nome do diretório

	if (!is_dir($dirUploads)) { //Verificando se o diretório existe

    mkdir($dirUploads); //Criando o diretório caso o mesmo não exista
    
		//Detalhe: quando criamos utilizamos o mkdir puro a permissão de escrita é 
		//habilitada apenas para o criador da pasta

	}

  //move_uploaded_file = Recebe o a variável "file" com o diretório temporário
  //o destino (dirUploads) e o nome do arquivo.

	if (move_uploaded_file($file['tmp_name'], $dirUploads . DIRECTORY_SEPARATOR . $file['name'])) {

		echo "Upload realizado com sucesso!";

	} else {

		throw new Exception("Não foi possível realizar o upload.");
		

	}

}

?>