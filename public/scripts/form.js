// JavaScript Document
var _g = globals = {};
var app = app || {};  //Évite d'overwritter des plugins s'il y en a

app = function(pCulture, pRoot) {
  var self = this;
  self.path = { // Path permettant d'accèder aux divers fichiers externes utilisés.
    root:       pRoot,
    data:       pRoot + "public/data/",
    settings:   pRoot + "public/data/settings/",
    librairies: pRoot + "app/libraries/",
    images:     pRoot + 'public/images/',
    templates:  pRoot + 'public/templates/',
    temps:      pRoot + 'temps/'
  }

  self.form = {
    step: 1,
    culture: pCulture,
    settings: {}, // Contiens tous les settings possibles (default, 480x325, etc)
    current: {
      id: 0,
      offersNbr: 0
    }
  }

  self.defaultAd = { // Annonce par défaut
    category: "deals",
    format: {
      text: "480x325",
      w: 480,
      h: 325
    },
    offers: [],
    gallery: false
  }
  $.extend(self.ad = {}, self.defaultAd);

  $.when( //Télécharge tous les settings externes nécessaires
    $.get( self.path.templates + 'form-offer-tpl.mustache.html', function(r) { self.ad.template = r; } ),
    $.getJSON( self.path.data + "translations.json", function(r) { self.form.text = r[self.form.culture]; } ),
    $.getJSON( self.path.settings + "default.json", function(r) { self.form.settings.default = r; } ),
    $.getJSON( self.path.settings + "230x152.json", function(r) { self.form.settings['230x152'] = r; } ),
    $.getJSON( self.path.settings + "230x325.json", function(r) { self.form.settings['230x325'] = r; } ),
    $.getJSON( self.path.settings + "480x152.json", function(r) { self.form.settings['480x152'] = r; } ),
    $.getJSON( self.path.settings + "480x325.json", function(r) { self.form.settings['480x325'] = r; } )
  ).then(function() { // Ensuite initialise la page
    //--- functions -----------------
    self.map_(); 
    self.init_();
    self.bindEvents_();
  });
};

//=== MAP START =====================================================
app.prototype.map_ = function() {
  var self = this;
  self.dom = {
    b: $('body'),
    header: $('.main-header'),
    import: $('.js-import-ad'),
    f: $('.js-form'),
    steps: $('.steps'),
    step1: $('.step.no1'),
    step2: $('.step.no2'),
    step3: $('.step.no3'),
    goStep1: $('.js-goStep1'),
    goStep2: $('.js-goStep2'),
    goStep3: $('.js-goStep3'),
    offersNbr: $('[name="offersNbr"]'),
    addOfferBtn: $('.addOffer'),
    addOfferMsg: $('.addOfferMsg'),
    offersList: $('.offersList'),
    render: $('iframe.render'),
    zipable: $('iframe.zipable'),
    downloadBtn: $('.js-download'),
    popupConfirmation: $('.popup.confirmation'),
    cancel: $('.popup.confirmation .js-cancel'),
    confirmBtn: $('.popup.confirmation .js-confirm'),
    popupDelete: $('.popup.delete'),
    cancelErease: $('.popup.delete .js-cancel'),
    confirmErease: $('.popup.delete .js-confirm'),
    field: {
      id: $('[name="id"]'),
      offersId: $('[name="offersId"]'),
      noClient: $('[name="noClient"]'),
      noAd: $('[name="noAd"]'),
      category: $('[name="category"]'),
      preLogo: $('[name="pre-logo"]'),
      logo: $('.file-input[name=logo]'),
      logoPreview: $('.field.logo .preview'),
      offersNbr: $('[name=offersNbr]'),
      date: $('[name="date"]'),
      formatRadio: $(".row.format input"),
      format: $('[name="format"]'),
      iConfirm: $('[name="iConfirm"]')
    }
  };
};

