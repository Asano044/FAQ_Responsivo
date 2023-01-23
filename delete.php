<?php

	// Conectando com o banco de dados
	$conn = new PDO("mysql:host=localhost:3306;dbname=test", "root", NULL);

	// Checando se o FAQ existe
	$sql = "SELECT * FROM faqs WHERE id = ?";
	$statement = $conn->prepare($sql);
	$statement->execute([
		$_REQUEST["id"]
	]);
	$faq = $statement->fetch();

	if (!$faq) {
		die("FAQ não encontrado");
	}

	// Deletar do banco de dados
	$sql = "DELETE FROM faqs WHERE id = ?";
	$statement = $conn->prepare($sql);
	$statement->execute([
		$_POST["id"]
	]);

	// Redirecionando para página anterior
	header("Location: " . $_SERVER["HTTP_REFERER"]);
?>