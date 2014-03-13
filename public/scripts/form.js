// JavaScript Document
var _g = globals = {};
var app = app || {};  //Évite d'overwritter des plugins si il y en a. 

app = function(pCulture, pRoot) {
  var self = this;
  self.culture = pCulture;
  self.root = pRoot;
  self.step = 1;
  self.offersNbr = 0;
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
    screenNbr: $('[name="screensNbr"]'),
    addScreen: $('.addScreen'),
    screensList: $('.screensList'),
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

  self.dom.addScreen.on('click', function(e) {
    e.preventDefault();
    self.offersNbr++;
    self.dom.screenNbr.val(self.i);
    self.addOffer_({
      id: self.offersNbr,
      t: self.t[self.culture]
    });
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

  self.dom.steps.on('change', '.file-input' ,function() {
    self.updateInputFilePreview_($(this));
  })
};
//=== BIND END =======================================================

app.prototype.changeStep_ = function(pValue) {
  var self = this;
  var currentStep = $('.step.no' + self.step);
  var valid = true;
  $('.js-validate', currentStep).each(function(i, v){
    valid = self.validator.element(v) && valid;
  });

  if(self.step == 1) {
    if(valid) {
      if(self.offersNbr == 0) {
        var settings = self.setTemplateSettings_(self.dom.field.category.val(), $('.row.format input:checked').val());
        self.addOffer_({
          id: self.offersNbr,
          t: self.t[self.culture],
          opt: settings
        });
      }
    }
  }

  if(valid) {
    self.step += parseInt(pValue);
    self.dom.b.removeClass('no1 no2 no3').addClass('no' + self.step);
  }
};

app.prototype.setTemplateSettings_ = function(pCategory, pFormat) {
  var self = this;
  var settings = {
    price: true,
    date: false,
    maxOffers: 2
  };
  if(pCategory == 'conferences') {
    settings.price = false;
    settings.date = true;
  }
  if(pFormat == '324x480') {
    settings.maxOffers = 4
  } else if(pFormat == '230x324') {
    settings.maxOffers = 1
  }
  return settings;
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
};

app.prototype.addOffer_ = function(pObj) {
  var self = this;
  $.get(self.path.templates + 'screen-tpl.mustache.html', function(template, textStatus, jqXhr) {
    self.dom.screensList.append(Mustache.render($(template).filter('#screenTpl').html(), pObj));
    $("input[name='"+ pObj.id +"_destination']").rules('add', {
      required: true,
      messages: {
        required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')'
      }
    });
    $("input[name='"+ pObj.id +"_moreDestination']").rules('add', {
      required: true,
      messages: {
        required: ' <span class="msg">(' + self.t[self.culture]['requiredField'] + ')'
      }
    });
  });
};

app.prototype.verticalAlign_ = function(pElem) {
  var self = this;
  var h = pElem.height();
  var browserH = $(window).height();
  var posY = (browserH - h - 90) / 2;
  pElem.css('top', posY + 'px');
};