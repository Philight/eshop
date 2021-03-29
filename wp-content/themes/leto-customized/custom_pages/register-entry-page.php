<?php
/*
	Template Name: RegisterEntryPage
	extended: leto/page-templates/template_fullwidth
*/

//get_header();

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/js/registrationEntryPage.js'?>"></script>

<style>

:root {
	--pinkorange: #ffd9b0;
	--darkpinkorange: #edb77d;
	--overlaybrown: #6d563c;

	--navyblue: #313044;
	--overlaylightblue: #656477;

	--bg-user: #ffd9b0;
	--black: #000;
}

.split {
	width: 50%;
	height: 100%;	
	position: absolute;
}

.retail-account {
	left: 0;
	background-color: var(--bg-user);
	display: flex;;
	align-items: center;
	justify-content: center;
}

.wholesale-account {
	right: 0;
	background-color: var(--navyblue);
	display: flex;;
	align-items: center;
	justify-content: center;
}

.vertical-center {
	top:50%;
	position: relative;
	-webkit-transform: translateY(-50%);
  	-ms-transform: translateY(-50%);
  	transform: translateY(-50%);
}

*,
*::before,
*::after {
	box-sizing: border-box;
	font-family: Rubik;
}

.button-container {
	position: relative;
	display: inline-block;
	vertical-align: middle;

	cursor: pointer;
	
	text-decoration: none;
	background: transparent;
	padding: 0;

	width: 260px;
	height: auto;
	z-index: 10;

	/* border: 1px solid red; */
}

.wholesale-button {
	width: 320px;
}

.button-container:hover .circle{
	width: 100%;
}

.circle {
	/*@include transition(all, 0.45s, cubic-bezier(0.65,0,.076,1)); */
	transition: all 0.45s cubic-bezier(0.65,0,.076,1);
	position: relative;
	display: block;
	margin: 0;
	width: 3rem;
	height: 3rem;
	background-color: black;
	border-radius: 1.625rem;
}

.circle.wholesale-circle {
	background-color: var(--pinkorange);
}

.icon {
	transition: all 0.45s cubic-bezier(0.65,0,.076,1);
	position: absolute;
    top: 0;
    bottom: 0;
    margin: auto;
 
}


.button-container:hover .arrow {
	background: white;
    transform: translate(20px, 0);
}
.button-container:hover .arrow::before {
	border-color: white; 
}

.button-container:hover .arrow.wholesale-arrow {
	background: black;
    transform: translate(20px, 0);
}
.button-container:hover .arrow.wholesale-arrow::before {
	border-color: black; 
}

.arrow {
	transition: all 0.45s cubic-bezier(0.65,0,.076,1);
	left: 0.625rem;
	width: 1.125rem;
	height: 0.125rem;
	background: none;
}
.arrow::before {
    position: absolute;
    content: '';
    top: -0.25rem;
    right: 0.0625rem;
    width: 0.625rem;
    height: 0.625rem;
    border-top: 0.125rem solid #fff;
    border-right: 0.125rem solid #fff;
    transform: rotate(45deg);
    border-color: var(--pinkorange);
}
.arrow.wholesale-arrow::before {
	border-color: var(--navyblue);
}

.button-container:hover .button-text {
	color: white;
}

.button-container:hover .button-text.wholesale-text {
	color: black;
}

.button-text {
	transition: all 0.45s cubic-bezier(0.65,0,.076,1);

	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	padding: 0.75rem 0;
	margin: 0 0 0 24px;

	color: black;
	font-weight: 700;
	line-height: 1.5;
	text-align: center;
	text-transform: uppercase;

	/* border: 1px solid red; */
}
.button-text.wholesale-text {
	color: var(--pinkorange);
}

.button-container:hover + .overlay {
	width: 100%
}

.overlay {
	transition: all 0.7s cubic-bezier(0.65,0,.076,1);
	height: 100%;
	width: 0;
	left: 0;
	position: absolute;
	background-color: var(--overlaybrown);

	z-index: 9;
}

.overlay.wholesale {
	background-color: var(--overlaylightblue);
}


</style>
	<div id="primary" class="content-area fullWidth">
		<main id="main" class="site-main">

			<div class="container"
				style="width: 100%; height: 100%; background-color: gray;" 
			>
				<div class="split retail-account">

					<a href="<?php echo custom_get_page_url('REGISTERUSER'); ?>" class="button-container">
						<span class="circle" aria-hidden="true">
				      		<span class="icon arrow"></span>
				    	</span>
						<span class="button-text">New User account</span>
					</a>
					<div class="overlay"></div>
					
				</div>
				
				<div class="split wholesale-account">

					<a href="<?php echo custom_get_page_url('REGISTERWHOLESALE'); ?>" class="button-container wholesale-button">
						<span class="circle wholesale-circle" aria-hidden="true">
				      		<span class="icon arrow wholesale-arrow"></span>
				    	</span>
						<span class="button-text wholesale-text">New Wholesale account</span>
					</a>
					
					<div class="overlay wholesale"></div>

				</div>
			</div><!-- container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();