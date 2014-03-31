<?php 
	include '../../configs/global.php'; 
?>
<!DOCTYPE html>
<!--[if lt IE 8]> <html class="lt-ie10 lt-ie9 lt-ie8" lang="fr"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie10 lt-ie9" lang="fr"> <![endif]-->
<!--[if IE 9]>    <html class="lt-ie10" lang="fr"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="fr"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>1/16 statique | AdFly </title>
	<meta name="description" property="og:description" content="Outils de création publicitaire pour les annonceurs de La Presse+." />
	<meta name="author" content="Jonathan Harvey, Simon Arnold" />
	<meta property="og:type" content="website"/>
	<link rel="stylesheet" media="all" href="<?= URL ?>public/styles/ad.css">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
		<style>
		<?php include '../images-adgear.php'; ?>
	</style>
</head>
<body>
	<div class='lp-ad lp-230x152'>
		<div id="overlay" style="background-image: url('<?= URL ?>public/images/demo/allegro-back.jpg');"></div>
		<!--=== RETOURNER html | debut ==============-->
			<div class='flip'> 
				<div class='front'>
					<div class="wrapper">
						<div class="wrapper-logo"><div class="logo" style="background-image: url('<?= URL ?>public/images/demo/beltour.jpg');"></div></div>
						<div class='gallery'>
							<div class='scroller' style="width: 230px;">
								<div>
									<div class="description">
										<div>
											<p class="title">Dreams La Romana</p>
											<p class="subtitle">Rép. Dominicaine</p>
										</div>
										<div>
											<p class="mention">à partir de<br/>par pers.</p>
											<p class="price">99 999</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='back'>
					<div class="wrapper">
						<div class='gallery'>
							<div class='scroller' style="width: 230px;">
								<div>
									<div class="description">
										<div>
											<p class="title">Dreams La Romana</p>
											<p class="subtitle">Rép. Dominicaine</p>
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
								</div>											
							</div>
							<div class="close"></div>
							<div class="logo" style="background-image: url('<?= URL ?>public/images/demo/beltour.jpg');"></div>
							<a class="btn-plusWeb noFlip" href="http://www.lapresse.ca"></a>			
						</div>
					</div>
				</div>
			</div>
		<!--=== RETOURNER html | fin ==============-->
	</div>
<script src="<?= URL ?>public/scripts/min/iscroll5.min.js"></script>
	<script>
			var ad = document.getElementsByClassName('lp-ad')[0];

		/*=== RETOURNER script | debut =============*/
		var flipper = document.getElementsByClassName('flip')[0]; 

		//Un appel pour le click et un pour le toucher sur IPAD
		//a disposer selon le canvas utilisé
		flipper.addEventListener('touchstart', flipMe, false); 
		flipper.addEventListener('click', flipMe, false); 

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