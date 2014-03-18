// JavaScript Document
var _g = globals = {};
var app = app || {};  //Évite d'overwritter des plugins si il y en a. 

app = function(pCulture, pRoot) {
  var self = this;
  self.culture = pCulture;
  self.root = pRoot;
  self.step = 1;
  self.offersNbr = 0;
  self.format = "325x480";
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
    addOffer: $('.addOffer'),
    offersList: $('.offersList'),
    field: {
      noClient: $('[name="noClient"]'),
      noAd: $('[name="noAd"]'),
      category: $('[name="category"]'),
      date: $('[name="date"]'),
      formatRadio: $(".row.format input"),
      format: $(".row.format .radio")
    }
  };
  self.path = {
    images: 'public/images/',
    templates: 'public/templates/'
  }
};
//=== MAP END ========================================================

//=== INIT START =====================================================
app.prototype.init_ = function(pObj) {
  var self = this;

  /* jQuery Validate */
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
        required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')</span>',
        minlength: ' <span class="msg">(' + self.t[self.culture]['mustContain6digits'] + ')</span>',
        maxlength: ' <span class="msg">(' + self.t[self.culture]['mustContain6digits'] + ')</span>'
      },
      noAd: {
        minlength: ' <span class="msg">(' + self.t[self.culture]['mustContain7digits'] + ')</span>',
        maxlength: ' <span class="msg">(' + self.t[self.culture]['mustContain7digits'] + ')</span>'
      },
      logo: {
        required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')</span>'
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
//=== INIT END =======================================================

//=== BIND START =====================================================
app.prototype.bindEvents_ = function() {
  var self = this;

  self.dom.addOffer.on('click', function(e) {
    e.preventDefault();
    self.setNewOffer_(500);
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
    self.updateRadioFormat_($(this));
  });

  self.dom.steps.on('change', '.file-input', function() {
    self.updateInputFilePreview_($(this));
  });

  self.dom.steps.on('change', '.multi-files input', function() {
    self.updateMultiFilesPreview_($(this));
  });

  self.dom.steps.on('click', '.js-erease', function() {
    self.ereaseInput_($(this).closest('li').data('key'));
  });

  self.dom.steps.on('click', '.delete-offer a', function(e) {
    e.preventDefault();
    var offer = $(this).closest('fieldset');
    self.deleteOffer_(offer);
  });
};
//=== BIND END =======================================================

app.prototype.changeStep_ = function(pValue) {
  var self = this;
  var currentStep = $('.step.no' + self.step);
  var valid = true;

  if(pValue === 1) {
    $('.js-validate', currentStep).each(function(i, v){
      valid = self.validator.element(v) && valid;
    });
  }

  if(self.step == 1) {
    if(valid) {
      if(self.offersNbr == 0) {
        self.opts = self.setTemplateOptions_(self.dom.field.category.val(), $('.row.format input:checked').val());
        self.setNewOffer_(0);
      }
    }
  }

  if(self.step == 2) {
    if(valid) {
      $.ajax({
        type: "POST",
        url: self.root + 'ad.php',
        data: $('form').serialize(), // serializes the form's elements.
        success: function(data) {
          var iframe =  $('.render');
          iframe.css({'width': self.format.split('x')[0] + 'px', 'height': self.format.split('x')[1] + 'px'})
          var idoc = iframe[0].contentDocument;
          idoc.open();
          idoc.write(data);
          idoc.close();
        }
      });


      var json = $('form').serializeObject();
      console.dir(json);
      //self.dom.step3.text(JSON.stringify(json));
    }
  }
  
  if(valid) {
    self.step += parseInt(pValue);
    self.dom.b.removeClass('no1 no2 no3').addClass('no' + self.step);
  }
};

app.prototype.setNewOffer_ = function(pDelay) {
  var self = this;

  if(self.offersNbr < self.opts.maxOffers) {
    self.offersNbr++;
    self.dom.offersNbr.val(self.offersNbr);
    self.addOffer_({
      id: self.offersNbr,
      t: self.t[self.culture],
      opt: self.opts
    }, pDelay);

    if(self.dom.b.width() > 1020 && self.dom.offersList.children().length > 0) {
      self.dom.step2.find('.content').addClass('extend');
    }

    if(self.offersNbr === self.opts.maxOffers) {
      self.dom.addOffer.addClass('disabled');
    }
  }
};

app.prototype.deleteOffer_ = function(pOffer) {
  var self = this;
  self.offersNbr--;
  self.dom.offersNbr.val(self.offersNbr);

  pOffer.remove();

  self.dom.addOffer.removeClass('disabled');

  if(self.dom.offersList.children('fieldset').length == 1) {
    self.dom.step2.find('.content').removeClass('extend');
  }
};

app.prototype.ereaseInput_ = function(pKey) {
  var self = this;
  var input = $('input[data-key="'+ pKey +'"]');
  var field = input.closest('.field');
  var lbl = field.find('.lbl');
  var msg = lbl.find('.msg');
  var btn = input.closest('.btn');

  btn.removeClass('disabled');
  msg.html('');
  $('[data-key="'+ pKey +'"]').remove();
};

app.prototype.setTemplateOptions_ = function(pCategory, pFormat) {
  var self = this;
  var opt = {
    price: true,
    date: false,
    maxOffers: 2,
    picture: true,
    maxPictures: 2,
    video: false
  };
  if(pCategory == 'conferences') {
    opt.price = false;
    opt.date = true;
  }
  if(pFormat == '480x324') { // 1/4 H
    opt.maxOffers = 4;
    opt.maxPictures = 4;
    opt.video = true;
  } else if(pFormat == '480x152') { // 1/8 H
    opt.maxOffers = 2;
    opt.maxPictures = 2;
  } else if(pFormat == '230x324') { // 1/8 V
    opt.maxOffers = 2;
    opt.maxPictures = 2;
  } else if(pFormat == '230x152') { // 1/16 H
    opt.picture = false;
    opt.maxOffers = 1;
    opt.maxPictures = 0;
  }
  return opt;
};

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

app.prototype.updateMultiFilesPreview_ = function(pInput) {
  var self = this;
  self.getUploadedImageObj_(pInput, function(pImg) {
    var field = pInput.closest('.field');
    var lbl = field.find('.lbl');
    var name = pInput.attr('name');
    var btn = pInput.closest('.btn');
    var list = pInput.closest('.multi-files').find('.files-list');
    var key = pInput.data('key');
    var max = parseInt(btn.data('max'));
    var obj = {
      key: key,
      img: pImg
    }

    if(list.children().length < max) {
      $.get(self.path.templates + 'file-preview-tpl.mustache.html', function(template, textStatus, jqXhr) {
        list.append(Mustache.render($(template).filter('#filePreviewTpl').html(), obj));
        var newKey = new Date().getTime();
        btn.append('<input type="file" name="'+ name +'" data-key="'+ newKey +'" />');
        if(list.children().length == max) {
          if(lbl.find('.msg').length) {
            lbl.find('.msg').html('<span class="msg">(' + self.t[self.culture]['maximumPicturesNumberReached'] + ')</span>');
          } else {
            lbl.append(' <span class="msg">(' + self.t[self.culture]['maximumPicturesNumberReached'] + ')</span>');
          }
          btn.addClass('disabled');
        }
      });
    }

    pInput.addClass('hide').blur();
  });
};

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

app.prototype.addOffer_ = function(pObj, pSpeed) {
  var self = this;

  if(pSpeed) {
    pSpeed = parseInt(pSpeed);
  } else {
    pSpeed = 0;
  }

  $.get(self.path.templates + 'offer-tpl.mustache.html', function(template, textStatus, jqXhr) {
    setTimeout(function() {
      self.dom.offersList.append(Mustache.render($(template).filter('#offerTpl').html(), pObj));

      // Destination
      $("input[name='"+ pObj.id +"_destination']").rules('add', {
        required: true,
        messages: {
          required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')'
        }
      });
      // Précision
      $("input[name='"+ pObj.id +"_moreDestination']").rules('add', {
        required: true,
        messages: {
          required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')'
        }
      });
      // Prix
      if(pObj.opt.price == true) {
        self.dom.f.find("input[name='"+ pObj.id +"_price']").rules('add', {
          required: true,
          messages: {
            required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')'
          }
        });
      }
      $("input[name='"+ pObj.id +"_price']").mask('99999');
      // Date
      if(pObj.opt.date == true) {
        self.dom.f.find("input[name='"+ pObj.id +"_date']").rules('add', {
          required: true,
          date: true,
          messages: {
            required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')',
            date: ' <span class="msg">(' + self.t[self.culture]['enterValidDate'] + ')'
          }
        });
      }
      $("input[name='"+ pObj.id +"_date']").mask('0000-09-09');
      // Lien web
      $("input[name='"+ pObj.id +"_link']").rules('add', {
        required: true,
        url: true,
        messages: {
          required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')',
          url: ' <span class="msg">(' + self.t[self.culture]['enterValidURL'] + ')'
        }
      });

      // Description
      $("textarea[name='"+ pObj.id +"_description']").rules('add', {
        required: true,
        messages: {
          required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')'
        }
      });

      self.createMultiFiles_($('input[name="'+ pObj.id +'_picture[]"]'));

      setTimeout(function() {
        self.dom.offersList.find('fieldset:last').addClass('created');
      }, 50)
    }, pSpeed);
    
  });
};

app.prototype.createMultiFiles_ = function(pInput) {
  var self = this;
  pInput.closest('.field').wrap('<div class="multi-files"></div>');
  pInput.closest('.multi-files').append('<ol class="files-list"></ol>');
};

app.prototype.verticalAlign_ = function(pElem) {
  var self = this;
  var h = pElem.height();
  var browserH = self.dom.steps.height();
  var posY = (browserH - h - 100) / 2;
  pElem.css('top', posY + 'px');
};