<?php
	
	// Conectando com banco de dados
	$conn = new PDO("mysql:host=localhost:3306;dbname=test", "root", NULL);

	// checando se ja existe algo inserido
	if (isset($_POST["submit"])) {

		// Criar uma tabela se já não estiver criada
		$sql = "CREATE TABLE IF NOT EXISTS faqs (
			id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
			question TEXT NULL, 
			answer TEXT NULL,
			created_at DATETIME DEFAULT CURRENT_TIMESTAMP
		)";

		$statement = $conn->prepare($sql);
		$statement->execute();

		// Inserindo tabelas de FAQ
		$sql = "INSERT INTO faqs (question, answer) VALUES (?, ?)";
		$statement = $conn->prepare($sql);
		$statement->execute([
			$_POST["question"],
			$_POST["answer"]
		]);
	}

	// Pegue todas FAQs do ultimo envio
	$sql = "SELECT * FROM faqs ORDER BY id DESC";
	$statement = $conn-> prepare($sql);
	$statement->execute();
	$faqs = $statement->fetchAll();

?>

<!-- Importando bootstrap, font-awesome e richtext -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="richtext/richtext.min.css" />


<!-- Importando jquer, bootstrap e rich text JS -->
<script src = "js/jquery-3.3.1.min.js"></script>
<script src = "js/bootstrap.js"></script>
<script src = "richtext/jquery.richtext.js"></script>

<!-- Layout para o formulário do FAQ -->
<div class="container" style="margin: 50px 0;">
	<div class="row">
		<div class="offset-md-3 col-md-6">
			<h1 class="text-center">Add FAQ</h1>

			<!-- Para adicionar o Add FAQ -->
			<form method="POST" action="add.php">

				<!-- Pergunta -->
				<div class="form-group">
					<label>Enter Questions</label>
					<input type="text" name="question" class="form-control" required />
				</div>

				<!-- Resposta -->
				<div class="form-group">
					<label>Enter Answer</label>
					<textarea name="answer" id="answer" class="form-control" required></textarea>
				</div>

				<!-- Botão de Enviar -->
				<input type="submit" name="submit" class="btn btn-info" value="Add FAQ">

			</form>
		</div>
	</div>

	<!-- Mostrar todas FAQs adicionadas -->
	<div class="row">
		<div class="offset-md-2 col-md-8">
			<table class="table table-bordered">
				<!-- Cabeçalho da tabela -->
				<thead>
					<tr>
						<th>ID</th>
						<th>Question</th>
						<th>Answer</th>
						<th>Actions</th>

					</tr>
				</thead>

				<!-- Corpo da tabela -->
				<tbody>
					<?php foreach ($faqs as $faq): ?>
						<tr>
							<td><?php echo $faq["id"]; ?></td>
							<td><?php echo $faq["question"]; ?></td>
							<td><?php echo $faq["answer"]; ?></td>
							<td>
								<!-- Botão de editar comentário -->
								<a href="edit.php?id=<?php echo $faq['id']; ?>"
								class="btn btn-warning btn-sm">
									Edit
								</a>

								<!-- Botão de deletar comentário -->
								<form method="POST" action="delete.php" onsubmit="return confirm('Você tem certeza de que deseja excluir esta pergunta?');" >
									<input type="hidden" name="id" value="<?php echo $faq['id']; ?>" required />
									<input type="submit" value="Delete" class="btn btn-danger btn-sm" />
								</form>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>

			</table>

		</div>
	</div>

</div>

<script>

	// iniciando a biblioteca rich text
	window.addEventListener("load", function() {
		$("#answer").richText();
	});

</script>