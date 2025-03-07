<?php
	$pagina_actual = $_SERVER['REQUEST_URI']; 

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['estils_registre'])) {
		$color = $_POST['estils_registre'];

		if ($color == "morat") {
			$estil_css = "css/estilsregistre1.css";
		} elseif ($color == "groc") {
			$estil_css = "css/estilsregistre2.css";
		}

		$url_parts = parse_url($pagina_actual);
		parse_str($url_parts['query'], $query_params);

		$query_params['color'] = $color;

		$new_query_string = http_build_query($query_params);
		$new_url = $url_parts['path'] . '?' . $new_query_string;

		header("Location: $new_url");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="es">
<html>
	<head>
        <meta charset="utf-8">
		<title>Proyecto Entornos</title>
		<?php
			$estil_css = "css/estils.css"; // CSS por defecto

			if (isset($_GET['color'])) {
				if ($_GET['color'] == "morat") {
					$estil_css = "css/estilsregistre1.css";
				} elseif ($_GET['color'] == "groc") {
					$estil_css = "css/estilsregistre2.css";
				}
			}
		?>
		<link rel="stylesheet" href="<?php echo $estil_css; ?>">
	</head>
	<body id = "wrapper">
		<?php

		$base = "./";

        include_once ("./include/cap.partial.php");
        
        include_once ("./include/menu.partial.php");

        include_once ("./include/principal.partial.php");

		include_once ("./include/peu.partial.php");

        ?>
	</body>
</html>