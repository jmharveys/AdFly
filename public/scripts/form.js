
// JavaScript Document
var _g = globals = {};
var app = app || {};  //Évite d'overwritter des plugins s'il y en a. 

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
        required: false,
        minlength: 6,
        maxlength: 25
      },
      noAd: {
        required: true,
        minlength: 7,
        maxlength: 7
      },
      logo: {
        required: true
      }
    },
    messages: {
      noClient: {
      alphanumeric: ' <span class="msg">(' + self.t[self.culture]['mustContainNoSpecialcharacters'] + ')</span>',        
        minlength: ' <span class="msg">(' + self.t[self.culture]['mustContain6characters'] + ')</span>',
        maxlength: ' <span class="msg">(' + self.t[self.culture]['mustContain25characters'] + ')</span>'
      },
      noAd: {
        minlength: ' <span class="msg">(' + self.t[self.culture]['mustContain7digits'] + ')</span>',
        maxlength: ' <span class="msg">(' + self.t[self.culture]['mustContain7digits'] + ')</span>'
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
    self.setOffer_(500);
  });

  self.dom.nextStep.on('click', function() {
    self.changeStep_(1);
  });

  self.dom.previousStep.on('click', function() {
    self.changeStep_(-1);
    if (self.dom.field.iConfirm.is(':checked') ) {
        self.dom.downloadBtn.toggleClass('disabled');
        self.dom.field.iConfirm.attr('checked', false);  
    } 
  });

  self.dom.submit.on('click', function(e) {
  });

  self.dom.step1.on('click', '.radio', function() {
    self.radioChoice = $(this);
    self.updateRadioFormat_(self.radioChoice);
  });

  self.dom.field.category.on('change', function() {
    self.category = $(this).val();
    $(this).blur();
     if ( (self.lastCategory != "conferences" && self.category === "conferences") || (self.lastCategory === "conferences" && self.category  != "conferences") ) {
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
    // window.location.reload();
    self.resetOffers_();
    self.dom.field.category.show();
    self.updateRadioFormat_(self.radioChoice);
    self.dom.popupDelete.removeClass('active');
  }); 

};