//=== INIT START =====================================================
app.prototype.init_ = function(pObj) {
  var self = this;
  self.ad.id = new Date().getTime() + Math.floor(Math.random() * 10);
  self.dom.field.id.val(self.ad.id);

  /* jQuery Validate */
  jQuery.extend(jQuery.validator.messages, {
    required: ' <span class="msg">(' + self.form.text['requiredField'] + ')</span>',
    maxlength: jQuery.validator.format(' <span class="msg">(' + self.form.text['maxlength'] + ')</span>')
  });

  $.validator.addMethod("time", function(value, element) {  
    return this.optional(element) || /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])?$/i.test(value);  
  }, "Please enter a valid time.");

  self.validator = self.dom.f.validate({
    debug: true,
    errorPlacement: function(error, element) {
      error.appendTo(element.closest('.field').find('.lbl'));
    },
    highlight: function(element, errorClass, validClass) {
      $(element).closest('.field').addClass('error').removeClass('valid');
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).closest('.field').addClass('valid').removeClass('error');
    },
    rules: {
      noClient: {
        required: true
      },
      noAd: {
        required: false,
        minlength: 7,
        maxlength: 7
      },
      logo: {
        required: true
      }
    },
    messages: {
      noAd: {
        minlength: ' <span class="msg">(' + self.form.text['mustContain7digits'] + ')</span>',
        maxlength: ' <span class="msg">(' + self.form.text['mustContain7digits'] + ')</span>'
      }
    }  
  });


  /* jQuery Mask */
  self.dom.field.noAd.mask('0000000'); // 7 char

  // replace the checkboxes with the images
  self.dom.field.formatRadio.each(function() {
      var radio = $(this);
      var value = radio.val();
      if(radio.attr('checked')) { // radio button is checked onload
          radio.hide();
          radio.after($("<img src='" + self.path.images + "formats/" + value + ".png' class='radio valid' />"));
      } else { // radio button is not checked
          radio.hide();
          radio.after($("<img src='" + self.path.images + "formats/" + value + ".png' class='radio'  />"));
      }
  });

  self.verticalAlign_($('.step.no1 .content'));

};

//=== BIND START =====================================================
app.prototype.bindEvents_ = function() {
  var self = this;

  self.dom.addOfferBtn.on('click', function(e) {
    e.preventDefault();
    self.addOffer_({}, 500) // Ajoute une offre vide avec une animation d'entrée de .5s
  });

  self.dom.goStep1.on('click', function() {
    self.goToStep_(1);
  });

  self.dom.goStep2.on('click', function() {
      if(self.form.step === 1) { // Si on est au Step 1
        if(self.validate_()) {  // Si le Step 1 est valid
          if(self.ad.offers.length === 0) { // Si il n'y a encore aucune offre au Step 2
            $.extend( self.ad, self.getStep1_() );
            self.addOffer_(); // Créer une offre vide
          }
          self.goToStep_( 2 ); // Aller au Step 2
        }
      } else if(self.form.step === 3) { // Si on est au Step 3
        self.dom.field.iConfirm.attr('checked', false);  // Décoche la boite de confirmation
        self.dom.downloadBtn.addClass('disabled'); // Désactive le bouton de téléchargement 
        self.goToStep_( 2 ); // Aller au Step 2
      }
  });

  self.dom.goStep3.on('click', function() {
    if(self.validate_()) {
      var dd = new FormData($('.js-form')[0]);
      self.setStep3_( dd );
      self.goToStep_( 3 );
    };
  });

  self.dom.step1.on('click', '.radio', function() {
    self.radioChoice = $(this);
    self.updateRadioFormat_(self.radioChoice);
  });

  self.dom.field.category.on('change', function() {
    self.ad.category = $(this).val();
    $(this).blur();
      if ((self.lastCategory != "conferences" && self.ad.category === "conferences") || (self.lastCategory === "conferences" && self.ad.category != "conferences") ) {
          self.checkOffers_();
      }
  });

  self.dom.field.category.on('focus', function() {
    self.lastCategory = self.dom.field.category.val();
  });

  self.dom.steps.on('focus', '[name$="_freetext"]', function() {
    $(this).prev('label').children('input').prop('checked', true);
  });

  self.dom.steps.on('change', '.file-input', function() {
     self.updateInputFilePreview_($(this));
  });

  self.dom.steps.on('click', '.file-input', function() {
      $(this).wrap( "<form id='hiddenForm' style='display:none'></div>" );
      $('#hiddenForm')[0].reset();
      $(this).unwrap( "<form id='hiddenForm'></div>" );
  });

  self.dom.steps.on('change', '.multi-files input', function() {
    self.addMultiFiles_($(this));
  });

  self.dom.steps.on('click', '.js-erease', function() {
    self.deleteMultiFiles_($(this).closest('li').data('key'), $(this).data('id'));
  });

  self.dom.steps.on('change', '.video input', function() {
    self.updateVideo_($(this));
  });

  self.dom.steps.on('click', '.js-erease-video', function() {
    self.deleteVideo_($(this).closest('.row').find('input'));
  });

  self.dom.steps.on('click', '.delete-offer a', function(e) {
    e.preventDefault();
    self.deleteOffer_( $(this).closest('fieldset') );
  });

  self.dom.downloadBtn.on('click', function(e) {
    e.preventDefault();
    self.dom.popupConfirmation.addClass('active');
  });

  self.dom.cancel.on('click', function(e) {
    e.preventDefault();
    self.dom.popupConfirmation.removeClass('active');
  });

  self.dom.field.iConfirm.on('change', function(e) {
    self.dom.downloadBtn.toggleClass('disabled');
  });

  self.dom.confirmBtn.on('click', function(e) {
    e.preventDefault();
    self.downloadAd_();
  });

  self.dom.cancelErease.on('click', function(e) {
    e.preventDefault();
    self.dom.field.category.show();
    self.dom.popupDelete.removeClass('active');
  });

   self.dom.confirmErease.on('click', function(e) {
    e.preventDefault();
    self.resetOffers_();
    self.dom.field.category.show();
    self.dom.popupDelete.removeClass('active');
  }); 

  self.dom.steps.on('keyup', '[maxlength]', function(e) {
    var field = $(this);
    var counter = null;
    if(field.next().hasClass('countMaxCharacter')) {
      counter = $(this).next();
    }
    if(counter) {
      var nbr = field.attr('maxlength') - field.val().length;
      counter.text(nbr);
    }
  });

  self.dom.import.on('change', function() {
    self.getUploaded_($(this));
  });
};

