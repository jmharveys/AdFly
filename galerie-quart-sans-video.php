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
	/* ICONES */

		/* Étoiles */
		.back ul.rating > li {
			display: inline-block;
			background: url(http://localhost:8888/Adfly/public/images/ico-etoile-quart.png) no-repeat 0 0 transparent;
			background-size: contain;
			width: 18px;
			height: 18px;
			margin: 5px 3px 0 0;
			z-index: 10;
		}

		/* Plus Web */
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

		/*Format 1/4 avec vidéo*/

		/* Bouton Play */
		.lp-video-play {
			background: url(http://localhost:8888/Adfly/public/images/btn-play.png);
			background-size: contain;
		}	

		.lp-video-play:active {
			background: url(http://localhost:8888/Adfly/public/images/btn-play-pressed.png);
			background-size: contain;
		}	

		/* Bouton Fermer Vidéo */
		.lp-video-close {
			background: url(http://localhost:8888/Adfly/public/images/btn-close.png);
			background-size: contain;
		}

	</style>
</head>
<body>
	<div class='lp-ad lp-480x325'>
		<!-- <div id="overlay" style="background-image: url('<?= URL ?>public/images/demo/video.jpg');"></div> -->


		<!-- VIDEO 1 html | debut --> 
		<div class='lp-video-bg 1395680443693_video'></div> 
		<div class='lp-video 1395680443693_video' style="width:480px; height:247px;"> 
			<video width='480px' height='247px' controls> 
				<source src='http://s2.cpl.delvenetworks.com/media/6aef184dd0a64f1183a9ec439e89fec8/6c078fb92c3248bda1b38215cf65f004/20130515-174149-5194011dc0d813-64803181-mp48deba435c56e79f2f2e23df7f10f60e694bcf29b.m3u8' /> 
				Votre navigateur ne supporte pas la balise vidéo. 
			</video> 
			<div class='lp-video-close 1395680443693_video'></div> 
		</div> 
		<!-- VIDEO html 1 | fin -->		
		<!-- VIDEO 2 html | debut --> 
		<div class='lp-video-bg 1395680443692_video'></div> 
		<div class='lp-video 1395680443692_video' style="width:480px; height:247px;"> 
			<video width='480px' height='247px' controls> 
				<source src='http://s2.cpl.delvenetworks.com/media/6aef184dd0a64f1183a9ec439e89fec8/8a7b892fd27b4b35bd419e8c0553d1d9/20130415-140101-516c405d8a2a64-83168024-mp4f6ba97a0bf6491751941907b11b1052e0f568e99.m3u8' /> 
				Votre navigateur ne supporte pas la balise vidéo. 
			</video> 
			<div class='lp-video-close 1395680443692_video'></div> 
		</div> 
		<!-- VIDEO html 2 | fin -->
		<!--=== HORS-LIGNE Html | debut =========================-->
		<div id='lp-offline-banner'>
			<div class='lp-offline-warning'>
				Une connexion internet est requise pour visualiser correctement certaines parties de cette annonce.
			</div>
		</div>
		<!--=== HORS-LIGNE Html | fin ===========================-->
		
		<!--=== RETOURNER html | debut ==============-->
			<div class='flip'> 
				<div class='front'>
					<div class="wrapper">
						<div class="logo" style="background-image: url('public/images/demo/tmr.jpg');"></div>
						<div class='gallery'>
							<div class='scroller' style="width: 1920px;">
								<div>
									<!-- VIDEO 1 PLAY html | debut -->
									<div class='lp-video-play 1395680443693_video noFlip'></div> 
									<!-- VIDEO 1 PLAY html | fin -->					
									<div style="background: url('public/images/demo/romana.jpg'); width:480px; height:247px;"></div>
									<div class="description">
										<div>
											<p class="title">Dreams La Romana Resort & Spa</p>
											<p class="subtitle">La Romana,<br/>République Dominicaine</p>
										</div>
										<div>
											<p class="mention">à par pers.  </p>
											<p class="price">99 999</p>
										</div>
									</div>
								</div>
								<div>
									<div style="background: url('public/images/demo/holguin.jpg'); width:480px; height:247px;"></div>
									<div class="description">
										<div>
											<p class="title">Blau Costa Verde</p>
											<p class="subtitle">Holguin, Cuba</p>
										</div>
										<div>
											<p class="mention">à partir de<br/>par pers.</p>
											<p class="price">839</p>
										</div>
									</div>	
								</div>	
								<div>
									<!-- VIDEO 2 PLAY html | debut -->
									<div class='lp-video-play 1395680443692_video noFlip'></div> 
									<!-- VIDEO 2 PLAY html | fin -->		
									<div style="background: url('public/images/demo/acapulco.jpg'); width:480px; height:247px;"></div>
									<div class="description">
										<div>
											<p class="title">Las Brisas Acapulco</p>
											<p class="subtitle">Acapulco, Mexique</p>
										</div>
										<div>
											<p class="mention">à partir de</p>
											<p class="price">1 568</p>
										</div>
									</div>	
								</div>		
								<div>
									<div style="background: url('public/images/demo/playa.jpg'); width:480px; height:247px;"></div>
									<div class="description">
										<div>
											<p class="title">Playa Blanca</p>
											<p class="subtitle">Cayo Largo, Cuba</p>
										</div>
										<div>
											<p class="mention">à partir de<br/>par pers.</p>
											<p class="price">1 098</p>
										</div>
									</div>	
								</div>	
							</div>
							<div class='pager-wrapper 1395680443693_video'>
								<ul class='pager'>
									<li class='selected'>0</li>
									<li>1</li>
									<li>2</li>
									<li>3</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class='back'>
					<div class="wrapper">
						<div class='gallery'>
							<div class='scroller' style="width: 1920px;">
								<div>
									<div class="wrapper-all">
										<div class="description">
											<div>
												<p class="title">Dreams La Romana Resort & Spa</p>
												<p class="subtitle">La Romana,<br/>République Dominicaine</p>
												<ul class="rating">
													<li></li>
													<li></li>
													<li></li>
													<li></li>
												</ul>
											</div>
											<div>
												<p class="mention">à partir de<br/>par pers.</p>
												<p class="price">99 999</p>
											</div>
										</div>
										<div class="wrapper-height">
											<div class="wrapper-infos">
												<div class="infos">21 février 2014 - 7 jours, 6 nuits. Une semaine en formule tout-inclus à l'hôtel Dreams La Romanan Resort & Spa, directement sur la page de Bayahibe. 3 repas style buffet tous les jours, soupers À la carte illimités, vin servi pendant les repas, divertissements en soirée et plus. Une semaine en formule tout-inclus à l'hôtel Dreams La Romanan Resort 
												& Spa, directement sur la page de Bayahibe.</div>
											</div>
										</div>
										<div class="logo" style="background-image: url('public/images/demo/tmr-small.jpg');"></div>
										<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
								</div>
								<div>
									<div class="wrapper-all">
										<div class="description">
											<div>
												<p class="title">Blau Costa Verde</p>
												<p class="subtitle">Holguin, Cuba</p>
												<ul class="rating">
													<li></li>
													<li></li>
													<li></li>
													<li></li>
												</ul>
											</div>
											<div>
												<p class="mention">à partir de<br/>par pers.</p>
												<p class="price">839</p>
											</div>
										</div>
										<div class="wrapper-height">
											<div class="wrapper-infos">
												<div class="infos">29 mars 2014 - 8 jours, 7 nuits. Une semaine en formule tout-inclus à l'hôtel Blau Costa Verde sur la plage de Playa Pesquero Beach. Incluant une nouvelle section Plus qui est réservée à une catégorie de voyageurs, avec piscine privée, bar, et plus. 3 repas style buffet tous les jours, soupers À la carte illimités avec vin servi, divertissements en soirée, etc.</div>
											</div>
										</div>
										<div class="logo" style="background-image: url('public/images/demo/tmr-small.jpg');"></div>
										<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
									<div class='lp-legal-bg noFlip'></div>
									<div class='lp-legal noFlip' style="height:204px; -webkit-transform: translate3d(0, 204px, 0);">
										<div class='lp-legal-btn noFlip'>Légal</div>
										<div class='lp-legal-text noFlip' style="height:204px;">58481100 | Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée.  Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. **</div>
									</div>
								</div>		
								<div>
									<div class="wrapper-all">
										<div class="description">
											<div>
												<p class="title">Las Brisas Acapulco</p>
												<p class="subtitle">Acapulco, Mexique</p>
												<ul class="rating">
													<li></li>
													<li></li>
													<li></li>
													<li></li>
												</ul>
											</div>
											<div>
												<p class="mention">à partir de<br/>par pers.</p>
												<p class="price">1 568</p>
											</div>
										</div>
										<div class="wrapper-height">
											<div class="wrapper-infos">
												<div class="infos">26 février 2014 - 8 jours, 7 nuits. Forfait tout inclus à Acapulco avec Vacances TMR à l'hôtel Las Brisas Acapulco, qui est situés à flanc de montagne, au dessus de la baie d'Acapulco. Pleins de services inclus.</div>
											</div>
										</div>
										<div class="logo" style="background-image: url('public/images/demo/tmr-small.jpg');"></div>
										<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
									<div class='lp-legal-bg noFlip'></div>
									<div class='lp-legal noFlip' style="height:204px; -webkit-transform: translate3d(0, 204px, 0);">
										<div class='lp-legal-btn noFlip'>Légal</div>
										<div class='lp-legal-text noFlip' style="height:204px;">58481100 | Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée.  Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. ** Offre d’une durée limitée. Offres en vigueur du lundi 3 mars au mercredi 26 mars 2014. Quantité limitée sur certains articles. Valable pour les produits en inventaire seulement. Ces offres ne peuvent être jumelées à aucune autre promotion. Détails en magasin. **</div>
									</div>
								</div>	
								<div>
									<div class="wrapper-all">
										<div class="description">
											<div>
												<p class="title">Playa Blanca</p>
												<p class="subtitle">Cayo Largo, Cuba</p>
												<ul class="rating">
													<li></li>
													<li></li>
													<li></li>
													<li></li>
												</ul>
											</div>
											<div>
												<p class="mention">à partir de<br/>par pers.</p>
												<p class="price">1 098</p>
											</div>
										</div>
										<div class="wrapper-height">
											<div class="wrapper-infos">
												<div class="infos">23 février 2014 - 8 jours, 7 nuits. Réservez un forfait tout inclus à Cayo Largo avec Vacances TMR à l'hôtel Playa Blanca, qui est reconnue comme l'un des meilleurs sites de plongée en raison de ses splendides récifs de corail débordant d'une panoplie de petits poissons.</div>
											</div>
										</div>
										<div class="logo" style="background-image: url('public/images/demo/tmr-small.jpg');"></div>
										<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
									<div class='lp-legal-bg noFlip'></div>
									<div class='lp-legal noFlip' style="height:204px; -webkit-transform: translate3d(0, 204px, 0);">
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
								<li>1</li>
								<li>1</li>
							</ul>
						</div>	
					</div>
				</div>
			</div>
		<!--=== RETOURNER html | fin ==============-->
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
				if (  !(event.target.classList.contains('noFlip'))  ) {
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
			//Gardez pour tester et remettre ensuite
			// if(isMobile.Android() || isMobile.iOS()) {
			// 	 location.href = 'lpri://webContentFinishedLoading';
			// }
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

		/* CODE POUR FORMAT 1/4 AVEC VIDÉO | DÉBUT */

		/*=== VIDEO script | debut =========================*/
		var videos = {
			play: document.getElementsByClassName('lp-video-play'),
			close: document.getElementsByClassName('lp-video-close'),
			bg: document.getElementsByClassName('lp-video-bg'),
			player: document.getElementsByClassName('lp-video'),
			stop: function(pClass) {
				var related = document.getElementsByClassName(pClass);
				for(var x=0; x<related.length; x++) {
					related[x].classList.remove('lp-video-active');
					if(related[x].classList.contains('lp-video')) {
					var video = related[x].querySelector('video');
						if(video.currentTime != 0.1) {
							try {
								video.currentTime = 0.1;
							} catch(e) {};
						}
						video.pause();
					}
				}
			}
		}

		/*--- Click btn Jouer ---*/
		for(var x=0; x<videos.play.length; x++) {
			videos.play[x].onclick = function(e) {
				e.stopImmediatePropagation();
				var className = this.classList[1];
				var related = document.getElementsByClassName(className);
				var videoTags = document.getElementsByTagName('video');
				for(var k=0; k<related.length; k++) {
					related[k].classList.add('lp-video-active');
				}
				for(var j=0; j<videoTags.length; j++) {
					if(videoTags[j].parentNode.classList[1] != className) {
						videos.stop(videoTags[j].parentNode.classList[1]);
					} else {
						videoTags[j].play();
					}
				}
			}
		}

		/*--- Click btn Fermer ---*/
		for(var x=0; x<videos.close.length; x++) {
			videos.close[x].onclick = function(e) {
				e.stopImmediatePropagation();
				videos.stop(this.classList[1]);
			}
		}

		/*--- Click Arriere-plan ---*/
		for(var x=0; x<videos.bg.length; x++) {
			videos.bg[x].onclick = function(e) {
				e.stopImmediatePropagation();
				videos.stop(this.classList[1]);
			}
		}

		/*--- Quand la video se termine ---*/
		for(var x=0; x<videos.player.length; x++) {
			videos.player[x].firstElementChild.addEventListener('ended', function() {
				videos.stop(this.parentNode.classList[1]);
			});
		}
		/*=== VIDEO script | fin ===========================*/


		/*=== HORS-LIGNE script | debut ====================*/
		var offlineBanner = document.getElementById('lp-offline-banner');
		var offlineWarning = document.getElementsByClassName('lp-offline-warning')[0];
		if(!window.navigator.onLine) {
			offlineBanner.classList.add('lp-offline');
		}
		offlineWarning.onclick = function() {
			offlineBanner.classList.remove('lp-offline');
		}
		/*=== HORS-LIGNE script | fin ======================*/

		/*=== CODE POUR FORMAT 1/4 AVEC VIDÉO | FIN ===========================*/
	</script>
</body>
</html>