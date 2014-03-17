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
	<link rel="stylesheet" media="all" href="<?= URL ?>public/styles/ad3.css">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div class='lp-ad'>
		<div id="overlay" style="background-image: url('<?= URL ?>public/images/demo/front2.jpg');"></div>
		<!--=== RETOURNER html | debut ==============-->
		<div class='wrapperFlip' style='top: 0px; left: 0px; width: 480px; height: 324px;'>
			<div class='flip' style='0px; width: 480px; height: 324px;'> 
				<div class='front' style='width: 480px; height: 324px;'>
					<div class="logo" style="background-image: url('public/images/demo/tmr.jpg');"></div>
					<div style="z-index:0;overflow:hidden;width: 480px; height: 324px;position:absolute;">
						<div class='gallery'>
							<div class='scroller'>
								<div>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/chine.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Barcelo Costa Cancun<br/>Barcelo Costa Cancun</p>
											<p class="subtitle">Cancun, Mexique</p>
										</div>
										<div>
											<p class="caption">à partir pers.</p>
											<p class="price">99 999</p>
										</div>
									</div>
								</div>
								<div>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/maroc.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Mazagan<br/>Beach II</p>
											<p class="subtitle">El Jadida, Maroc</p>
										</div>
										<div>
											<p class="caption">14 caractères<br/>2 lignes maxx.</p>
											<p class="price">4&nbsp;199</p>
										</div>
									</div>	
								</div>	
								<div>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/perou.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Machu Picchu Lodge 123</p>
											<p class="subtitle">Machu Picchu, Pérou</p>
										</div>
										<div>
											<p class="caption">14 caractèress<br/>2 lignes maxxx</p>
											<p class="price">1 699</p>
										</div>
									</div>	
								</div>	
								<div>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/portugal.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Rocha Hotel Apartament</p>
											<p class="subtitle">Praia da Rocha, Portugal</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers.</p>
											<p class="price">2 400</p>
										</div>
									</div>	
								</div>	
								<div>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/paris.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Eiffel Capitol Hotel</p>
											<p class="subtitle">Paris, France</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers.</p>
											<p class="price">99,99</p>
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
				<div class='back' style='width: 480px; height: 324px;'>
					<div style="z-index:0;overflow:hidden;width: 480px; height:324px;position:absolute;">
						<div class='gallery'>
							<div class='scroller'>
								<div>
									<div class="close"></div>
									<div class="description">
										<div>
											<p class="title">22 caractères maximumm<br/>3 lignes maximumm mmmm</p>
											<p class="subtitle">16 caractères max.</p>
										</div>
										<div>
											<p class="caption">14 caractèress</p>
											<p class="price">99 999</p>
										</div>
										<ul class="rating">
											<li></li>
											<li></li>
											<li></li>
											<li></li>
										</ul>
										<div class="infos">Actually twee readymade pickled post-ironic, umami lomo selvage put a bird on it next level pop-up asymmetrical. Butcher post-ironic cray Cosby sweater, locavore authentic sustainable quinoa meggings next level retro kale chips Williamsburg. Skateboard Schlitz forage, fanny pack cred wolf fap pour-over. Lo-fi nihil non artisan accusamus. Artisan pariatur nesciunt nulla officia.</div>
									
									<div class="logo" style="background-image: url('public/images/demo/tmr.jpg');"></div>
									<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
									<div class='lp-legal-bg noFlip'></div>
									<div class='lp-legal noFlip'>
										<div class='lp-legal-btn noFlip'>Légal</div>
										<div class='lp-legal-text noFlip'>© Mercedes-Benz Canada Inc., 2014. Les offres peuvent changer sans préavis et ne peuvent être jumelées à d’autres offres. Pour connaître les détails, voyez votre concessionnaire Mercedes-Benz West Island. L’offre est valide du 17 au 19 mars seulement.</div>
									</div>
								</div>
								<div>
									<div class="close"></div>
									<div class="description">
										<div>
											<p class="title">Mazagan<br/>Beach II</p>
											<p class="subtitle">El Jadida, Maroc</p>
										</div>
										<div>
											<p class="caption">14 caractèress<br/>2 lignes maxxx</p>
											<p class="price">4&nbsp;199</p>
										</div>
										<ul class="rating">
											<li></li>
											<li></li>
											<li></li>
										</ul>
										<div class="infos">Actually twee readymade pickled post-ironic, umami lomo selvage put a bird on it next level pop-up asymmetrical. Butcher post-ironic cray Cosby sweater, locavore authentic sustainable quinoa meggings next level retro kale chips Williamsburg. Skateboard Schlitz forage, fanny pack cred wolf fap pour-over. Lo-fi nihil non artisan accusamus. Artisan pariatur nesciunt nulla officia.</div>
									
									<div class="logo" style="background-image: url('public/images/demo/tmr.jpg');"></div>
									<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
									<div class='lp-legal-bg noFlip'></div>
									<div class='lp-legal noFlip'>
										<div class='lp-legal-btn noFlip'>Légal</div>
										<div class='lp-legal-text noFlip'>© Mercedes-Benz Canada Inc., 2014. Les offres peuvent changer sans préavis et ne peuvent être jumelées à d’autres offres. Pour connaître les détails, voyez votre concessionnaire Mercedes-Benz West Island. L’offre est valide du 17 au 19 mars seulement.</div>
									</div>
								</div>	
								<div>
									<div class="close"></div>
									<div class="description">
										<div>
											<p class="title">Machu Picchu Lodge 123</p>
											<p class="subtitle">Machu Picchu, Pérou</p>
										</div>
										<div>
											<p class="caption">14 caractères<br/>2 lignes maxx.</p>
											<p class="price">1 699</p>
										</div>
										<ul class="rating">
											<li></li>
											<li></li>
											<li></li>
											<li></li>
										</ul>
										<div class="infos">Actually twee readymade pickled post-ironic, umami lomo selvage put a bird on it next level pop-up asymmetrical. Butcher post-ironic cray Cosby sweater, locavore authentic sustainable quinoa meggings next level retro kale chips Williamsburg. Skateboard Schlitz forage, fanny pack cred wolf fap pour-over. Lo-fi nihil non artisan accusamus. Artisan pariatur nesciunt nulla officia.</div>
									
									<div class="logo" style="background-image: url('public/images/demo/tmr.jpg');"></div>
									<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
									<div class='lp-legal-bg noFlip'></div>
									<div class='lp-legal noFlip'>
										<div class='lp-legal-btn noFlip'>Légal</div>
										<div class='lp-legal-text noFlip'>© Mercedes-Benz Canada Inc., 2014. Les offres peuvent changer sans préavis et ne peuvent être jumelées à d’autres offres. Pour connaître les détails, voyez votre concessionnaire Mercedes-Benz West Island. L’offre est valide du 17 au 19 mars seulement.</div>
									</div>
								</div>	
								<div>
									<div class="close"></div>
									<div class="description">
										<div>
											<p class="title">Rocha Hotel Apartament</p>
											<p class="subtitle">Praia, Portugal</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers.</p>
											<p class="price">2 400</p>
										</div>
										<ul class="rating">
											<li></li>
										</ul>
										<div class="infos">Actually twee readymade pickled post-ironic, umami lomo selvage put a bird on it next level pop-up asymmetrical. Butcher post-ironic cray Cosby sweater, locavore authentic sustainable quinoa meggings next level retro kale chips Williamsburg. Skateboard Schlitz forage, fanny pack cred wolf fap pour-over. Lo-fi nihil non artisan accusamus. Artisan pariatur nesciunt nulla officia.</div>
									
									<div class="logo" style="background-image: url('public/images/demo/tmr.jpg');"></div>
									<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
									<div class='lp-legal-bg noFlip'></div>
									<div class='lp-legal noFlip'>
										<div class='lp-legal-btn noFlip'>Légal</div>
										<div class='lp-legal-text noFlip'>© Mercedes-Benz Canada Inc., 2014. Les offres peuvent changer sans préavis et ne peuvent être jumelées à d’autres offres. Pour connaître les détails, voyez votre concessionnaire Mercedes-Benz West Island. L’offre est valide du 17 au 19 mars seulement.</div>
									</div>
								</div>	
								<div>
									<div class="close"></div>
									<div class="description">
										<div>
											<p class="title">Effeil Capitol Hotel</p>
											<p class="subtitle">Paris, France</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers.</p>
											<p class="price">99,99</p>
										</div>
										<ul class="rating">
											<li></li>
											<li></li>
										</ul>
										<div class="infos">Actually twee readymade pickled post-ironic, umami lomo selvage put a bird on it next level pop-up asymmetrical. Butcher post-ironic cray Cosby sweater, locavore authentic sustainable quinoa meggings next level retro kale chips Williamsburg. Skateboard Schlitz forage, fanny pack cred wolf fap pour-over. Lo-fi nihil non artisan accusamus. Artisan pariatur nesciunt nulla officia.</div>
									
									<div class="logo" style="background-image: url('public/images/demo/tmr.jpg');"></div>
									<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>
									</div>
									<div class='lp-legal-bg noFlip'></div>
									<div class='lp-legal noFlip'>
										<div class='lp-legal-btn noFlip'>Légal</div>
										<div class='lp-legal-text noFlip'>© Mercedes-Benz Canada Inc., 2014. Les offres peuvent changer sans préavis et ne peuvent être jumelées à d’autres offres. Pour connaître les détails, voyez votre concessionnaire Mercedes-Benz West Island. L’offre est valide du 17 au 19 mars seulement.</div>
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
		<!--=== RETOURNER html | fin ==============-->
	</div>



