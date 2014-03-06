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
	<title>Formulaire | AdFly </title>
	<meta name="description" property="og:description" content="Outils de création publicitaire pour les annonceurs de La Presse+." />
	<meta name="author" content="Jonathan Harvey, Simon Arnold" />
	<meta property="og:type" content="website"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" media="all" href="<?= URL ?>public/styles/ad.css">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

	<div class='lp-ad'>
		<div id="logo" style='background-image: url("public/images/demo/tmr.jpg");'></div>
		
		<!--=== RETOURNER html | debut ==============-->
		<!-- <div class='wrapperFlip' style='top: 0px; left: 0px; width: 480px; height: 246px;'>
			<div class='flip' style='0px; width: 480px; height: 246px;'> 
				
				<div style='top: 0; left: 0; width: 480px; height: 246px; background-image: url("assets/maroc.jpg");' class='lp-view'></div>
				
				<div style='top: 0; left: 0; width: 480px; height: 246px; background-image: url("assets/chine.jpg");' class='lp-view'></div>
			</div>
		</div> -->
		<!--=== RETOURNER html | fin ==============-->


		<div id='gallery'>
			<div class='scroller'>
				<div style='top: 0; left: 0; width: 480px; height: 324px; background-image: url("public/images/demo/chine.jpg");' class='lp-view'>
					<div class="description">
						<div>
							<p class="title">Grand China Princess</p>
							<p class="subtitle">Bangkok, Chine</p>
						</div>
						<div>
							<p class="caption">à partir de</p>
							<p class="price">1 358</p>
						</div>
					</div>
				</div>

				<div style='top: 0; left: 0; width: 480px; height: 324px; background-image: url("public/images/demo/maroc.jpg");' class='lp-view'>
					<div class="description">
						<div>
							<p class="title">Mazagan Beach Resort</p>
							<p class="subtitle">El Jadida, Maroc</p>
						</div>
						<div>
							<p class="caption">à partir de</p>
							<p class="price">2 199</p>
						</div>
					</div>					
				</div>
	
				<div style='top: 0; left: 0; width: 480px; height: 324px; background-image: url("public/images/demo/perou.jpg");' class='lp-view'>
					<div class="description">
						<div>
							<p class="title">Machu Picchu Sanctuary Lodge</p>
							<p class="subtitle">Machu Picchu, Pérou</p>
						</div>
						<div>
							<p class="caption">à partir de</p>
							<p class="price">1 699</p>
						</div>
					</div>						
				</div>
							
				<div style='top: 0; left: 0; width: 480px; height: 324px; background-image: url("public/images/demo/portugal.jpg");' class='lp-view'>
					<div class="description">
						<div>
							<p class="title">Rocha Hotel Apartamento</p>
							<p class="subtitle">Praia da Rocha, Portugal</p>
						</div>
						<div>
							<p class="caption">à partir de</p>
							<p class="price">2 400</p>
						</div>
					</div>						
				</div>
							
				<div style='top: 0; left: 0; width: 480px; height: 324px; background-image: url("public/images/demo/paris.jpg");' class='lp-view'>
					<div class="description">
						<div>
							<p class="title">Eiffel Capitol Hotel</p>
							<p class="subtitle">Paris, France</p>
						</div>
						<div>
							<p class="caption">à partir de</p>
							<p class="price">999</p>
						</div>
					</div>						
				</div>
			</div>
		</div>
		<div class='pager-wrapper'>
			<ul class='pager'>
				<li class='selected'>0</li>
				<li>1</li>
				<li>2</li>
				<li>3</li>
				<li>4</li>
			</ul>
		</div>
	</div>

	<script src="public/scripts/min/jquery-1.11.0.min.js"></script>
	<script src="public/scripts/min/iscroll.min.js"></script>
	<script>
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

		/*=== GALERIE script | debut =============*/
		var gallery; 
		$(document).ready(function() { 
			/*--- Galerie ---*/ 
			gallery = new iScroll('gallery', { 
				snap: true, 
				momentum: false, 
				hScrollbar: false, 
				onScrollEnd: function() { 
					$('.pager > li.selected').removeClass('selected'); 
					$('.pager > li').eq(this.currPageX).addClass('selected'); 
				} 
			});

			/*--- Pager ---*/ 
			$('.pager li').on('click', function(e) { 
				var elem = $(this); 
				gallery.scrollToPage(elem.index(), 0, 400); 
			});
		})
		/*=== GALERIE script | fin =============*/

		/*=== RETOURNER script | debut =============*/
		var flips = document.getElementsByClassName('flip'); 
		for(i=0; i<flips.length; i++) { 
			var elem = flips[i]; 
			elem.onclick = function() { 
				if(elem.classList.contains('active')) { 
					elem.classList.remove('active'); 
				} else { 
					elem.classList.add('active'); 
				} 
			} 
		}
		/*=== RETOURNER script | fin =============*/


	</script>

	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?= URL ?>public/scripts/min/jquery-1.11.0.min.js"> \x3C/script>')</script>
    <script src="<?= URL ?>public/scripts/min/mustache.min.js"></script>
	<script>
		$(document).ready(function() {
          _g = new app();
        });
	</script>
</body>
</html>