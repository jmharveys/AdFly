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
					<div id="logo" style="background-image: url('public/images/demo/tmr.jpg');"></div>
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
											<p class="caption">à partir de<br/>par pers</p>
											<p class="price">1 358</p>
										</div>
									</div>
								</div>
								<div>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/maroc.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Mazagan Beach Resort</p>
											<p class="subtitle">El Jadida, Maroc</p>
										</div>
										<div>
											<p class="caption">à partir de eff</p>
											<p class="price">99&nbsp;199</p>
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
											<p class="caption">à partir de<br/>par pers</p>
											<p class="price">1 699</p>
										</div>
									</div>	
								</div>	
								<div>
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
								<div>
									<div style='width: 480px; height: 246px; background-image: url("public/images/demo/paris.jpg");'></div>
									<div class="description">
										<div>
											<p class="title">Eiffel Capitol Hotel</p>
											<p class="subtitle">Paris, France</p>
										</div>
										<div>
											<p class="caption">à partir de<br/>par pers</p>
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
									<div class="description">
										<div>
											<p class="title">22 caractères maximum<br/>3 lignes pour el bloc total</p>
											<p class="subtitle">16 caractères max.</p>
										</div>
										<div>
											<p class="caption">14 caractèress<br/>2 lignes maxxx</p>
											<p class="price">99 999</p>
										</div>
										<div style="float:left;">Actually twee readymade pickled post-ironic, umami lomo selvage put a bird on it next level pop-up asymmetrical. Butcher post-ironic cray Cosby sweater, locavore authentic sustainable quinoa meggings next level retro kale chips Williamsburg. Skateboard Schlitz forage, fanny pack cred wolf fap pour-over. Lo-fi nihil non artisan accusamus. Artisan pariatur nesciunt nulla officia farm-to-table sriracha. You probably haven't heard of them et cliche sunt. Drinking vinegar dreamcatcher photo booth, plaid cray laboris irony bespoke biodiesel mumblecore seitan twee nihil delectus wayfarers.</div>
									</div>
								</div>
								<div>2</div>	
								<div>3</div>	
								<div>4</div>	
								<div>5</div>	
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
		var elem = flips[0]; 
		var body = document.body;
		elem.addEventListener('tap', flipMe, false); 

		function flipMe() { 
			// Si je n'ai pas flipper et que je ne scroll pas.
			if(!(elem.classList.contains('active')) && !(body.classList.contains('moving')) ) { 
				if ( !(elem.classList.contains('flipped')) ) {
					elem.classList.add('active');
					elem.addEventListener("transitionend", flipDone, false);
				} 

			}
			if ( elem.classList.contains('active') && body.classList.contains('flipped') && !(body.classList.contains('moving')) ) { 
					elem.classList.remove('active'); 
					body.classList.remove('flipped'); 
			} 
		}

		function flipDone() {
			if (!body.classList.contains('flipped')) {
				body.classList.add('flipped');
				elem.removeEventListener("transitionend", flipDone, false);
			} 
		}			

		/*=== RETOURNER script | fin =============*/

		// Boucle à travers tous les elem dans un dom pour une class donnée et appel pour chacun une fonction en callback 
		function forEachQuery( elem, callback ) {
		  Array.prototype.forEach.call( document.querySelectorAll('.' + elem), callback );
		}

		function cleanWhitespace(node)
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
		      cleanWhitespace(child);
		    }
		  }
		  return node;
		}

		function endScroll() {
			var currentPage = this.currentPage.pageX;
			body.classList.remove('moving');
			forEachQuery( 'selected', function( el2, index1, array1 ) {
				el2.classList.remove('selected');
			});
			forEachQuery( 'pager', function( el2, index1, array1 ) {
				var bullet = cleanWhitespace(el2).childNodes[currentPage];
				bullet.classList.add('selected');
			});			
			gallery.goToPage(this.currentPage.pageX, 0, 0);
		}

		function scrollStart() {
			body.classList.add('moving');
		}

		var gallery; 
		var wrapper = document.getElementsByClassName('gallery');

		function initGallery(elem) {
		    gallery = new IScroll(elem, { 
				snap: true, 
				scrollX: true,
				scrollY: false,
				momentum: false, 
				hScrollbar: false,
				snapThreshold: 10,
				tap: true
			});
			gallery.on('scrollEnd', endScroll);
			gallery.on('scrollStart', scrollStart);
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
				body.classList.add('lp-is-android');
			} else {
				body.classList.add('lp-is-ios');
			}
			body.classList.add('lp-loaded');
		}
	</script>
</body>
</html>