</div>

	

</div>
	<script src="<?= URL ?>public/scripts/min/mustache.min.js"></script>
	<script src="<?= URL ?>public/scripts/min/iscroll5.min.js"></script>
	<script>
		/*=== RETOURNER script | debut =============*/
		var flips = document.getElementsByClassName('flip'); 
		var container = document.getElementsByClassName('lp-ad')[0];
		var elem = flips[0]; 
		elem.addEventListener('tap', flipMe, false); 

		function flipMe() { 
			// Si je n'ai pas flipper et que je ne scroll pas.
			if(!(elem.classList.contains('active')) && !(container.classList.contains('moving')) ) { 
				if ( !(elem.classList.contains('flipped')) ) {
					elem.classList.add('active');
					elem.addEventListener("transitionend", flipDone, false);
				} 

			}
			if ( elem.classList.contains('active') && container.classList.contains('flipped') && !(container.classList.contains('moving')) ) { 
					if (  !(event.target.classList.contains('noFlip'))  ) {
						elem.classList.remove('active'); 
						container.classList.remove('flipped'); 
					} else {
						container.classList.add('legalOpen');
					}
			} 
		}

		function flipDone() {
			if (!container.classList.contains('flipped')) {
				container.classList.add('flipped');
				elem.removeEventListener("transitionend", flipDone, false);
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
			container.classList.add('moving');
		}


		function endScroll() {
			var currentPage = this.currentPage.pageX;
			container.classList.remove('moving');
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

		// / Gestion LÉGAL
		var legalBg = document.getElementsByClassName('lp-legal-bg');
		var legalList = document.getElementsByClassName('lp-legal');

		function legal(container,btn,bg)
		{
			this.container = container;
			this.btn = btn;
			this.bg = bg;
			function animate() {
				if(bg.classList.contains('lp-legal-active')) {
					container.classList.remove('lp-legal-active');
					bg.classList.remove('lp-legal-active');
				} else {
					bg.classList.add('lp-legal-active');
					container.classList.add('lp-legal-active');
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