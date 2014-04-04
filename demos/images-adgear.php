/* images-adgear.scss */

/* ICONES */


		/* Étoiles */
		.back ul.rating > li {
				background: url(<?= URL; ?>demos/images/ico-etoile-autre.png) no-repeat 0 0 transparent;
				background-size: contain;		
		}

		.lp-480x325 .back ul.rating > li {
				background: url(<?= URL; ?>demos/images/ico-etoile-quart.png) no-repeat 0 0 transparent;
				background-size: contain;
			
		}	

		/* Bouton Fermer */
		.back .close {
		  background: url(<?= URL; ?>demos/images/btn-annuler-light.png) no-repeat 0 0 transparent;
		  background-size: contain;
		}
		
		/* Bouton Fermer ACTIF */
		.back .close:active {
		  background-image: url(<?= URL; ?>demos/images/btn-annuler-pressed.png);
		}


		/* Plus Web */
		.back a.btn-plusWeb {
			background: url(<?= URL; ?>demos/images/btn-plusweb.png) no-repeat 0 0 transparent;
			background-size: contain;		
		}


		/* Bouton +Web ACTIF */
		.back a.btn-plusWeb:active {
			background-image: url(<?= URL; ?>demos/images/btn-plusweb-pressed.png);	
		}	

		/*Format 1/4 avec vidéo*/

		/* Bouton Play */
		.lp-video-play {
			background: url(<?= URL; ?>demos/images/btn-play.png);
			background-size: contain;
		}	

		.lp-video-play:active {
			background: url(<?= URL; ?>demos/images/btn-play-pressed.png);
			background-size: contain;
		}	

		/* Bouton Fermer Vidéo */
		.lp-video-close {
			width: 30px;
			height: 30px;
			background: url(<?= URL; ?>demos/images/btn-close.png);
			background-size: contain;
		}