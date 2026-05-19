<?php
	require_once "action/gerer-action.php";
	include_once "accesseur/AlbumDAO.php";
	$albums = AlbumDAO::listerAlbums();

    // AFFICHAGE
    include_once "header.php";
?>
    <title>SoundWave - Liste d'albums</title>
	<link rel="stylesheet" type="text/css" href="css/albums.css">	
    <link rel="stylesheet" href="css/general.css">
</head>
<body>
	
	<section id="contenu">
		<header><h2>Contrats offerts</h2></header>
	
		<div>
			<a href="ajouter-album.php" class="action">Ajouter un contrat</a>
		</div>

		<div id="liste-contrats">
				
		<?php
		foreach($albums as $album)
		{
		?>
			<div class="contrat">			
				<h4><?=AlbumDAO::formater($album->nom)?></h4> 
				<a class="action" href="editer-album.php?album=<?=$album->id?>">Éditer</a> 
				<a class="action" href="effacer-album.php?album=<?=$album->id?>">Effacer</a>
			</div>
		<?php
		}
		?>
				
		</div>
	
	</section>

<!-- Pied de page -->
<?php
include_once "footer.php";
?>