/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
  config.height = 800;
  if(this.name == 'edit-body-und-0-summary' || this.name == 'edit-body-ru-0-summary'){
    config.height = 140;
  }

  config.disableNativeSpellChecker = false;
  config.toolbarCanCollapse = true;
};




CKEDITOR.on('dialogDefinition', function(ev){
  
  // Take the dialog name and its definition from the event data.
  var dialogName = ev.data.name;
  var dialogDefinition = ev.data.definition;
 
  if (dialogName == 'image' || dialogName == 'link') {
    var tab = dialogDefinition.getContents('info');
    
    if(dialogName == 'image'){
      // Set the default value for the Alignment field.
      var alignmentField = tab.get("cmbAlign");
      alignmentField['default'] = 'left';
    }
    
    var button = tab.get("browse");
    button['label'] = 'Сlick to upload or choose file or image';
    
  }   
  
//  CKEDITOR._scaytParams = {sLang : 'ru_RU'};
  
});

