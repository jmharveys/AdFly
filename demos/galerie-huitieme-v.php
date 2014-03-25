<?php 
	include 'configs/global.php'; 
?>
<!DOCTYPE html>
<!--[if lt IE 8]> <html class="lt-ie10 lt-ie9 lt-ie8" lang="fr"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie10 lt-ie9" lang="fr"> <![endif]-->
<!--[if IE 9]>    <html class="lt-ie10" lang="fr"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="fr"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Galerie 1/4 sans vidéo | AdFly </title>
	<meta name="description" property="og:description" content="Outils de création publicitaire pour les annonceurs de La Presse+." />
	<meta name="author" content="Jonathan Harvey, Simon Arnold" />
	<meta property="og:type" content="website"/>
	<link rel="stylesheet" media="all" href="<?= URL ?>public/styles/ad.css">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style>
	/* ICONES rétina POUR L'ARRIÈRE DU FLIP */
	.back ul.rating > li {
			float: left;
			list-style: none;
			background: url(http://localhost:8888/Adfly/public/images/ico-etoile-autre.png) no-repeat 0 0 transparent;
			background-size: contain;
			width: 12.5px;
			height: 12.5px;
			margin: 0 3px 0 0;
			z-index: 10;			
	}

	.quart .back ul.rating > li {
			float: left;
			list-style: none;
			background: url(http://localhost:8888/Adfly/public/images/ico-etoile-quart.png) no-repeat 0 0 transparent;
			background-size: contain;
			width: 18px;
			height: 18px;
			margin: 0 3px 0 0;
			z-index: 10;
	}	

	.back .close {
			position: absolute;
			top: 0px;
			left: 0px;
			width: 40px;
			height: 40px;
			z-index: 1;
			background: url(http://localhost:8888/Adfly/public/images/btn-annuler-light.png) no-repeat 0 0 transparent;
			background-size: contain;
		}

	.back .close:active {
			background-image: url(http://localhost:8888/Adfly/public/images/btn-annuler-pressed.png);
		}	

	.back a.btn-plusWeb {
			position: absolute;
			bottom: 10px;
			right: 10px;
			width: 40px;
			height: 40px;
			z-index: 1;
			background: url(http://localhost:8888/Adfly/public/images/btn-plusweb.png) no-repeat 0 0 transparent;
			background-size: contain;		
		}

		.back a.btn-plusWeb:active {
			background-image: url(http://localhost:8888/Adfly/public/images/btn-plusweb-pressed.png);	
		}	

		.back a.btn-plusWeb:after {
			position: absolute;
			content: "";
			width: 80px;
			height: 80px;
			top: -10px;
			left: -10px;	
		}	
	</style>
</head>
<body>
	<div class='lp-ad huitieme-v'>
		<div id="overlay" style="background-image: url('<?= URL ?>public/images/demo/huitieme-back.jpg');"></div>
		<!--=== RETOURNER html | debut ==============-->
		<div class='wrapperFlip'>
			<div class='flip'> 
				<div class='front'>
					<div class="logo" style="background-image: url('public/images/demo/sunwing.jpg');"></div>
					<div style='width: 230px; height: 221px; background-image: url("public/images/demo/riu-playa.jpg");'></div>
					<div class="description">
						<div>
							<p class="title">Riu Playa Turquesa</p>
							<p class="subtitle">Holguin,<br/>Cuba</p>
						</div>
						<div>
							<p class="caption">à partir de.</p>
							<p class="price">495</p>
						</div>
					</div>
				</div>
				<div class='back'>
					<div>
						<div class="close"></div>
						<div class="description">
							<div class="opposite">
								<p class="title">Riu Playa Turquesa</p>
								<p class="subtitle">Holguin,<br/>Cuba</p>
							</div>
							<div>
								<p class="caption">à partir de.</p>
								<p class="price">495</p>
							</div>
							<ul class="rating">
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
							</ul>
							<div class="infos">11 avril 2014 - 7 jours, 6 nuits. Profitez d'un séjour merveilleux à Riu Playa Turquesa, à Holguin situé sur la superbe plage Yuraguanal, ce centre de villégiature paradisiaque, de formule tout compris.</div>
						<div class="logo" style="background-image: url('public/images/demo/sunwing-back.jpg');"></div>
						<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
						</div>
					</div>			
				</div>	
			</div>
		<!--=== RETOURNER html | fin ==============-->
		</div>
	</div>
	<script src="<?= URL ?>public/scripts/min/mustache.min.js"></script>
	<script src="<?= URL ?>public/scripts/min/iscroll5.min.js"></script>
	<script>
		var ad = document.getElementsByClassName('lp-ad')[0];

		/*=== RETOURNER script | debut =============*/
		var flipper = document.getElementsByClassName('flip')[0]; 
		flipper.addEventListener('tap', flipMe, false); 
		flipper.addEventListener('click', flipMe, false); 

		function flipMe() { 
			// Si je n'ai pas flipper et que je ne scroll pas.
			if(!(flipper.classList.contains('active')) && !(ad.classList.contains('moving')) ) { 
				if ( !(flipper.classList.contains('flipped')) ) {
					flipper.classList.add('active');
					flipper.addEventListener("transitionend", flipDone, false);
				} 

			}
			if ( flipper.classList.contains('active') && ad.classList.contains('flipped') && !(ad.classList.contains('moving')) ) { 
					if (  !(event.target.classList.contains('noFlip'))  ) {
						flipper.classList.remove('active'); 
						ad.classList.remove('flipped'); 
					} 
			} 
		}

		function flipDone() {
			if (!ad.classList.contains('flipped')) {
				ad.classList.add('flipped');
				flipper.removeEventListener("transitionend", flipDone, false);
			} 
		}			
	
		var isMobile = {
			Android: function() {
				return navigator.userAgent.match(/Android/i);
			},
			iOS: function() {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			}
		};
		
		window.onload = function() {

			if(isMobile.Android()) {
				document.body.classList.add('lp-is-android');
			} else {
				document.body.classList.add('lp-is-ios');
			}
			document.body.classList.add('lp-loaded');
		}
			
	</script>
</body>
</html>