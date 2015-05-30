/*
Copyright © 2015 S. William & A.M. Pritchard
MIT Licensed - http://opensource.org/licenses/MIT
*/

(function($){

    var customCSS,
        methods = {

        init : function(options) {

            s = $.extend({
                color: 'blue',
                time: 0.25,
                widthHeight: 30,
                disableInput: true
            }, options);

            var clickElem = $(this);

            customCSS = '<style class="clickable">.clicked {position: fixed;-webkit-animation: anim ' + (s.time * 1000) + 'ms linear;animation: anim ' + (s.time * 1000) + 'ms linear;}@-webkit-keyframes anim {from {background-color: ' + s.color + ';}to {background-color: transparent;}}@keyframes anim {from {background-color: ' + s.color + ';}to {background-color: transparent;}}</style>';

            $('head').append(customCSS);

            clickElem.on('click', function(e){

                var e = e;

                function colClicks() {
                    $('<div class="clicked" style="width: ' + s.widthHeight + 'px; height: ' + s.widthHeight + 'px; border-radius: ' + s.widthHeight / 2 + 'px; left: ' + ((e.pageX - $(document).scrollLeft()) - s.widthHeight / 2) + 'px; top: ' + ((e.pageY - $(document).scrollTop()) - s.widthHeight / 2) + 'px;" />').appendTo(clickElem);

                        $('.clicked').each(function(){

                            var elem = $(this);

                            setTimeout(function(){
                                elem.remove();
                            }, (s.time * 1000) + 10);

                        });
                }

                // Support Detection to Disable in IE9 and Below
                if (document.createElement('text-shadow-support').style.textShadow === "") {
                    if (s.disableInput == false) {
                        colClicks();
                    } else {
                        if (e.target.nodeName == 'INPUT' || e.target.nodeName == 'TEXTAREA') {} else {colClicks()}
                    }
                }

            });

        },

        end : function() {
            $('head .clickable').remove();
            $('body').removeClass('clickifyActive');
        },

        reload : function() {
            $('head .clickable').remove();
            $('body').addClass('clickifyActive');
            $('head').append(customCSS);
        }

    };

    $.fn.clickify = function(methodOrOptions) {
        if ( methods[methodOrOptions] ) {
            return methods[ methodOrOptions ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  methodOrOptions + ' does not exist in Clickify' );
        }
    };

})( jQuery );
