<?php get_header();?>


		<!-- Highlights -->
			<section class="wrapper">
				<div class="inner">
					<header class="special">
						<h2>Découvrez mes oeuvres informatiques </h2>
						<p>N'hésitez pas à cliquer sur le lien de DEMO de chaque item présenté pour un essai immersif.</p>
					</header>
					<div class="highlights">
					
					<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();			
			?>
						<section>
							<div class="content">
								<header>
									<a href="<?php echo esc_url( get_permalink() )?>" class="icon fa-vcard-o"><span class="label">Icon</span></a>
									<h3><?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?></h3>
								</header>
								<p><?php the_content(); ?></p>
							</div>
						</section>
			<?php
			endwhile;
		endif;
			?>

					</div>
				</div>
			</section>

		

<?php get_footer();?>
