<?php
/*
	Template Name: LandingPage
	extended: leto/page-templates/template_fullwidth
*/

get_header(); ?>

<?php 
	function color_stripe($colorValue, $colorName) {
		echo '
		<div class="color-stripe"
			style="
				flex: 0 1 100%;
				height: 100%;
				background-color: '.$colorValue.'" 
		>
			<h1 style="
				display: inline-block;
				font-size: 28px;
				margin: 0;
				position: relative;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%) rotate(70deg) ;"
			>
				'.$colorName.'
			</h1>
		</div>
		';
	}

	function row_start() {
		echo '
		<div class="row"
			style="
				flex: 0 1 100%;
				border: 1px solid black;
				border-top: none;
				border-bottom: none;
				display: flex;
				gap: 10px;
				background-color: #FFF;"
		>
		';
	}

	function row_end() {
		echo '
		</div>';
	}
?>
	<div id="primary" class="content-area fullWidth">
		<main id="main" class="site-main">
			<div class="landing-container" 
				style="
					display: flex; 
					flex-direction: column;
					align-items: center;
					height: 800px;"
			>
				<div class="landing-header" 
					style="
						flex: 0 0 15%;
						width: 100%;
						background-color: #000;
						color: #FFF;
						font-size: 28px;
						font-weight: 1000;

						display: flex;
						align-items: center;
						justify-content: center;
					"
				>
					LandingPage
				</div>
				<div class="landing-body" 
					style="
						flex: 0 0 70%;
						width: 85%;

						display: flex;
						flex-direction: column;
						gap: 10px;
						background-color: #FFF;"
				>
					<?php row_start() ?>
						<?php 
						color_stripe('lemonchiffon', 'LemonChiffon');
						color_stripe('moccasin', 'Moccasin');
						color_stripe('wheat', 'Wheat');
						
						color_stripe('#efcfa9', '#efcfa9');
						color_stripe('#f2c591', '#f2c591');
						color_stripe('#edb77d', '#edb77d');
						?>	
					<?php row_end() ?> 
					<?php row_start() ?>
						<?php 
						color_stripe('blanchedalmond', 'BlanchedAlmond');
						color_stripe('bisque', 'Bisque');
						color_stripe('peachpuff', 'PeachPuff');
						color_stripe('#ffd9b0', '#ffd9b0');
						
						color_stripe('navajowhite', 'NavajoWhite');
							
						?>	
					<?php row_end() ?> 
				</div>
				<div class="landing-footer"
					style="
						flex: 0 0 15%;
						width: 100%;
						background-color: #000;
						color: #FFF;
						font-size: 28px;
						font-weight: 1000;

						display: flex;
						align-items: center;
						justify-content: center;"
				>
					Footer			
				</div>
			</div><!-- container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();