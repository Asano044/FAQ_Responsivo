<?php

	// Conectando com o banco de dados
	$conn = new PDO("mysql:host=localhost:3306;dbname=test", "root", NULL);

	// Checando se existe o FAQ
	$sql = "SELECT * FROM faqs WHERE id = ?";
	$statement = $conn->prepare($sql);
	$statement->execute([
		$_REQUEST["id"]
	]);
	$faq = $statement->fetch();

	if (!$faq) {
		die("FAQ não encontrado");
	}

	// Checando se a edição foi enviada
	if (isset($_POST["submit"])) {

		// Atualizando a FAQ no banco de dados
		$sql = "UPDATE faqs SET question = ?, answer = ? WHERE id = ?";
		$statement = $conn->prepare($sql);
		$statement->execute([
			$_POST["question"],
			$_POST["answer"],
			$_POST["id"]
		]);

		// Redirecionando de volta para a página principal
		header("Location: " . $_SERVER["HTTP_REFERER"]);

	}

?>

<!-- Importando CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="richtext/richtext.min.css" />

<!-- Importando JS -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="richtext/jquery.richtext.js"></script>

<!-- Layout do formulário para editar FAQs -->
<div class="container" style="margin: 50px 0">
	<div class="row">
		<div class="offset-md-3 col-md-6">
			<h1 class="text-center">Edit FAQ</h1>

			<!-- Formulário para editar FAQ -->
			<form method="POST" action="edit.php">

				<!-- Escondendo campo de id do FAQ -->
				<input type="hidden" name="id" value="<?php echo $faq['id']; ?>" required />

				<!-- Perguntas, preenchimento automático -->
				<div class="form-group">
					<label>Enter Question</label>
					<input type="text" name="question" class="form-control" value="<?php echo $faq['question']; ?>" required />
				</div>

				<!-- Respostas, preenchimento automático -->
				<div class="form-group">
					<label>Enter Answer</label>
					<textarea name="answer" id="answer" class="form-control" required><?php echo $faq['answer']; ?></textarea>
				</div>

				<!-- Botão de reenviar -->
				<input type="submit" name="submit" class="btn btn-warning" value="Edit FAQ">

			</form>


		</div>
	</div>
</div>

<script>
	// Iniciando a bibliotecaa rich text
	window.addEventListener("load", function () {
		$("#answer").richText();
	})
</script>