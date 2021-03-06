<?php
/**
 * The template for displaying the Mission page
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="banner-background">
				<div id="wall-teens-pic"></div>
			</div>

			<?php
			while ( have_posts() ) : the_post();
				$impact = get_field('impact');
				$impact_explanation = get_field('impact_explanation');
				$impact_stat_1 = get_field('impact_stat_1');
				$impact_stat_1_explanation = get_field('impact_stat_1_explanation');
				$impact_stat_2 = get_field('impact_stat_2');
				$impact_stat_2_explanation = get_field('impact_stat_2_explanation');$impact_stat_3 = get_field('impact_stat_3');
				$impact_stat_3_explanation = get_field('impact_stat_3_explanation');$impact_stat_4 = get_field('impact_stat_4');
				$impact_stat_4_explanation = get_field('impact_stat_4_explanation');$impact_stat_5 = get_field('impact_stat_5');
				$impact_stat_5_explanation = get_field('impact_stat_5_explanation');
				$our_mission = get_field('our_mission');
				$our_mission_text = get_field('our_mission_text');
				$our_history = get_field('our_history');
				$our_history_text = get_field('our_history_text');
				?>
				<section class="aligncenter site-info large-btm-margin mission">
					<div>
						<h1 class="dark-blue font-boldest xx-large"><?php echo $impact ?></h1>
						<p class="gray "><?php echo $impact_explanation ?></p>
					</div>

					<div class="grid-wrapper-one-third">
						<h1 class="turquoise fivex-font font-boldest left-section"><?php echo $impact_stat_1 ?></h1>
						<h2 class="turquoise font-bolder right-section"><?php echo $impact_stat_1_explanation ?></h2>
					</div>

					<div class="grid-wrapper-one-third">
						<h1 class="left-section gold fivex-font font-boldest"><?php echo $impact_stat_2 ?></h1>
						<h2 class="right-section gold font-bolder"><?php echo $impact_stat_2_explanation ?></h2>
					</div>

					<div class="grid-wrapper-one-third">
						<h1 class="left-section grass-green fivex-font font-boldest"><?php echo $impact_stat_3 ?></h1>
						<h2 class="right-section grass-green font-bolder"><?php echo $impact_stat_3_explanation ?></h2>
					</div>

					<div class="grid-wrapper-one-third">
						<h1 class="left-section burnt-orange fivex-font font-boldest"><?php echo $impact_stat_4 ?></h1>
						<h2 class="right-section burnt-orange font-bolder"><?php echo $impact_stat_4_explanation ?></h2>
					</div>

					<div class="grid-wrapper-one-third">
						<h1 class="left-section aqua-marine fivex-font font-boldest"><?php echo $impact_stat_5 ?></h1>
						<h2 class="right-section aqua-marine font-bolder"><?php echo $impact_stat_5_explanation ?></h2>
					</div>
				</section>

				<section>
					<div class="yellow-house-pic med-padding">
						<div class="site-info aligncenter">
							<h1 class="font-boldest"><?php echo $our_mission ?></h1>
							<h2 class="font-bolder"><?php echo $our_mission_text ?></h2>
						</div>
					</div>
				</section>

				<section class="site-info">
					<h1 class="aligncenter dark-blue font-boldest"><?php echo $our_history ?></h1>
					<p class="two-column"><?php echo $our_history_text ?></p>
				</section>
			<?php endwhile; ?>

			<!-- Sponsors -->
	    <section class="sponsor-carousel">
	      <h2 class="aligncenter dark-blue sm-padding-bottom h2-line-ht test-border">A big thanks to our supporters!</h2>
	      <div>
	        <?php echo do_shortcode('[gs_logo]'); ?>
	      </div>
	    </section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
