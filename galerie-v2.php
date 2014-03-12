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
	<title>Démo Galerie | AdFly </title>
	<meta name="description" property="og:description" content="Outils de création publicitaire pour les annonceurs de La Presse+." />
	<meta name="author" content="Jonathan Harvey, Simon Arnold" />
	<meta property="og:type" content="website"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" media="all" href="<?= URL ?>public/styles/ad2.css">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

	<div class='lp-ad'>
		
		
		<!--=== RETOURNER html | debut ==============-->
		<div class='wrapperFlip' style='top: 0px; left: 0px; width: 480px; height: 324px;'>
			<div class='flip' style='0px; width: 480px; height: 324px;'> 
				
				<div style='top: 0; left: 0; width: 480px; height: 324px; ' class='test'>
					<div style="z-index:0;overflow:hidden;width: 480px; height: 324px;position:absolute;">
						<div id='galleryFront'>
							<div class='scroller'>
								<div class='wrapperFront'>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/chine.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Grand China Princess</p>
											<p class="subtitle">Bangkok, Chine</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers</p>
											<p class="price">1 358</p>
										</div>
									</div>
								</div>
								<div class='wrapperFront'>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/maroc.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Mazagan Beach Resort</p>
											<p class="subtitle">El Jadida, Maroc</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers</p>
											<p class="price">2 199</p>
										</div>
									</div>	
								</div>	
								<div class='wrapperFront'>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/perou.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Machu Picchu Sanctuary Lodge</p>
											<p class="subtitle">Machu Picchu, Pérou</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers</p>
											<p class="price">1 699</p>
										</div>
									</div>	
								</div>	
								<div class='wrapperFront'>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/portugal.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Rocha Hotel Apartamento</p>
											<p class="subtitle">Praia da Rocha, Portugal</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers</p>
											<p class="price">2 400</p>
										</div>
									</div>	
								</div>	
								<div class='wrapperFront'>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/paris.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Eiffel Capitol Hotel</p>
											<p class="subtitle">Paris, France</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers</p>
											<p class="price">999</p>
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
					</div>
				</div>
				
				<div style='top: 0; left: 0; width: 480px; height: 324px;' class='test'>
	
					<div style="z-index:0;overflow:hidden;width: 480px; height: 324px;position:absolute;">
						<div id='galleryBack'>
							<div class='scroller'>
								<div class='wrapperFront'>1</div>
								<div class='wrapperFront'>2</div>	
								<div class='wrapperFront'>3</div>	
								<div class='wrapperFront'>4</div>	
								<div class='wrapperFront'>5</div>	
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
					</div>
				</div>
		<!--=== RETOURNER html | fin ==============-->

		
	</div>
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
		var galleryFront; 
		var galleryBack; 
		$(document).ready(function() { 
			/*--- Galerie ---*/ 
			galleryFront = new iScroll('galleryFront', { 
				snap: true, 
				momentum: false, 
				hScrollbar: false, 
				onScrollMove: function() {
					document.body.classList.add('moving');
      			},	
     			onScrollEnd : function(){
					document.body.classList.remove('moving');
					$('.pager > li.selected').removeClass('selected'); 
					$('.pager > li').eq(this.currPageX).addClass('selected');
					galleryBack.scrollToPage(this.currPageX, 0, 0); 
   				}
			});

		galleryBack = new iScroll('galleryBack', { 
				snap: true, 
				momentum: false, 
				hScrollbar: false, 
				onScrollMove: function() {
					document.body.classList.add('moving');
      			},	
     			onScrollEnd : function(){
					document.body.classList.remove('moving');
					$('.pager > li.selected').removeClass('selected'); 
					$('.pager > li').eq(this.currPageX).addClass('selected');
					console.log(this.currPageX);
					galleryFront.scrollToPage(this.currPageX, 0, 0);   
   				}				
			});


			/*--- Pager ---*/ 
			// $('.pager li').on('click', function(e) { 
			// 	var elem = $(this); 
			// 	galleryFront.scrollToPage(elem.index(), 0, 400); 
			// });
		})
		/*=== GALERIE script | fin =============*/

		/*=== RETOURNER script | debut =============*/
		var flips = document.getElementsByClassName('flip'); 
			var elem = flips[0]; 
			elem.onclick = function() { 
				if(!(elem.classList.contains('active')) && !(document.body.classList.contains('moving')) ) { 
					elem.classList.add('active'); 
				} else { 
					elem.classList.remove('active'); 
				} 
			}

		/*=== RETOURNER script | fin =============*/

	</script>

	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?= URL ?>public/scripts/min/jquery-1.11.0.min.js"> \x3C/script>')</script>
    <script src="<?= URL ?>public/scripts/min/mustache.min.js"></script>
	<script>
		// $(document).ready(function() {
  //         _g = new app();
  //       });
	</script>
</body>
</html>