// table with all replacements
    var defaultDiacriticsRemovalap = [
        {'base':'A', 'letters':'\u0041\u24B6\uFF21\u00C0\u00C1\u00C2\u1EA6\u1EA4\u1EAA\u1EA8\u00C3\u0100\u0102\u1EB0\u1EAE\u1EB4\u1EB2\u0226\u01E0\u00C4\u01DE\u1EA2\u00C5\u01FA\u01CD\u0200\u0202\u1EA0\u1EAC\u1EB6\u1E00\u0104\u023A\u2C6F'},
        {'base':'AA','letters':'\uA732'},
        {'base':'AE','letters':'\u00C6\u01FC\u01E2'},
        {'base':'AO','letters':'\uA734'},
        {'base':'AU','letters':'\uA736'},
        {'base':'AV','letters':'\uA738\uA73A'},
        {'base':'AY','letters':'\uA73C'},
        {'base':'B', 'letters':'\u0042\u24B7\uFF22\u1E02\u1E04\u1E06\u0243\u0182\u0181'},
        {'base':'C', 'letters':'\u0043\u24B8\uFF23\u0106\u0108\u010A\u010C\u00C7\u1E08\u0187\u023B\uA73E'},
        {'base':'D', 'letters':'\u0044\u24B9\uFF24\u1E0A\u010E\u1E0C\u1E10\u1E12\u1E0E\u0110\u018B\u018A\u0189\uA779'},
        {'base':'DZ','letters':'\u01F1\u01C4'},
        {'base':'Dz','letters':'\u01F2\u01C5'},
        {'base':'E', 'letters':'\u0045\u24BA\uFF25\u00C8\u00C9\u00CA\u1EC0\u1EBE\u1EC4\u1EC2\u1EBC\u0112\u1E14\u1E16\u0114\u0116\u00CB\u1EBA\u011A\u0204\u0206\u1EB8\u1EC6\u0228\u1E1C\u0118\u1E18\u1E1A\u0190\u018E'},
        {'base':'F', 'letters':'\u0046\u24BB\uFF26\u1E1E\u0191\uA77B'},
        {'base':'G', 'letters':'\u0047\u24BC\uFF27\u01F4\u011C\u1E20\u011E\u0120\u01E6\u0122\u01E4\u0193\uA7A0\uA77D\uA77E'},
        {'base':'H', 'letters':'\u0048\u24BD\uFF28\u0124\u1E22\u1E26\u021E\u1E24\u1E28\u1E2A\u0126\u2C67\u2C75\uA78D'},
        {'base':'I', 'letters':'\u0049\u24BE\uFF29\u00CC\u00CD\u00CE\u0128\u012A\u012C\u0130\u00CF\u1E2E\u1EC8\u01CF\u0208\u020A\u1ECA\u012E\u1E2C\u0197'},
        {'base':'J', 'letters':'\u004A\u24BF\uFF2A\u0134\u0248'},
        {'base':'K', 'letters':'\u004B\u24C0\uFF2B\u1E30\u01E8\u1E32\u0136\u1E34\u0198\u2C69\uA740\uA742\uA744\uA7A2'},
        {'base':'L', 'letters':'\u004C\u24C1\uFF2C\u013F\u0139\u013D\u1E36\u1E38\u013B\u1E3C\u1E3A\u0141\u023D\u2C62\u2C60\uA748\uA746\uA780'},
        {'base':'LJ','letters':'\u01C7'},
        {'base':'Lj','letters':'\u01C8'},
        {'base':'M', 'letters':'\u004D\u24C2\uFF2D\u1E3E\u1E40\u1E42\u2C6E\u019C'},
        {'base':'N', 'letters':'\u004E\u24C3\uFF2E\u01F8\u0143\u00D1\u1E44\u0147\u1E46\u0145\u1E4A\u1E48\u0220\u019D\uA790\uA7A4'},
        {'base':'NJ','letters':'\u01CA'},
        {'base':'Nj','letters':'\u01CB'},
        {'base':'O', 'letters':'\u004F\u24C4\uFF2F\u00D2\u00D3\u00D4\u1ED2\u1ED0\u1ED6\u1ED4\u00D5\u1E4C\u022C\u1E4E\u014C\u1E50\u1E52\u014E\u022E\u0230\u00D6\u022A\u1ECE\u0150\u01D1\u020C\u020E\u01A0\u1EDC\u1EDA\u1EE0\u1EDE\u1EE2\u1ECC\u1ED8\u01EA\u01EC\u00D8\u01FE\u0186\u019F\uA74A\uA74C'},
        {'base':'OI','letters':'\u01A2'},
        {'base':'OO','letters':'\uA74E'},
        {'base':'OU','letters':'\u0222'},
        {'base':'P', 'letters':'\u0050\u24C5\uFF30\u1E54\u1E56\u01A4\u2C63\uA750\uA752\uA754'},
        {'base':'Q', 'letters':'\u0051\u24C6\uFF31\uA756\uA758\u024A'},
        {'base':'R', 'letters':'\u0052\u24C7\uFF32\u0154\u1E58\u0158\u0210\u0212\u1E5A\u1E5C\u0156\u1E5E\u024C\u2C64\uA75A\uA7A6\uA782'},
        {'base':'S', 'letters':'\u0053\u24C8\uFF33\u1E9E\u015A\u1E64\u015C\u1E60\u0160\u1E66\u1E62\u1E68\u0218\u015E\u2C7E\uA7A8\uA784'},
        {'base':'T', 'letters':'\u0054\u24C9\uFF34\u1E6A\u0164\u1E6C\u021A\u0162\u1E70\u1E6E\u0166\u01AC\u01AE\u023E\uA786'},
        {'base':'TZ','letters':'\uA728'},
        {'base':'U', 'letters':'\u0055\u24CA\uFF35\u00D9\u00DA\u00DB\u0168\u1E78\u016A\u1E7A\u016C\u00DC\u01DB\u01D7\u01D5\u01D9\u1EE6\u016E\u0170\u01D3\u0214\u0216\u01AF\u1EEA\u1EE8\u1EEE\u1EEC\u1EF0\u1EE4\u1E72\u0172\u1E76\u1E74\u0244'},
        {'base':'V', 'letters':'\u0056\u24CB\uFF36\u1E7C\u1E7E\u01B2\uA75E\u0245'},
        {'base':'VY','letters':'\uA760'},
        {'base':'W', 'letters':'\u0057\u24CC\uFF37\u1E80\u1E82\u0174\u1E86\u1E84\u1E88\u2C72'},
        {'base':'X', 'letters':'\u0058\u24CD\uFF38\u1E8A\u1E8C'},
        {'base':'Y', 'letters':'\u0059\u24CE\uFF39\u1EF2\u00DD\u0176\u1EF8\u0232\u1E8E\u0178\u1EF6\u1EF4\u01B3\u024E\u1EFE'},
        {'base':'Z', 'letters':'\u005A\u24CF\uFF3A\u0179\u1E90\u017B\u017D\u1E92\u1E94\u01B5\u0224\u2C7F\u2C6B\uA762'},
        {'base':'a', 'letters':'\u0061\u24D0\uFF41\u1E9A\u00E0\u00E1\u00E2\u1EA7\u1EA5\u1EAB\u1EA9\u00E3\u0101\u0103\u1EB1\u1EAF\u1EB5\u1EB3\u0227\u01E1\u00E4\u01DF\u1EA3\u00E5\u01FB\u01CE\u0201\u0203\u1EA1\u1EAD\u1EB7\u1E01\u0105\u2C65\u0250'},
        {'base':'aa','letters':'\uA733'},
        {'base':'ae','letters':'\u00E6\u01FD\u01E3'},
        {'base':'ao','letters':'\uA735'},
        {'base':'au','letters':'\uA737'},
        {'base':'av','letters':'\uA739\uA73B'},
        {'base':'ay','letters':'\uA73D'},
        {'base':'b', 'letters':'\u0062\u24D1\uFF42\u1E03\u1E05\u1E07\u0180\u0183\u0253'},
        {'base':'c', 'letters':'\u0063\u24D2\uFF43\u0107\u0109\u010B\u010D\u00E7\u1E09\u0188\u023C\uA73F\u2184'},
        {'base':'d', 'letters':'\u0064\u24D3\uFF44\u1E0B\u010F\u1E0D\u1E11\u1E13\u1E0F\u0111\u018C\u0256\u0257\uA77A'},
        {'base':'dz','letters':'\u01F3\u01C6'},
        {'base':'e', 'letters':'\u0065\u24D4\uFF45\u00E8\u00E9\u00EA\u1EC1\u1EBF\u1EC5\u1EC3\u1EBD\u0113\u1E15\u1E17\u0115\u0117\u00EB\u1EBB\u011B\u0205\u0207\u1EB9\u1EC7\u0229\u1E1D\u0119\u1E19\u1E1B\u0247\u025B\u01DD'},
        {'base':'f', 'letters':'\u0066\u24D5\uFF46\u1E1F\u0192\uA77C'},
        {'base':'g', 'letters':'\u0067\u24D6\uFF47\u01F5\u011D\u1E21\u011F\u0121\u01E7\u0123\u01E5\u0260\uA7A1\u1D79\uA77F'},
        {'base':'h', 'letters':'\u0068\u24D7\uFF48\u0125\u1E23\u1E27\u021F\u1E25\u1E29\u1E2B\u1E96\u0127\u2C68\u2C76\u0265'},
        {'base':'hv','letters':'\u0195'},
        {'base':'i', 'letters':'\u0069\u24D8\uFF49\u00EC\u00ED\u00EE\u0129\u012B\u012D\u00EF\u1E2F\u1EC9\u01D0\u0209\u020B\u1ECB\u012F\u1E2D\u0268\u0131'},
        {'base':'j', 'letters':'\u006A\u24D9\uFF4A\u0135\u01F0\u0249'},
        {'base':'k', 'letters':'\u006B\u24DA\uFF4B\u1E31\u01E9\u1E33\u0137\u1E35\u0199\u2C6A\uA741\uA743\uA745\uA7A3'},
        {'base':'l', 'letters':'\u006C\u24DB\uFF4C\u0140\u013A\u013E\u1E37\u1E39\u013C\u1E3D\u1E3B\u017F\u0142\u019A\u026B\u2C61\uA749\uA781\uA747'},
        {'base':'lj','letters':'\u01C9'},
        {'base':'m', 'letters':'\u006D\u24DC\uFF4D\u1E3F\u1E41\u1E43\u0271\u026F'},
        {'base':'n', 'letters':'\u006E\u24DD\uFF4E\u01F9\u0144\u00F1\u1E45\u0148\u1E47\u0146\u1E4B\u1E49\u019E\u0272\u0149\uA791\uA7A5'},
        {'base':'nj','letters':'\u01CC'},
        {'base':'o', 'letters':'\u006F\u24DE\uFF4F\u00F2\u00F3\u00F4\u1ED3\u1ED1\u1ED7\u1ED5\u00F5\u1E4D\u022D\u1E4F\u014D\u1E51\u1E53\u014F\u022F\u0231\u00F6\u022B\u1ECF\u0151\u01D2\u020D\u020F\u01A1\u1EDD\u1EDB\u1EE1\u1EDF\u1EE3\u1ECD\u1ED9\u01EB\u01ED\u00F8\u01FF\u0254\uA74B\uA74D\u0275'},
        {'base':'oi','letters':'\u01A3'},
        {'base':'ou','letters':'\u0223'},
        {'base':'oo','letters':'\uA74F'},
        {'base':'p','letters':'\u0070\u24DF\uFF50\u1E55\u1E57\u01A5\u1D7D\uA751\uA753\uA755'},
        {'base':'q','letters':'\u0071\u24E0\uFF51\u024B\uA757\uA759'},
        {'base':'r','letters':'\u0072\u24E1\uFF52\u0155\u1E59\u0159\u0211\u0213\u1E5B\u1E5D\u0157\u1E5F\u024D\u027D\uA75B\uA7A7\uA783'},
        {'base':'s','letters':'\u0073\u24E2\uFF53\u00DF\u015B\u1E65\u015D\u1E61\u0161\u1E67\u1E63\u1E69\u0219\u015F\u023F\uA7A9\uA785\u1E9B'},
        {'base':'t','letters':'\u0074\u24E3\uFF54\u1E6B\u1E97\u0165\u1E6D\u021B\u0163\u1E71\u1E6F\u0167\u01AD\u0288\u2C66\uA787'},
        {'base':'tz','letters':'\uA729'},
        {'base':'u','letters': '\u0075\u24E4\uFF55\u00F9\u00FA\u00FB\u0169\u1E79\u016B\u1E7B\u016D\u00FC\u01DC\u01D8\u01D6\u01DA\u1EE7\u016F\u0171\u01D4\u0215\u0217\u01B0\u1EEB\u1EE9\u1EEF\u1EED\u1EF1\u1EE5\u1E73\u0173\u1E77\u1E75\u0289'},
        {'base':'v','letters':'\u0076\u24E5\uFF56\u1E7D\u1E7F\u028B\uA75F\u028C'},
        {'base':'vy','letters':'\uA761'},
        {'base':'w','letters':'\u0077\u24E6\uFF57\u1E81\u1E83\u0175\u1E87\u1E85\u1E98\u1E89\u2C73'},
        {'base':'x','letters':'\u0078\u24E7\uFF58\u1E8B\u1E8D'},
        {'base':'y','letters':'\u0079\u24E8\uFF59\u1EF3\u00FD\u0177\u1EF9\u0233\u1E8F\u00FF\u1EF7\u1E99\u1EF5\u01B4\u024F\u1EFF'},
        {'base':'z','letters':'\u007A\u24E9\uFF5A\u017A\u1E91\u017C\u017E\u1E93\u1E95\u01B6\u0225\u0240\u2C6C\uA763'}
    ];
    
