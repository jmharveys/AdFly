var ad = document.getElementsByClassName('lp-ad')[0];
var flipper = document.getElementsByClassName('lp-flip')[0];
var offers = document.getElementsByClassName('lp-offer');
//flipper.addEventListener('tap', flipMe, false); 

{{#video.exist}}
/*=== HORS-LIGNE script | debut ====================*/
var offlineBanner = document.getElementById('lp-offline-banner');
var offlineWarning = document.getElementsByClassName('lp-offline-warning')[0];
if(!window.navigator.onLine) {
	offlineBanner.classList.add('lp-active');
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
{{/video.exist}}

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
	ad.classList.remove('legalOpen','lp-scrolling');
	var currentPage = this.currentPage.pageX;
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
	/*Array.prototype.forEach.call(currentLegal, function(el) {
    	el.classList.remove('lp-legal-active');
	});	*/		
}

/*=== Flip =========================================*/
flipper.addEventListener('click', flipMe, false); 
function flipMe() { 
    if(!flipper.classList.contains('lp-active') && !ad.classList.contains('lp-scrolling')) { 
        console.log('Retourner à l\'envers');
        flipper.classList.add('lp-active');
    } else if(flipper.classList.contains('lp-active') && !ad.classList.contains('lp-scrolling')) {
        console.log('Retourner à l\'endroit');
        flipper.classList.remove('lp-active');
    }
}

window.onload = function() {
	var pagers = document.querySelectorAll('.lp-wrapper');
	for(var x=0; x<pagers.length; x++) {
		pagers[x].querySelector('.lp-bullet').classList.add('lp-selected');
	}
}