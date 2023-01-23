<?php

	// Conectando com o banco de dados
	$conn = new PDO("mysql:host=localhost:3306;dbname=test", "root", NULL);

	// Buscando todas FAQs do banco de dados
	$sql = "SELECT * FROM faqs";
	$statement = $conn->prepare($sql);
	$statement->execute();
	$faqs = $statement->fetchAll();

?>

<!-- Incluindo CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />

<!-- Incluindo JS -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>

<!-- Mostrar todas FAQs no painel -->
<div class="container" style="margin: 50px 0">
	<div class="row">
		<div class="col-md-12 accordion_one">
			<div class="panel-group">
				<?php foreach ($faqs as $faq): ?>
				<div class="panel panel-default">

					<!-- Botão para mostrar as perguntas -->
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion_oneLeft" href="#faq-<?php echo $faq['id']; ?>" aria-expanded="false" class="collapsed">
								<?php echo $faq['question']; ?>
							</a>

						</h4>
					</div>

					<!-- Accordion for answer -->
					<div id="faq-<?php echo $faq['id']; ?>" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
						<div class="panel-body">
							<div class="text-accordion">
								<?php echo $faq['answer']; ?>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>

		</div>
	</div>

	<style>

		.accordion_one .panel_group {
			border: 1px solid #f1f1f1;
			margin-top: 100px;
		}

		a:link{
			text-decoration: none;
		}

		.accordion_one .panel{
			background-color: transparent;
			box-shadow: none;
			border-bottom: 0px solid transparent;
			border-radius: 0;
			margin: 0;
		}

		.accordion_one .panel_default{
			border: 0;
		}

		.accordion-wrap .panel-heading{
			padding: 0px;
			border-radius: 0px;
		}

		h4{
			font-size: 18px;
			line-height: 24px;
		}

		.accordion_one .panel .panel-heading a.collapsed{
			color: #999;
			display: block;
			padding: 12px 30px;
			border-top: 0px;
		}

		.accordion_one .panel .panel-heading a{
			display: block;
			padding: 12px 30px;
			background-color: #fff;
			color: #313131;
			border-bottom: 1px solid #f1f1f1;
		}

		.accordion-wrap .panel .panel-heading a{
			font-size: 14px;
		}

		.accordion_one .panel-group .panel-heading+.panel-collapse>.panel-body{
			border-top: 0;
			padding-top: 0;
			padding: 25px 30px 30px 35px;
			background-color: #fff;
			color: #999;
		}

		.img-accordion{
			width: 81px;
			float: left;
			margin-right: 15px;
			display: block;
		}

		.accordion_one .panel .panel-heading a.collapsed:after {
			content: "\2b";
			color: #999;
			background-color: #f1f1f1;
		}

		.accordion_one .panel .panel-heading a:after,
		.accordion_one .panel .panel-heading a:.collapsed:after {
			font-family: 'FontAwesome';
			font-size: 15px;
			width: 36px;
			line-height: 48px;
			text-align: center;
			background-color: #f1f1f1;
			float: left;
			margin-left: -31px;
			margin-top: -12px;
			margin-right: 15px;
		}

		.accordion_one .panel .panel-heading a:after{
			content: "\2212";
		}

		.accordion_one .panel .panel-heading a:after,
		.accordion_one .panel .panel-heading a:.collapsed:after {
			font-family: 'FontAwesome';
			font-size: 15px;
			width: 36px;
			line-height: 48px;
			text-align: center;
			background-color: #f1f1f1;
			float: left;
			margin-left: -31px;
			margin-top: -12px;
			margin-right: 15px;
		}		

	</style>

</div>