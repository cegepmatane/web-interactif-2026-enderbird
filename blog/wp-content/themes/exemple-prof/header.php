<!DOCTYPE HTML>
<!--
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title><?php the_title(); ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" />
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<a class="logo" href="index.html">Industrious</a>
				<nav>
					<a href="#menu">Menu</a>
				</nav>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="">Accueil</a></li>
					<li><a href="a-propos/">Elements</a></li>
					<li><a href="contact/">Generic</a></li>
				</ul>
			</nav>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
				<h1><?php the_title(); ?></h1>
					<p><?php bloginfo('description'); ?></p>
				</div>
				<video autoplay loop muted playsinline src="<?php echo get_template_directory_uri(); ?>/images/banner.mp4"></video>
			</section>
			
