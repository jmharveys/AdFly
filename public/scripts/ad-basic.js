var ad = document.getElementsByClassName('lp-ad')[0];
var flipper = document.getElementsByClassName('lp-flip')[0];
//flipper.addEventListener('tap', flipMe, false); 
flipper.addEventListener('click', flipMe, false); 

function flipMe() { 
    if(!flipper.classList.contains('lp-active') && !ad.classList.contains('moving')) { 
        console.log('Retourner à l\'envers');
        flipper.classList.add('lp-active');
    } else if(flipper.classList.contains('lp-active') && !ad.classList.contains('moving')) {
        console.log('Retourner à l\'endroit');
        flipper.classList.remove('lp-active');
    }
}