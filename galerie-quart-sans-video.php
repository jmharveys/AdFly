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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" media="all" href="<?= URL ?>public/styles/ad.css">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style>
		/* ICONES rétina POUR L'ARRIÈRE DU FLIP */
	.back ul.rating > li {
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
	<div class='lp-ad quart'>
		<div id="overlay" style="background-image: url('<?= URL ?>public/images/demo/holguin-back.jpg');"></div>
		<!--=== RETOURNER html | debut ==============-->
		<div class='wrapperFlip' style='top: 0px; left: 0px; width: 480px; height: 325px;'>
			<div class='flip' style='0px; width: 480px; height: 325px;'> 
				<div class='front' style='width: 480px; height: 325px;'>
					<div class="logo" style="background-image: url('public/images/demo/tmr.jpg');"></div>
					<div style="z-index:0;overflow:hidden;width: 480px; height: 325px;position:absolute;">
						<div class='gallery'>
							<div class='scroller' style="width: 960px;">
								<div>
									<div style='width: 480px; height: 247px; background-image: url("public/images/demo/romana.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Dreams La Romana Resort & Spa</p>
											<p class="subtitle">La Romana,<br/>République Dominicaine</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers.</p>
											<p class="price">809</p>
										</div>
									</div>
								</div>
								<div>
									<div style='width: 480px; height: 247px; background-image: url("public/images/demo/holguin.jpg");'></div>
									<div class="description">
										<div class="opposite">
											<p class="title">Blau Costa Verde</p>
											<p class="subtitle">Holguin, Cuba</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers.</p>
											<p class="price">839</p>
										</div>
									</div>	
								</div>	
							</div>
							<div class='pager-wrapper'>
								<ul class='pager'>
									<li class='selected'>0</li>
									<li>1</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class='back' style='width: 480px; height: 325px;'>
					<div style="z-index:0;overflow:hidden;width: 480px; height:325px;position:absolute;">
						<div class='gallery'>
							<div class='scroller' style="width: 960px;">
								<div>
									<div class="close"></div>
									<div class="description">
										<div>
											<p class="title">Dreams La Romana Resort & Spa</p>
											<p class="subtitle">La Romana,<br/>République Dominicaine</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers.</p>
											<p class="price">809</p>
										</div>
										<ul class="rating">
											<li></li>
											<li></li>
											<li></li>
											<li></li>
										</ul>
										<div class="infos">21 février 2014 - 7 jours, 6 nuits. Une semaine en formule tout-inclus à l'hôtel Dreams La Romanan Resort & Spa, directement sur la page de Bayahibe. 3 repas style buffet tous les jours, soupers À la carte illimités, vin servi pendant les repas, divertissements en soirée et plus.</div>
									
									<div class="logo" style="background-image: url('public/images/demo/tmr-small.jpg');"></div>
									<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
								</div>
								<div>
									<div class="close"></div>
									<div class="description">
										<div class="opposite">
											<p class="title">Blau Costa Verde</p>
											<p class="subtitle">Holguin, Cuba</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers.</p>
											<p class="price">839</p>
										</div>
										<ul class="rating">
											<li></li>
											<li></li>
											<li></li>
											<li></li>
										</ul>
										<div class="infos">29 mars 2014 - 8 jours, 7 nuits. Une semaine en formule tout-inclus à l'hôtel Blau Costa Verde sur la plage de Playa Pesquero Beach. Incluant une nouvelle section Plus qui est réservée à une catégorie de voyageurs, avec piscine privée, bar, et plus. 3 repas style buffet tous les jours, soupers À la carte illimités avec vin servi, divertissements en soirée, etc.</div>
									
									<div class="logo" style="background-image: url('public/images/demo/tmr-small.jpg');"></div>
									<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
									<div class='lp-legal-bg noFlip'></div>
									<div class='lp-legal noFlip' style="height:204px;">
										<div class='lp-legal-btn noFlip'>Légal</div>
										<div class='lp-legal-text noFlip' style="height:204px;">58481100 | Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée.  Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. **</div>
									</div>
								</div>	
							</div>				
						</div>
						<div class='pager-wrapper'>
							<ul class='pager'>
								<li class='selected'>0</li>
								<li>1</li>
							</ul>
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

		/*=== RETOURNER script | fin =============*/

		// Boucle à travers tous les elem dans un dom pour une class donnée et appel pour chacun une fonction en callback 
		function forEachQuery( elem, callback ) {
		  Array.prototype.forEach.call( document.querySelectorAll('.' + elem), callback );
		}

		//Enlève les espaces dans les childnodes
		function cleanWhiteSpace(node)
		{
		  for (var i=0; i<node.childNodes.length; i++)
		  {
		    var child = node.childNodes[i];
		    if(child.nodeType == 3 && !/\S/.test(child.nodeValue))
		    {
		      node.removeChild(child);
		      i--;
		    }
		    if(child.nodeType == 1)
		    {
		      cleanWhiteSpace(child);
		    }
		  }
		  return node;
		}

		//Lorsqu'on scroll on 
		function startScroll() {
			ad.classList.add('moving');
		}

		function endScroll() {
			ad.classList.remove('legalOpen','moving');
			var currentPage = this.currentPage.pageX;
			forEachQuery( 'selected', function( el2, index1, array1 ) {
				el2.classList.remove('selected');
			});
			forEachQuery( 'pager', function( el2, index1, array1 ) {
				var bullet = cleanWhiteSpace(el2).childNodes[currentPage];
				bullet.classList.add('selected');
			});			
			Array.prototype.forEach.call(myGallerys, function(el) {
		    	el.goToPage(currentPage, 0, 0);
			});	
			Array.prototype.forEach.call(currentLegal, function(el) {
		    	el.classList.remove('lp-legal-active');
			});					
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

			var gallery; 
			var wrapper = document.getElementsByClassName('gallery');
			var myGallerys = new Array();

			function initGallery(elem) {
			    gallery = new IScroll(elem, { 
					snap: true, 
					scrollX: true,
					scrollY: false,
					momentum: false, 
					hScrollbar: false,
					snapThreshold: 10,
					tap: true,
					click: true 
					// Activé seulement pour desktop afin de rendre les liens cliquable
				});
				gallery.on('scrollEnd', endScroll);
				gallery.on('scrollStart', startScroll);
				myGallerys.push(gallery);
			}

			Array.prototype.forEach.call(wrapper, function(el) {
			    initGallery(el);
			});					

			//Gestion LÉGAL
			var legalBg = document.getElementsByClassName('lp-legal-bg');
			var legalList = document.getElementsByClassName('lp-legal');
			var currentLegal= new Array();
			function legal(container,btn,bg)
			{
				this.container = container;
				this.btn = btn;
				this.bg = bg;
				function animate() {
					if(bg.classList.contains('lp-legal-active')) {
						container.classList.remove('lp-legal-active');
						bg.classList.remove('lp-legal-active');
						ad.classList.remove('legalOpen');
					} else {
						bg.classList.add('lp-legal-active');
						ad.classList.add('legalOpen');
						container.classList.add('lp-legal-active');
						currentLegal.push(bg,container);
					}
				}
				btn.onclick = function() { 
					animate();
				};
				bg.onclick = function() { 
					animate();
				};			
			}

			for (var i = 0; i < legalList.length; ++i) {
				new legal(legalList[i],cleanWhiteSpace(legalList[i]).childNodes[0],legalBg[i]);
			}		
	</script>
</body>
</html>