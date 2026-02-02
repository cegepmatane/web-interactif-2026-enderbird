<?php
	include_once "../accesseur/AlbumDAO.php";
	include_once "../accesseur/AlbumDAO.php";
	//print_r($contrats);
	include "action/gerer-album.php";
	$albums = AlbumDAO::listerAlbums();

    // AFFICHAGE
    require_once dirname(__DIR__) . "/header.php";
?>
    <title>SoundWave - Liste d'albums</title>
    <link rel="stylesheet" href="../css/general.css">

	<link rel="stylesheet" type="text/css" href="albums.css">	
</head>
<body>
	<!-- <div id="header">
		<h1><span>Contrat A Tout</span></h1>
		<nav>
			<div id="menu">
				<a class="lien-page" href="../soundwave/">Accueil</a> |
				<a class="lien-page" href="../journal/">Blog</a> |
				<a class="lien-page" href="../espace/">Membre</a>
			</div>
		</nav>
	</div> -->
	
	<section id="contenu">
		<header><h2>Contrats offerts</h2></header>
	
		<div>
			<a href="ajouter-contrat.html" class="action">Ajouter un contrat</a>
		</div>

		<div id="liste-contrats">
				
		<?php
		foreach($albums as $album)
		{
		?>
			<div class="contrat">			
				<h4><?=formater($album->nom)?></h4> 
				<a class="action" href="editer-album.php?album=<?=$album->id?>">Éditer</a> 
				<a class="action" href="effacer-album.php?album=<?=$album->id?>">Effacer</a></h4>
			</div>
		<?php
		}
		?>
				
		</div>
	
	</section>

<!-- Pied de page -->
<?php
require_once dirname(__DIR__) . "/footer.php";
?>