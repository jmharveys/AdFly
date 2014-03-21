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
	<title>Galerie 1/8 H  | AdFly </title>
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
	<div class='lp-ad huitieme-h une-offre'>
		<div id="overlay" style="background-image: url('<?= URL ?>public/images/demo/barcelo-back.jpg');"></div>
		<!--=== RETOURNER html | debut ==============-->
		<div class='wrapperFlip'>
			<div class='flip'> 
				<div class='front'>
					<div class="logo" style="background-image: url('public/images/demo/bergeron.jpg');"></div>
					<div  class="wrapper">
						<div class='gallery'>
							<div class='scroller' style="width: 656px;">
								<div>
									<div style='width: 328px; height: 152px; background-image: url("public/images/demo/barcelo1.jpg");float: left;'></div>
								</div>
								<div>
									<div style='width: 328px; height: 152px; background-image: url("public/images/demo/barcelo2.jpg");float:left;'></div>
								</div>	
							</div>
							<div class='pager-wrapper'>
								<ul class='pager'>
									<li class='selected'>0</li>
									<li>1</li>
								</ul>
							</div>							
							<div class="description">
								<div>
									<p class="title">Barcelo Huatulco Beach</p>
									<p class="subtitle">Huatulco,<br/>Mexique</p>
								</div>
								<div>
									<p class="caption">à partir de.<br/>par pers.</p>
									<p class="price">725</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='back'>
					<div style="z-index:0;overflow:hidden;width: 480px; height:152px;position:absolute;">
					<div>
						<div class="close"></div>
						<div class="description">
							<div class="opposite">
								<p class="title">Barcelo Huatulco Beach</p>
								<p class="subtitle">Huatulco, Mexique</p>
							</div>
							<div>
								<p class="caption">à partir de</p>
								<p class="price">725</p>
							</div>
							<ul class="rating">
								<li></li>
								<li></li>
								<li></li>
								<li></li>
							</ul>
							<div class="infos">30 avril 2014 - 8 jours, 7 nuits. L'hôtel Barcelo Huatulco Beach jouit d'un emplacement de choix au bord de la mer sur la baie de Tangolunda, et offre une vue imprenable sur les plages du Mexique.</div>
						<div class="logo" style="background-image: url('public/images/demo/bergeron-small.jpg');"></div>
						<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
						</div>
					</div>
				</div>	
				</div>
			</div>
		<!--=== RETOURNER html | fin ==============-->
		</div>
	</div>
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