// build a map to feed to the function
    var diacriticsMap = {};
    
    for (var i=0; i < defaultDiacriticsRemovalap.length; i++){
        var letters = defaultDiacriticsRemovalap[i].letters.split("");
        for (var j=0; j < letters.length ; j++){
            diacriticsMap[letters[j]] = defaultDiacriticsRemovalap[i].base;
        }
    }

// actual operation

function removeDiacritics(str) {
   return str.replace(/[^A-Za-z0-9\s]/g, function(a){ 
     return diacriticsMap[a] || a; 
   });
}


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
      var adNumber = self.dom.field.noAd.val();
      var adZipName = adNumber;
      if (self.dom.field.noClient.val() != "") {
          var customerName = removeDiacritics(self.dom.field.noClient.val().toLowerCase().replace(/[`~!@#$%^&*()¨^_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, ''));
          customerName;
          adZipName = adZipName+"_"+customerName;
      }
      var customerName = 
      $.ajax({
        type: "POST",
        url: self.root + 'app/libraries/zipFolder.php',
        data: {"folder": folder, "name": adZipName},
        success: function(data) {
          var url = self.root + '/temps/' + self.id + '/'+adZipName+'.zip';
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
    self.dom.field.category.show();
  }
};

app.prototype.resetOffers_ = function() {
  var self = this;
  var fieldsets = self.dom.offersList.children('fieldset');
  for(var x=0; x<=fieldsets.length; x++) {
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
  if (pId != null) {
    var index = arrIds.indexOf(pId.toString());
    var multifiles = $('.multi-files .btn');
    if(index === -1) {
      arrIds.push(pId);
      self.offersNbr++;
    } else {
      arrIds.splice(index, 1);
      self.offersNbr--;
    }
  }else{
    arrIds = [];
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
      self.dom.field.offersId.val("");
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