/*=== Get Ad Uploaded ==========================================*/
app.prototype.getUploaded_ = function(pInput) {
  var self = this;

  if(!inputContainImg(pInput)) { // Si un zip est uploadé et non une image
    var formData = new FormData($('.import')[0]);

    $.ajax({
        url: self.path.librairies + "uploadZip.php",
        type: 'POST',
        data: formData,
        success: function(folderId) {
          self.ad.id = folderId;
          var folder = self.path.temps + self.ad.id;
          $.getJSON(folder + "/assets/_source.json", function(data) { // Télécharge la source de la pub à éditer
            data.folder = folder;
            data.meta.id = self.ad.id;

            self.setStep1_( data ); // Remplis le formulaire du Step 1
            $.extend( self.ad, self.getStep1_() ); // Récupère les valeurs du formulaire du Step 1
            console.log(self.ad);
            self.ad.offers = self.convertOffers_( data.offers.list ); // Converti les offres dans _source.json en format traitable
            self.setStep2_( self.ad ); // Remplis le formulaires du Step 2 (Offres)
            self.goToStep_( 2 ); // Passe au step 2
            var dd = new FormData($('.js-form')[0]);
            self.setStep3_( dd );

          });
        },
        error: function(r) {
          console.log('Zip envoyé, mais erreur', r);
        },
        cache: false,
        contentType: false,
        processData: false
    });

  } else { // Un fichier de type image à été téléchargé plutôt qu'un .zip
    console.log("Le fichier de l'annonce doit-être un .zip");
  }

};

/*=== Get Step 1 ==========================================*/
app.prototype.getStep1_ = function() {
  var self = this;
  var format = self.dom.field.format.filter(":checked").val();
  var ad = {
    id: self.dom.field.id.val(),
    client: self.dom.field.noClient.val(),
    noAd: self.dom.field.noAd.val(),
    category: self.dom.field.category.val(),
    format: self.convertFormat_( format ),
    settings: self.convertSettings_( self.form.settings.default, self.form.settings[format] )
  };

  return ad;
};

