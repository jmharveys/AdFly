
// JavaScript Document
var _g = globals = {};
var app = app || {};  //Évite d'overwritter des plugins si il y en a. 

app = function(pCulture, pRoot) {
  var self = this;
  self.culture = pCulture;
  self.root = pRoot;
  self.category = "deals";
  self.format = "480x325";
  self.step = 1;
  self.offersNbr = 0;
  self.gallery = false;
  self.opts;
  $.getJSON(self.root + "public/data/translations.json", function(data) {
    self.t = data;
    //--- functions -----------------
    self.map_(); 
    self.init_();
    self.bindEvents_();
  }).error(function(data) {
    console.log("Erreur chargement des traduction!");
  });
};

//=== MAP START =====================================================
app.prototype.map_ = function() {
  var self = this;
  self.dom = {
    b: $('body'),
    f: $('.js-form'),
    steps: $('.steps'),
    step1: $('.step.no1'),
    step2: $('.step.no2'),
    step3: $('.step.no3'),
    previousStep: $('.js-previousStep'),
    nextStep: $('.js-nextStep'),
    submit: $('.js-submit'),
    offersNbr: $('[name="offersNbr"]'),
    addOfferBtn: $('.addOffer'),
    addOfferMsg: $('.addOfferMsg'),
    offersList: $('.offersList'),
    render: $('iframe.render'),
    zipable: $('iframe.zipable'),
    downloadBtn: $('.js-download'),
    popupConfirmation: $('.popup.confirmation'),
    cancel: $('.popup.confirmation .js-cancel'),
    confirmBtn: $('popup.confirmation .js-confirm'),
    popupDelete: $('.popup.delete'),
    cancelErease: $('.popup.delete .js-cancel'),
    confirmErease: $('.popup.delete .js-confirm'),
    field: {
      id: $('[name="id"]'),
      offersId: $('[name="offersId"]'),
      noClient: $('[name="noClient"]'),
      noAd: $('[name="noAd"]'),
      category: $('[name="category"]'),
      date: $('[name="date"]'),
      formatRadio: $(".row.format input"),
      format: $(".row.format .radio"),
      iConfirm: $('[name="iConfirm"]')
    }
  };
  self.path = {
    images: 'public/images/',
    templates: 'public/templates/'
  }
};

//=== INIT START =====================================================
app.prototype.init_ = function(pObj) {
  var self = this;
  self.id = new Date().getTime() + Math.floor(Math.random() * 10);
  self.dom.field.id.val(self.id);

  /* jQuery Validate */
  jQuery.extend(jQuery.validator.messages, {
    required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')</span>',
    maxlength: jQuery.validator.format(' <span class="msg">(' + self.t[self.culture]['maxlength'] + ')</span>')
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
        required: true,
        minlength: 6,
        maxlength: 6
      },
      noAd: {
        minlength: 7,
        maxlength: 7
      },
      logo: {
        required: true
      }
    },
    messages: {
      noClient: {
        minlength: ' <span class="msg">(' + self.t[self.culture]['mustContain6digits'] + ')</span>',
        maxlength: ' <span class="msg">(' + self.t[self.culture]['mustContain6digits'] + ')</span>'
      },
      noAd: {
        minlength: ' <span class="msg">(' + self.t[self.culture]['mustContain7digits'] + ')</span>',
        maxlength: ' <span class="msg">(' + self.t[self.culture]['mustContain7digits'] + ')</span>'
      }
    }
  });

  /* jQuery Mask */
  self.dom.field.noClient.mask('000000'); // 6 char
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
    self.setOffer_(500);
  });

  self.dom.nextStep.on('click', function() {
    self.changeStep_(1);
  });

  self.dom.previousStep.on('click', function() {
    self.changeStep_(-1);
  });

  self.dom.submit.on('click', function(e) {
  });

  self.dom.step1.on('click', '.radio', function() {
    // self.updateRadioFormat_($(this));
    self.radioChoice = $(this);
    self.checkOffers_();
  });

  self.dom.field.category.on('change', function() {
    // self.resetOffers_();
    // self.checkOffers_();
    self.category = $(this).val();
    // self.dom.popupDelete.addClass('active');
  });

  self.dom.field.category.on('focus', function() {
    // self.resetOffers_();
    self.checkOffers_($(this));
    elem = $(this);
    // self.category = $(this).val();
    // self.dom.popupDelete.addClass('active');
  });

  self.dom.steps.on('focus', '[name$="_freetext"]', function() {
    console.log('oui');
    $(this).prev('label').children('input').prop('checked', true);
  });

  self.dom.steps.on('change', '.file-input', function() {
    self.updateInputFilePreview_($(this));
  });

  self.dom.steps.on('change', '.multi-files input', function() {
    self.addMultiFiles_($(this));
  });

  self.dom.steps.on('click', '.js-erease', function() {
    self.deleteMultiFiles_($(this).closest('li').data('key'));
  });

  self.dom.steps.on('change', '.video input', function() {
    self.updateVideo_($(this));
  });

  self.dom.steps.on('click', '.js-erease-video', function() {
    self.deleteVideo_($(this).closest('.row').find('input'));
  });

  self.dom.steps.on('click', '.delete-offer a', function(e) {
    e.preventDefault();
    var offer = $(this).closest('fieldset');
    self.deleteOffer_(offer);
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
    self.dom.field.category.show();
    self.updateRadioFormat_(self.radioChoice);
    self.resetOffers_();
    self.dom.popupDelete.removeClass('active');
  }); 

};

