jQuery(document).ready(function($){
var h5absettings = h5abClickSettings,
	   arguments = {};
	   if(h5absettings) {

			arguments.color = h5absettings['h5ab-click-color'];
			arguments.time = h5absettings['h5ab-click-delay'];
			arguments.widthHeight = h5absettings['h5ab-click-size'];
			arguments.disableInput = h5absettings['h5ab-click-disable-input'];

       }

$('body').clickify(arguments);

});
