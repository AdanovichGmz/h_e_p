(function ($) {

    $.fn.softkeys = function(options) {

        var settings = $.extend({
                layout : [],
                target : '',
                id:'',
                rowSeperator : 'br',
                buttonWrapper : 'li'
            },  options);

        var createRow = function(obj, clas, buttons) {
                for (var i = 0; i < buttons.length; i++) {
                    createButton(obj,clas, buttons[i]);
                }

                obj.append('<'+settings.rowSeperator+'>');
            },

            createButton = function(obj,clas, button) {
                var character = '',
                    type = 'letter',
                    styleClass = '';

                switch(typeof button) {
                    case 'array' :
                case 'object' :
                        if(typeof button[0] !== 'undefined') {
                            character += '<span>'+button[0]+'</span>';
                        }
                        if(typeof button[1] !== 'undefined') {
                            character += '<span>'+button[1]+'</span>';
                        }
                        type = 'symbol';
                        break;

                    case 'string' :
                        switch(button) {
                            case 'capslock' :
                                character = '<span>caps</span>';
                                type = 'capslock';
                                break;

                            case 'shift' :
                                character = '<span>shift</span>';
                                type = 'shift';
                                break;

                            case 'return' :
                                character = '<span>return</span>';
                                type = 'return';
                                break;

                            case 'tab' :
                                character = '<span>tab</span>';
                                type = 'tab';
                                break;
                            case '__' :
                                character = '<span>___</span>';
                                type = 'space';
                                styleClass = 'spacer';
                                break;    
                            case 'space' :
                                character = '<span>space</span>';
                                type = 'space';
                                styleClass = 'softkeys__btn--space';
                                break;

                            case '←' :
                                character = '<span id="borrar-'+settings.id+'">←</span>';
                                type = 'delete';
                                break;
                            case 'GUARDAR' :
                            character = '<span id="savekey">GUARDAR</span>';
                            styleClass = 'savebutton';
                            type = 'save';
                            break;
                             case 'OCULTAR' :
                            character = '<span id="hidekey">OCULTAR</span>';
                            type = 'hide';
                            break;
                            default :
                            character = '<span>'+button+'</span>';
                                
                                type = 'symbol';
                                break;
                        }

                        break;
                }
                
                obj.append('<'+settings.buttonWrapper+' class="softkeys__btn  '+styleClass+'" data-type="'+type+'">'+character+'</'+settings.buttonWrapper+'>');
            },

            bindKeyPress = function(obj) {
                obj.children(settings.buttonWrapper).on('click touchstart', function(event){
                    event.preventDefault();

                    var character = '',
                        type = $(this).data('type'),
                        targetValue = $(settings.target).val();

                    switch(type) {
                        case 'capslock' :
                            toggleCase(obj);
                            break;

                        case 'shift' :
                            toggleCase(obj);
                            toggleAlt(obj);
                            break;

                        case 'return' :
                            character = '\n';
                            break;

                        case 'tab' :
                            character = '\t';
                            break;

                        case 'space' :
                            character = ' ';
                            break;
                        case 'hide' :
                            jQuery('#close-down-key').click();
                            break;
                             case 'save' :
                            jQuery('#saving').click();
                            
                            
                            break;
                        case 'delete' :
                            targetValue = targetValue.substr(0, targetValue.length - 1);
                            break;

                        case 'symbol' :
                            if(obj.hasClass('softkeys--alt')) {
                                character = $(this).children('span').eq(1).html();
                            } else {
                                character = $(this).children('span').eq(0).html();
                            }
                            break;

                        case 'letter' :
                            character = $(this).html();

                            if(obj.hasClass('softkeys--caps')) {
                                character = character.toUpperCase();
                            }

                            break;
                    }

                    $(settings.target).focus().val(targetValue + character).keyup();
                });
            },

            toggleCase = function(obj) {
                obj.toggleClass('softkeys--caps');
            },

            toggleAlt = function(obj) {
                obj.toggleClass('softkeys--alt');
            };

        return this.each(function(){
            for (var i = 0; i < settings.layout.length; i++) {
                createRow($(this),$(this).data('class'), settings.layout[i]);

            }

            bindKeyPress($(this));
        });
    };

}(jQuery));