app.prototype.downloadAd_ = function() {
  var self = this;
  var html = self.dom.zipable.contents().find("html")[0].outerHTML;
  $.ajax({
    type: "POST",
    url: self.root + 'app/libraries/createFiles.php',
    data: {"id": self.id, "h": html},
    success: function(data) {
      console.log("success: create folder");
      self.dom.popupConfirmation.removeClass('active');
      var folder = '../../temps/' + self.id;
      $.ajax({
        type: "POST",
        url: self.root + 'app/libraries/zipFolder.php',
        data: {"folder": folder, "name": "annonce"},
        success: function(data) {
          var url = self.root + '/temps/' + self.id + '/annonce.zip';
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

app.prototype.deleteVideo_ = function(pInput) {
  var self = this;
  var row = pInput.closest('.row');
  var files = row.find('.files-list');
  resetFormElement(pInput);
  files.addClass('hide');
  row.find('.field').removeClass('valid');
  pInput.blur();
};

/*=== Change Step ===========================================*/
app.prototype.changeStep_ = function(pValue) {
  var self = this;
  var currentStep = $('.step.no' + self.step);
  var valid = true;

  if(pValue === 1) {
    $('.js-validate', currentStep).each(function(i, v) {
      valid = self.validator.element(v) && valid;
    });
  }

  if(valid) {
    if(self.step == 1) {
      self.setStep2_(self.category, self.format);
      if(!self.offersNbr) {
        self.setOffer_(0);
      }
    } else if(self.step == 2) {
      var data = new FormData($('form')[0]); // serializes the form's elements.
      self.setAdPreview_(data);
    }
    self.step += parseInt(pValue);
    self.dom.b.removeClass('no1 no2 no3').addClass('no' + self.step);
  }
};

app.prototype.checkOffers_ = function() {
  var self = this;
  var fieldsets = self.dom.offersList.children('fieldset');
  if (fieldsets.length != 0){
      self.dom.field.category.hide();
      self.dom.popupDelete.addClass('active');
  } else {
    self.updateRadioFormat_(self.radioChoice);
    self.dom.field.category.show();
  }
};

app.prototype.resetOffers_ = function() {
  var self = this;
  var fieldsets = self.dom.offersList.children('fieldset');
  for(var x=0; x<fieldsets.length; x++) {
    key = fieldsets.eq(x);
    self.deleteOffer_(key);
  }
  self.offersNbr = 0;
  self.gallery = false;
};

/*=== Set Step 2 ===========================================*/
app.prototype.setStep2_ = function(pCategory, pFormat) {
  var self = this;
   $.ajax({
      url: self.root + "public/data/settings/default.json",
      async: false,
      dataType: "json",
      success: function(data) {
        $.ajax({
          url: self.root + "public/data/settings/" + self.format + ".json",
          async: false,
          dataType: "json",
          success: function(formatSettings) {
            $.extend(data, formatSettings);
            if(pCategory == 'conferences') {
              data.price = false;
              data.date = true;
            }
            self.opts = data;
            console.log(self.opts);
          }
        });
      }
  });
};

/*=== Set Ad Preview ==========================================*/
app.prototype.setAdPreview_ = function(pData) {
  var self = this;
  $.ajax({
    type: "POST",
    url: self.root + 'ad.php',
    data: pData,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(data) {
      self.dom.render.css({
        'width': self.format.split('x')[0] + 'px', 
        'height': self.format.split('x')[1] + 'px'
      })
      var idoc = self.dom.render[0].contentDocument;
      var zipable = self.dom.zipable[0].contentDocument;
      idoc.open();
      idoc.write(data);
      idoc.close();
      zipable.open();
      zipable.write(data);
      zipable.close();
    }, error: function(data) {
      console.log("error");
      console.log(data);
    }
  });
};

/*=== Set Offer ===============================================*/
app.prototype.setOffer_ = function(pDelay) {
  var self = this;

  if(self.offersNbr < self.opts.maxOffers && !self.gallery) {
    var id = new Date().getTime();
    var opts = self.opts;
    self.updateOffer_(id);
    self.dom.offersNbr.val(self.offersNbr);
    if(self.offersNbr > 1) {
      opts.maxPictures = 1;
    }
    self.addOffer_({
      id: id,
      t: self.t[self.culture],
      opt: opts
    }, pDelay);
  }
};

/*=== Add Offer ============================================*/
app.prototype.addOffer_ = function(pObj, pSpeed) {
  var self = this;

  if(pSpeed) {
    pSpeed = parseInt(pSpeed);
  } else {
    pSpeed = 0;
  }

  $.get(self.path.templates + 'form-offer-tpl.mustache.html', function(template, textStatus, jqXhr) {
    setTimeout(function() {
      self.dom.offersList.append(Mustache.render($(template).filter('#formOfferTpl').html(), pObj));

      // Titre
      $("textarea[name='"+ pObj.id +"_title']").rules('add', {
        required: true
      });
      // Prix
      if(pObj.opt.price == true) {
        self.dom.f.find("input[name='"+ pObj.id +"_price']").rules('add', {
          required: true
        });
        $("input[name='"+ pObj.id +"_price']").mask('99999');
      }
      // Date
      if(pObj.opt.date == true) {
        self.dom.f.find("input[name='"+ pObj.id +"_date']").rules('add', {
          required: true,
          date: true,
          messages: {
            date: ' <span class="msg">(' + self.t[self.culture]['enterValidDate'] + ')'
          }
        });
        $("input[name='"+ pObj.id +"_date']").mask('0000-09-09');
        // Heure
        self.dom.f.find("input[name='"+ pObj.id +"_time']").rules('add', {
          required: true,
          time: true,
          messages: {
            time: ' <span class="msg">(' + self.t[self.culture]['enterValidHour'] + ')'
          }
        });
        $("input[name='"+ pObj.id +"_time']").mask('09:00');
      }

      $('.' + pObj.id + '_rateit').rateit({ max: 5, step: 1, backingfld: '#' + pObj.id + '_rateit_val' });

      // Lien web
      $("input[name='"+ pObj.id +"_link']").rules('add', {
        required: true,
        url: true,
        messages: {
          url: ' <span class="msg">(' + self.t[self.culture]['enterValidURL'] + ')'
        }
      });

      // Description
      if(pObj.opt.description == true) {
        $("textarea[name='"+ pObj.id +"_description']").rules('add', {
          required: true
        });
      }

      self.initMultiFiles_($('input[name="'+ pObj.id +'_picture[]"]'));

      setTimeout(function() {
        self.dom.offersList.find('fieldset:last').addClass('created');
      }, 50)

      self.updateMultifiles_();
    }, pSpeed);
    
  });
};

/*=== Delete Offer ===========================================*/
app.prototype.deleteOffer_ = function(pOffer) {
  console.log('delete OUI');
  var self = this;
  var id = pOffer.data('id');
  pOffer.remove();
  self.updateOffer_(id);
  self.updateAddOfferBtn_();
};

/*=== Update Offer ===========================================*/
app.prototype.updateOffer_ = function(pId) {
  var self = this;
  var currVal = self.dom.field.offersId.val();
  var arrIds = currVal === '' ? [] : currVal.split(',');
  var strIds = "";
  var index = arrIds.indexOf(pId.toString());
  var multifiles = $('.multi-files .btn');
  if(index === -1) {
    arrIds.push(pId);
    self.offersNbr++;
  } else {
    arrIds.splice(index, 1);
    self.offersNbr--;
  }
  strIds = arrIds.toString();

  self.updateMultifiles_();
  self.updateAddOfferBtn_();
  self.updateOffersList_();
  self.dom.offersNbr.val(self.offersNbr);
  self.dom.field.offersId.val(strIds);
};

/*=== Update Add Offer Btn ============================================*/
app.prototype.updateAddOfferBtn_ = function(pActive, pMsg) {
  var self = this;
  if(self.offersNbr === self.opts.maxOffers) {
    self.dom.addOfferBtn.addClass('disabled');
    self.dom.addOfferMsg.html('(' + self.t[self.culture]['offersMaxReached'] + ')');
  } else if(self.gallery) {
    self.dom.addOfferBtn.addClass('disabled');
    self.dom.addOfferMsg.html('(' + self.t[self.culture]['cantAddOfferIfMoreThan1picture'] + ')');
  } else {
    self.dom.addOfferBtn.removeClass('disabled');
    self.dom.addOfferMsg.html('');
  }
};

/*=== Update Offers List ===================================*/
app.prototype.updateOffersList_ = function() {
  var self = this;
  var content = self.dom.step2.find('.content');

  if(self.dom.b.width() > 1020) {
    if(self.offersNbr > 1) {
      content.addClass('extend');
    } else {
      content.removeClass('extend');
    }
  }
};

/*=== Init Multi Files ===============================================*/
app.prototype.initMultiFiles_ = function(pInput) {
  var self = this;
  pInput.closest('.field').wrap('<div class="multi-files"></div>');
  pInput.closest('.multi-files').append('<ol class="files-list"></ol>');
};

/*=== Delete Multi Files ===========================================*/
app.prototype.deleteMultiFiles_ = function(pKey) {
  var self = this;
  var input = $('input[data-key="'+ pKey +'"]');
  var li = $('li[data-key="'+ pKey +'"]');
  var ol = li.parent();
  var field = input.closest('.field');
  var lbl = field.find('.lbl');
  var msg = lbl.find('.msg');
  var btn = input.closest('.btn');
  var txt = btn.children('.text');

  btn.removeClass('disabled');
  li.remove();
  input.remove();

  if(ol.children().length === 0) {
    field.removeClass('valid').addClass('error');
    msg.html('(' + self.t[self.culture]['requiredField'] + ')');
    txt.html(self.t[self.culture]['uploadImage']);
  } else {
    self.gallery = ol.children().length === 1 ? false : true;
    msg.html('');
    txt.html(self.t[self.culture]['uploadOtherImages']);
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
        txt.html(self.t[self.culture]['uploadOtherImages']);
        btn.append('<input type="file" accept="image/*" capture="camera" name="'+ name +'" data-key="'+ newKey +'" />');

        self.gallery = list.children().length > 1 ? true : false;
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
      txt.html(self.t[self.culture]['uploadImage']);
    } else {
      if(list.children().length < btn.data('max')) {
        btn.removeClass('disabled');
        msg.html('');
        txt.html(self.t[self.culture]['uploadOtherImages']);
      } else {
        btn.addClass('disabled');
        msg.html(' <span class="msg">(' + self.t[self.culture]['maximumPicturesNumberReached'] + ')</span>');
        txt.html(self.t[self.culture]['uploadImage']);
      }
    }
    
  }
};

/*=== Update File Preview ============================================*/
app.prototype.updateInputFilePreview_ = function(pInput) {
  var self = this;
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
}

/*=== Update Radio Format ============================================*/
app.prototype.updateRadioFormat_ = function(pRadio) {
  var self = this;
      pRadio.parent().find('.valid').removeClass('valid').prev().removeAttr('checked');
      pRadio.addClass('valid').prev().attr('checked', 'true');

      self.format = pRadio.prev().val();

      self.dom.offersList.find('fieldset').remove();
      self.dom.step2.find('.content').removeClass('extend');
      self.offersNbr = 0;
      self.dom.offersNbr.val(self.offersNbr);
};

/*=== Vertical Align ============================================*/
app.prototype.verticalAlign_ = function(pElem) {
  var self = this;
  var h = pElem.children('fieldset').height();
  var browserH = self.dom.steps.height();
  var posY = (browserH - h - 100) / 2;
  pElem.css('top', posY + 'px');
};