/*=== Set Step 1 ==========================================*/
app.prototype.setStep1_ = function(pData) {
  var self = this;
  console.log(pData);

  self.dom.field.id.val( pData.meta.id );
  self.dom.field.noClient.val( pData.meta.noClient );
  self.dom.field.noAd.val( pData.meta.noAd );
  self.dom.field.category.val( pData.meta.category );
  /*--- Logo ---*/
  self.dom.field.preLogo.val( pData.logo.name );
  self.dom.field.logo.closest( '.half' ).addClass( 'valid' ).removeClass( 'js-validate' );
  $('.field.logo').addClass('valid');
  self.dom.field.logoPreview.addClass( 'active' ).css( 'background-image', 'url("' + pData.folder + '/assets/' + pData.logo.name + '")' );
  self.dom.field.offersNbr.val( pData.offers.nbr );
  self.radioChoice = $('img[src="' + self.path.images + 'formats/'+ pData.meta.format +'.png"]');
};

/*=== Set Step 2 ==========================================*/
app.prototype.setStep2_ = function(pAd) {
  var self = this;

  for(x=0; x<pAd.offers.length; x++) {
    var obj = {};
    jQuery.extend( obj, pAd );
    obj.filled = pAd.offers[x];
    self.addOffer_( obj );
  }
};

/*=== Step 2 validation ============================================*/
app.prototype.setOfferValidation_ = function(pAd, pOffer) {
  var self = this;

  // Titre
  $("textarea[name='"+ pOffer.id +"_title']").rules('add', {
    required: true
  });
  // Prix
  if(pAd.settings.price == true) {
    self.dom.f.find("input[name='"+ pOffer.id +"_price']").rules('add', {
      required: true
    });
    console.log( pOffer.id, $("input[name='"+ pOffer.id +"_price']"));
    $("input[name='"+ pOffer.id +"_price']").mask('99999');
  }
  // Date
  if(pAd.settings.date == true) {
    self.dom.f.find("input[name='"+ pOffer.id +"_date']").rules('add', {
      required: true,
      date: true,
      messages: {
        date: ' <span class="msg">(' + self.form.text['enterValidDate'] + ')'
      }
    });
    $("input[name='"+ pOffer.id +"_date']").mask('0000-09-09');
    // Heure
    self.dom.f.find("input[name='"+ pOffer.id +"_time']").rules('add', {
      required: true,
      time: true,
      messages: {
        time: ' <span class="msg">(' + self.form.text['enterValidHour'] + ')'
      }
    });
    $("input[name='"+ pOffer.id +"_time']").mask('09:00');
  }

  $('.' + pOffer.id + '_rateit').rateit({ max: 5, step: 1, backingfld: '#' + pOffer.id + '_rateit_val' });

  // Lien web
  $("input[name='"+ pOffer.id +"_link']").rules('add', {
    required: true,
    url: true,
    messages: {
      url: ' <span class="msg">(' + self.form.text['enterValidURL'] + ')'
    }
  });

  // Description
  if(pAd.settings.description == true) {
    $("textarea[name='"+ pOffer.id +"_description']").rules('add', {
      required: true
    });
  }
};

/*=== Set Step 3 ==========================================*/
app.prototype.setStep3_ = function(pData) {
  var self = this;
  $.ajax({
    type: "POST",
    url: self.path.root + 'ad.php',
    data: pData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(data) {
      self.dom.render.css({
        'width': self.ad.format.w + 'px', 
        'height': self.ad.format.h + 'px'
      })
      var idoc = self.dom.render[0].contentDocument;
      var zipable = self.dom.zipable[0].contentDocument;
      idoc.open();
      idoc.write(data);
      idoc.close();
      zipable.open();
      zipable.write(data);
      zipable.close();
      self.goToStep_( 3 );
    }, error: function(data) {
      console.log("error");
      console.log(data);
    }
  });
};

/*=== Convert Settings ==========================================*/
app.prototype.convertSettings_ = function(pDefault, pFormat) {
  var self = this;
  var settings = $.extend({}, pDefault, pFormat);
  if(settings.category === "conferences") {
    settings.price = false;
    settings.date = true;
  }
  return settings;
};

