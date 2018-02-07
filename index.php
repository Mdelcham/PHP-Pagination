<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pagination</title>
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<?php 
		require'assets/functions/variables.php';
		$articleNumber = 4;
		$pageNumberMax = count($contenu) / $articleNumber;
		$pageNumberMax = ceil($pageNumberMax);
		$pageNumberRest = count($contenu) % $articleNumber;

		if (!isset($_GET['page'])) 
		{ 
			$articleIndex = 1;
			$pageNumber = 1;
		}
		else
		{
			$pageNumber = $_GET['page'];
			$articleIndex = ($pageNumberMax * ($pageNumber - 1))+1;
			$articleIndex = $articleIndex == 0 ? 1 : $articleIndex;
		}

		function includeArticles($contenu, $index)
		{
			$article = 
				"<h2>".$contenu[$index]["titre"]."</h2>
				<p>".$contenu[$index]["letexte"]."</p>
				<p><small>".$contenu[$index]["ladate"]."</small></p>";
			$GLOBALS['articleIndex']++;
			return $article;
		}
	?>
	<div id="main">
		<h1>PHP - Pagination</h1>
		<section id="articles">
			<?php
				$articleNumberOnThisPage = $pageNumber == $pageNumberMax ? $pageNumberRest : $articleNumber; 
				for ($i = 0; $i < $articleNumberOnThisPage ; $i ++) 
				{ 
					echo "<article>".$insert = includeArticles($contenu, $articleIndex)."</article>";
				}
			?>
		</section>
		<div id="pagination">
			<?php  
				$pagePrevious = $pageNumber == 1 ? $pageNumberMax : $pageNumber - 1;
				echo '<a class="pagin_arrow" href="index.php?page='.$pagePrevious.'">&#171;</a>';
			?>
			<?php  
				for ($i = 0; $i <$pageNumberMax ; $i++) 
				{ 
					$pageNumberList = $i + 1;
					echo '<a class="paginPages" href="index.php?page='.$pageNumberList.'">'.$pageNumberList.'</a>';
				}
			?>
			<?php  
				$pageNext = $pageNumber == $pageNumberMax ? 1 : $pageNumber + 1;
				echo '<a class="pagin_arrow" href="index.php?page='.$pageNext.'">&#187;</a>';
			?>
		</div>
	</div>
</body>
</html>