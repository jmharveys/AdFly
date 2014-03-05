// JavaScript Document
var _g = globals = {};
var app = app || {};  //Évite d'overwritter des plugins si il y en a. 

app = function() {
  var self = this;
  //--- functions -----------------
  self.map_(); 
  self.init_();
  self.bindEvents_();
};

//=== MAP START =====================================================
app.prototype.map_ = function() {
  var self = this;
  self.dom = {
    b: $('body'),
    addScreen: $('.addScreen'),
    screensList: $('.screensList')
  };
  self.path = {
    templates: 'public/templates/'
  }
};
//=== MAP END ========================================================

//=== INIT START =====================================================
app.prototype.init_ = function(pObj) {
  var self = this;
  self.i = 0
  self.createScreen_({id: self.i});
};
//=== INIT END =======================================================

//=== BIND START =====================================================
app.prototype.bindEvents_ = function() {
  var self = this;

  self.dom.addScreen.on('click', function(e) {
    e.preventDefault();
    self.i++;
    self.createScreen_({id: self.i});
  });
};
//=== BIND END =======================================================

app.prototype.createScreen_ = function(pObj) {
  var self = this;
  $.get(self.path.templates + 'screen-tpl.mustache.html', function(template, textStatus, jqXhr) {
    self.dom.screensList.append(Mustache.render($(template).filter('#screenTpl').html(), pObj));
  });
}