/*=== Convert Format ==========================================*/
app.prototype.convertFormat_ = function(pFormat) {
  var self = this;
  var format = {
    text: pFormat,
    w: parseInt(pFormat.split('x')[0]),
    h: parseInt(pFormat.split('x')[1])
  }
  return format;
};

/*=== Convert Offers ==========================================*/
app.prototype.convertOffers_ = function(pOffers) {
  var self = this;
  var offers = [];

  for(var x=0; x<pOffers.length; x++) {
    var offer = pOffers[x];

    var obj = {
      id: x,
      strapline: offer.strapline,
      title: offer.title,
      date: offer.date,
      time: offer.time,
      mention1: {
        no0: offer.mentions[0] === "",
        no1: offer.mentions[0] === "À partir de",
        no2: offer.mentions[0] === "Par personne",
        no3: offer.mentions[0] === "Vol inclus",
        no4: offer.mentions[0] === "Taxes incluses"
      },
      mention2: {
        no0: offer.mentions[1] === "" || offer.mentions[1] == undefined,
        no1: offer.mentions[1] === "À partir de",
        no2: offer.mentions[1] === "Par personne",
        no3: offer.mentions[1] === "Vol inclus",
        no4: offer.mentions[1] === "Taxes incluses"
      },
      rating: offer.rating,
      link: offer.link,
      description: offer.description.replace(/<br\s*[\/]?>/gi, "")
    }

    if(offer.place) {
      obj.place = offer.place;
    }
    if(offer.price) {
      obj.price = offer.price.replace(" ", "");
    }
    if(offer.legal) {
      obj.legal = offer.legal.text.replace(/<br\s*[\/]?>/gi, "");
    }
    if(!obj.mention1.no1 && !obj.mention1.no2 && !obj.mention1.no3 && !obj.mention1.no4) {
      obj.mention1.no5 = true;
      obj.mention1.freetext = offer.mentions[0];
    }
    if(offer.mentions[1] && !obj.mention2.no1 && !obj.mention2.no2 && !obj.mention2.no3 && !obj.mention2.no4) {
      obj.mention2.no5 = true;
      obj.mention2.freetext = offer.mentions[1];
    }
    obj.pictures = [];
    for(var y=0; y<offer.gallery.pictures.length; y++) {
      obj.pictures.push(offer.gallery.pictures[y].name);
    }
    obj.videos = [];
    if(offer.videos) {
      for(var y=0; y<offer.videos.length; y++) {
        obj.videos.push(offer.videos[y].name);
      }
    }

    offers.push(obj);
  }

  return offers;
};

