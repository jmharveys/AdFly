var ad = document.getElementsByClassName('lp-ad')[0];
var flipper = document.getElementsByClassName('lp-flip')[0];
var link = document.getElementsByClassName('lp-plus-web');
var defaultEvent = "click";
var isMobile = {
	Android: function() {
		return navigator.userAgent.match(/Android/i);
	},
	iOS: function() {
		return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},
 	any: function() {
        return (isMobile.Android() || isMobile.iOS());
    }	
}
for(var x=0; x<link.length; x++) {
	link[x].addEventListener(defaultEvent, linkTap, false); 
}
function linkTap(e) {
	e.stopImmediatePropagation();
}	

{{#exist.video}}
/*=== HORS-LIGNE script | debut ====================*/
var offlineBanner = document.getElementById('lp-offline-banner');
var offlineWarning = document.getElementsByClassName('lp-offline-warning')[0];
if(!window.navigator.onLine) {
	offlineBanner.classList.add('lerep-active');
}
offlineWarning.onclick = function() {
	offlineBanner.classList.remove('lp-active');
}
/*=== HORS-LIGNE script | fin ======================*/

/*=== VIDEO script | debut =========================*/
var videos = {
	play: document.getElementsByClassName('lp-video-play'),
	close: document.getElementsByClassName('lp-video-close'),
	bg: document.getElementsByClassName('lp-video-bg'),
	player: document.getElementsByClassName('lp-video'),
	stop: function(pClass) {
		var related = document.getElementsByClassName(pClass);
		for(var x=0; x<related.length; x++) {
			related[x].classList.remove('lp-active');
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
			related[k].classList.add('lp-active');
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
{{/exist.video}}

{{#exist.legal}}
/*=== LEGAL ========================================*/
var legalBg = document.getElementsByClassName('lp-legal-bg');
var legalList = document.getElementsByClassName('lp-legal');


function legal(container, bg) {
	function animate() {
		if(container.classList.contains('lp-active')) {
			container.classList.remove('lp-active');
			ad.classList.remove('lp-legalOpen');
		} else {
			container.classList.add('lp-active');
			ad.classList.add('lp-legalOpen');
		}
	}
	container.addEventListener(defaultEvent, legalTap, false); 
	bg.addEventListener(defaultEvent, legalTap, false); 
	function legalTap(e) {
		e.stopImmediatePropagation();
		animate();
	}	
}

for(var i=0; i<legalList.length; i++) {
	new legal(legalList[i], legalBg[i]);
}

/*=== LEGAL script | fin ===========================*/
{{/exist.legal}}	

{{#exist.gallery}}
/*=== Gallerie offres ==============================*/
var gallery; 
var wrapper = document.getElementsByClassName('lp-gallery');
var galleries = new Array();

function forEachQuery( elem, callback ) {
  Array.prototype.forEach.call( document.querySelectorAll('.' + elem), callback );
}

Array.prototype.forEach.call(wrapper, function(el) {
    initGallery(el);
});

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
	});
	gallery.on('scrollEnd', endScroll);
	gallery.on('scrollStart', startScroll);
	galleries.push(gallery);
}

function startScroll() {
	ad.classList.add('lp-scrolling');
}

function endScroll() {
	var currentPage = this.currentPage.pageX;
	var legals = flipper.querySelectorAll('.lp-legal.lp-active');
	ad.classList.remove('lp-scrolling');
	forEachQuery('lp-selected', function(el2, index1, array1) {
		el2.classList.remove('lp-selected');
	});
	forEachQuery('lp-wrapper', function(el2, index1, array1) {
		var bullet = el2.querySelectorAll('.lp-bullet')[currentPage];
		bullet.classList.add('lp-selected');
	});	
	Array.prototype.forEach.call(galleries, function(el) {
    	el.goToPage(currentPage, 0, 0);
	});	
    for(var x=0; x<legals.length; x++) {
    	legals[x].classList.remove('lp-active');
    }	
}
{{/exist.gallery}}

/*=== Flip =========================================*/

flipper.addEventListener(defaultEvent, flipMe, false); 

function flipDone() {
	if (!ad.classList.contains('lp-flipped')) {
		ad.classList.add('lp-flipped');
		flipper.removeEventListener("transitionend", flipDone, false);
	} 
}	

function flipMe() { 
	if(!(flipper.classList.contains('lp-active')) && !(ad.classList.contains('lp-scrolling')) ) { 
			flipper.classList.add('lp-active');
			flipper.addEventListener("transitionend", flipDone, false);
	}
	if ( flipper.classList.contains('lp-active') && ad.classList.contains('lp-flipped') && !(ad.classList.contains('lp-scrolling')) ) { 
			flipper.classList.remove('lp-active'); 
			ad.classList.remove('lp-flipped'); 
	} 
}

window.onload = function() {	
	var pagers = document.querySelectorAll('.lp-wrapper');
	for(var x=0; x<pagers.length; x++) {
		pagers[x].querySelector('.lp-bullet').classList.add('lp-selected');
	}
	if( isMobile.any() ){
	 	location.href = 'lpri://webContentFinishedLoading';
	 }
}