/*=== Download Ad ==========================================*/
app.prototype.downloadAd_ = function() {
  var self = this;
  var html = self.dom.zipable.contents().find("html")[0].outerHTML;
  $.ajax({
    type: "POST",
    url: self.path.librairies + "createFiles.php",
    data: {"id": self.ad.id, "h": html},
    success: function(data) {
      console.log("success: create folder");
      self.dom.popupConfirmation.removeClass('active');
      var folder = '../../temps/' + self.ad.id;
      var adNumber = self.dom.field.noAd.val();
      var adZipName = adNumber;
      if (self.dom.field.noClient.val() != "") {
          var customerName = "publicite";
          try {
            customerName = removeDiacritics(self.dom.field.noClient.val().toLowerCase().replace(/[`~!@#$%^&*()¨^_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, ''));
          } catch(err) {
            customerName = "publicite";
          }
          adZipName = adZipName + "_" + customerName;
      }
      $.ajax({
        type: "POST",
        url: self.path.librairies + "zipFolder.php",
        data: {"folder": folder, "name": adZipName},
        success: function(data) {
          var url = self.path.root + 'temps/' + self.ad.id + '/' + adZipName + '.zip';
          $("<iframe />").css("display", "none").bind("load", function(e) {
            this.src == url && $(this).remove();
          }).attr("src", url).appendTo($(document.body));
          console.log("success: zip");
        }, error: function(data) {
          console.log("error: zip");
        }
      });
    }, error: function(data) {
      console.log("error: create folder");
      self.dom.popupConfirmation.removeClass('active');
    }
  });
};

/*=== Update Video ==========================================*/
app.prototype.updateVideo_ = function(pInput) {
  var self = this;
  var row = pInput.closest('.row');
  var files = row.find('.files-list');
  pInput.blur();
  if(pInput.val() == '') {
    files.addClass('hide');
  } else {
    files.removeClass('hide');
  }
};

/*=== Delete Video ==========================================*/
app.prototype.deleteVideo_ = function(pInput) {
  var self = this;
  var row = pInput.closest('.row');
  var files = row.find('.files-list');
  resetFormElement(pInput);
  files.addClass('hide');
  row.find('.field').removeClass('valid');
  pInput.blur();
};

/*=== Go to Step ===========================================*/
app.prototype.goToStep_ = function(pStep) {
  var self = this;
  self.form.step = pStep;
  self.dom.b.removeClass('no1 no2 no3').addClass('no' + self.form.step);
};

/*=== Add Offer ============================================*/
app.prototype.addOffer_ = function(pObj, pSpeed) {
  var self = this;

  if(self.form.current.offersNbr < self.ad.settings.maxOffers && !self.ad.gallery) { // Si nous avons le droit d'ajouter une offre
    pObj = pObj ? pObj : {}; // Si aucun objet n'est passé, en créer un vide
    pSpeed = pSpeed ? parseInt(pSpeed) : 0; // Si aucune vitesse n'est passé, donner 0 comme valeur
    pObj.settings = self.ad.settings; // Définir les settings des champs de l'offre
    pObj.t = self.form.text; // Définir les textes selon la langue (ex: Surtitre / Strapline)

    pObj.id = self.form.current.id // Attribution d'un id
    self.form.current.id++; // S'assure que le id ne pourra pas etre repeter en l'incrémentant

    var html = Mustache.render(self.ad.template, pObj); // Rend le html de l'offre (champs à afficher ou à populer)
    self.dom.offersList.append(html); // Ajoute l'offre dans l'annonce
    self.initMultiFiles_($('input[name="'+ pObj.id +'_picture[]"]'));
    self.form.current.offersNbr++;
    self.updateMultifiles_();
    self.updateAddOfferBtn_();
    self.updateOffersList_();
    self.setOfferValidation_(self.ad, pObj);
    self.updateOffer_(pObj.id);

    setTimeout(function() { // Délais pour animation
      self.dom.offersList.find('fieldset[data-id="'+ pObj.id +'"]').addClass('created'); // Ajoute l'animation
    }, pSpeed)
  }
};

/*=== Delete Offer ===========================================*/
app.prototype.deleteOffer_ = function(pOffer) {
  var self = this;
  var id = pOffer.data('id');
  pOffer.remove();
  self.form.current.offersNbr--;
  self.updateAddOfferBtn_();
  self.updateOffersList_();
  self.updateOffer_(id);
};

/*=== Update Offer ===========================================*/
app.prototype.updateOffer_ = function(pId) {
  var self = this;
  var currVal = self.dom.field.offersId.val();
  var arrIds = currVal === '' ? [] : currVal.split(',');
  var strIds = "";
  if (pId != null) {
    var index = arrIds.indexOf(pId.toString());
    var multifiles = $('.multi-files .btn');
    if(index === -1) {
      arrIds.push(pId);
      
    } else {
      arrIds.splice(index, 1);
    }
  } else {
    arrIds = [];
  }
  strIds = arrIds.toString();
  self.dom.field.offersId.val(strIds);
};

/*=== Update Offers List ===================================*/
app.prototype.updateOffersList_ = function() {
  var self = this;
  var content = self.dom.step2.find('.content');
  console.log(self.form.current.offersNbr, self.dom.b.width());
  if(self.form.current.offersNbr > 1) {
    if(self.dom.b.width() > 1020) {
      content.addClass('extend');
    }
  } else {
    content.removeClass('extend');
  }
  
};

/*=== Validate ===========================================*/
app.prototype.validate_ = function() {
  var self = this;
  var currentStep = $('.step.no' + self.form.step);
  var valid = true;

  $('.js-validate', currentStep).each(function(i, v) {
    valid = self.validator.element(v) && valid;
  });

  return valid;
};

/*=== Check Offers ===========================================*/
app.prototype.checkOffers_ = function() {
  var self = this;
  var fieldsets = self.dom.offersList.children( 'fieldset' );
  if(fieldsets.length !== 0) {
      self.dom.field.category.hide();
      self.dom.popupDelete.addClass( 'active' );
  } else {
    self.dom.field.category.show();
  }
};

/*=== Reset Offers ===========================================*/
app.prototype.resetOffers_ = function() {
  var self = this;
  var fieldsets = self.dom.offersList.children('fieldset');
  for(var x=0; x<=fieldsets.length; x++) {
    key = fieldsets.eq(x);
    self.deleteOffer_(key);
  }
  self.ad = self.defaultAd;
  self.ad.gallery = false;
};

/*=== Update Add Offer Btn ============================================*/
app.prototype.updateAddOfferBtn_ = function() {
  var self = this;

  if(self.form.current.offersNbr === self.ad.settings.maxOffers) {
    self.dom.addOfferBtn.addClass('disabled');
    self.dom.addOfferMsg.html('(' + self.form.text['offersMaxReached'] + ')');
  } else if(self.ad.gallery) {
    self.dom.addOfferBtn.addClass('disabled');
    self.dom.addOfferMsg.html('(' + self.form.text['cantAddOfferIfMoreThan1picture'] + ')');
  } else {
    self.dom.addOfferBtn.removeClass('disabled');
    self.dom.addOfferMsg.html('');
  }
};

/*=== Init Multi Files ===============================================*/
app.prototype.initMultiFiles_ = function(pInput) {
  var self = this;
  var field = pInput.closest('.field');
  pInput.closest('.field').wrap('<div class="multi-files"></div>');
  var ol = $('<ol class="files-list"></ol>');
  var preImgs = field.find('input[type="hidden"]');

  if(preImgs.val() && preImgs.val() !== "") {
    preImgs = preImgs.val().split(",");
    
    var btn = pInput.closest('.btn');
    var txt = btn.children('.text');
    for(var x=0; x<preImgs.length; x++) {
      ol.append('<li><span class="preview" style="background-image: url(\'' + self.path.root + 'temps/' + self.ad.id +'/assets/'+ preImgs[x] +'\')"></span><a href="#" class="js-erease" data-id="'+ preImgs[x] +'">X</a></li>');
    }
    var max = parseInt(btn.data('max'));
    if(ol.children().length < max) {
        txt.html(self.form.text['uploadOtherImages']);
        self.ad.gallery = ol.children().length > 1 ? true : false;
        self.updateAddOfferBtn_();
        self.updateMultifiles_();
    }
  }
  pInput.closest('.multi-files').append(ol);
};

/*=== Delete Multi Files ===========================================*/
app.prototype.deleteMultiFiles_ = function(pKey, pId) {
  var self = this;
  var li;
  var input;
  if(pId) {
    input = $("input[value*='" + pId + "']");
    var v = input.val();
    if(v.indexOf(pId + ',') !== -1) {
      v = v.replace(pId + ',', "");
    } else {
      v = v.replace(pId, "");
    }
    input.val(v);
    li = $("[style*='" + pId + "']").closest('li');
  } else {
    li = $('li[data-key="'+ pKey +'"]');
    input = $('input[data-key="'+ pKey +'"]');
  }
  
  var ol = li.parent();
  var field = input.closest('.field');
  var lbl = field.find('.lbl');
  var msg = lbl.find('.msg');
  var btn = field.find('.btn');
  var txt = btn.children('.text');

  if(!pId) {
    input.remove();
  }
  console.log(field, btn);

  btn.removeClass('disabled');
  li.remove();
  
  if(ol.children().length === 0) {
    field.removeClass('valid').addClass('error');
    msg.html('(' + self.form.text['requiredField'] + ')');
    txt.html(self.form.text['uploadImage']);
  } else {
    self.ad.gallery = ol.children().length === 1 ? false : true;
    msg.html('');
    txt.html(self.form.text['uploadOtherImages']);
  }
  self.updateAddOfferBtn_();
};

/*=== Add Multi Files ============================================*/
app.prototype.addMultiFiles_ = function(pInput) {
  var self = this;
  self.getUploadedImageObj_(pInput, function(pImg) {
    var field = pInput.closest('.field');
    var lbl = field.find('.lbl');
    var name = pInput.attr('name');
    var btn = pInput.closest('.btn');
    var txt = btn.children('.text');
    var list = pInput.closest('.multi-files').find('.files-list');
    var key = pInput.data('key');
    var max = parseInt(btn.data('max'));
    var obj = {
      key: key,
      img: pImg
    }

    if(list.children().length < max) {
      $.get(self.path.templates + 'file-preview-tpl.mustache.html', function(template, textStatus, jqXhr) {
        var newKey = new Date().getTime();

        list.append(Mustache.render($(template).filter('#filePreviewTpl').html(), obj));
        txt.html(self.form.text['uploadOtherImages']);
        btn.append('<input type="file" accept="image/*" capture="camera" name="'+ name +'" data-key="'+ newKey +'" />');

        self.ad.gallery = list.children().length > 1 ? true : false;
        self.updateAddOfferBtn_();
        self.updateMultifiles_();
      });
    }

    pInput.addClass('hide').blur();
  });
};

app.prototype.updateMultifiles_ = function() {
  var self = this;
  var multifiles = $('.multi-files');
  var btns = multifiles.find('.btn');
    
  for(var x=0; x<multifiles.length; x++) {
    var msg = multifiles.eq(x).find('.msg');
    var btn = btns.eq(x);
    var txt = btn.find('.text');
    var list = multifiles.eq(x).find('.files-list');
    var max = multifiles.length > 1 ? 1 : btns.eq(x).data('max-original');

    btn.data('max', max);
    if(list.children().length == 0) {
      btn.removeClass('disabled');
      msg.html('');
      txt.html(self.form.text['uploadImage']);
    } else {
      if(list.children().length < btn.data('max')) {
        btn.removeClass('disabled');
        msg.html('');
        txt.html(self.form.text['uploadOtherImages']);
      } else {
        btn.addClass('disabled');
        msg.html(' <span class="msg">(' + self.form.text['maximumPicturesNumberReached'] + ')</span>');
        txt.html(self.form.text['uploadImage']);
      }
    }
  }
};

/*=== Update File Preview ============================================*/
app.prototype.updateInputFilePreview_ = function(pInput) {
  var self = this;
  pInput.closest('.field').find('input[type="hidden"]').val("");
  self.getUploadedImageObj_(pInput, function(pImg) {
    var btn = pInput.closest('.btn');
    var field = btn.closest('.field');
    var lbl = field.find('.lbl');
    var preview = btn.next('.preview');
    preview.css({'background-image': 'url(' + pImg + ')'}).addClass('active');
    pInput.blur();
  });
};

/*=== Get Uploaded Image ============================================*/
app.prototype.getUploadedImageObj_ = function(pInput, callback) {
  var self = this;
  var file = pInput.prop("files")[0];
  var reader = new FileReader();
  reader.onload = function(e) {
    $("<img/>").attr("src", e.target.result).load(function() {
      var img = e.target.result;
      callback(img);
    });
  }
  reader.readAsDataURL(file); 
};

/*=== Update Radio Format ============================================*/
app.prototype.updateRadioFormat_ = function(pRadio) {
  var self = this;
  pRadio.parent().find('.valid').removeClass('valid').prev().removeAttr('checked');
  pRadio.addClass('valid').prev().prop('checked', 'true');
  self.ad.format = self.convertFormat_( pRadio.prev().val() );
  self.dom.field.offersId.val("");
  self.dom.offersList.find('fieldset').remove();
  self.dom.step2.find('.content').removeClass('extend');
  self.form.current.offers = 0;
  self.ad.gallery = 0;
  self.dom.offersNbr.val(self.form.current.offers );
};

/*=== Vertical Align ============================================*/
app.prototype.verticalAlign_ = function(pElem) {
  var self = this;
  var h = pElem.children('fieldset').height();
  var browserH = self.dom.steps.height();
  var posY = (browserH - h - 100) / 2;
  pElem.css('top', posY + 'px');
};