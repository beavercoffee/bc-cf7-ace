if('undefined' === typeof(bc_cf7_ace)){
    var bc_cf7_ace = {

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        edit: function(id){
            if(jQuery('#' + id).length){
                if(typeof bc_cf7_ace.editors[id] === 'undefined'){
                    jQuery('#' + id).hide();
                	jQuery('<div class="bc-cf7-editor-container" id="' + id + '-editor-container"><div id="' + id + '-editor"></div></div>').insertBefore('#' + id);
                    bc_cf7_ace.editors[id] = ace.edit(id + '-editor');
                    bc_cf7_ace.editors[id].$blockScrolling = Infinity;
                    bc_cf7_ace.editors[id].setOptions({
                    	enableBasicAutocompletion: true,
                    	enableLiveAutocompletion: true,
                    	fontSize: 14,
                        maxLines: Infinity,
                        minLines: 5,
                        wrap: true,
                    });
                    bc_cf7_ace.editors[id].getSession().on('change', function(){
                        jQuery('#' + id).val(bc_cf7_ace.editors[id].getSession().getValue()).trigger('change');
                    });
                    bc_cf7_ace.editors[id].getSession().setMode('ace/mode/html');
                    bc_cf7_ace.editors[id].getSession().setValue(jQuery('#' + id).val());
                    bc_cf7_ace.editors[id].setTheme('ace/theme/monokai');
                }
            }
        },

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        editors: [],

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        destroy: function(id){
            if(typeof bc_cf7_ace.editors[id] !== 'undefined'){
                bc_cf7_ace.editors[id].destroy();
                jQuery('#' + id + '-editor-container').remove();
            	jQuery('#' + id).show();
            }
        },

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        init: function(){
            if(typeof ace != 'undefined'){
                ace.config.set('basePath', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12');
               	ace.require('ace/ext/language_tools');
                bc_cf7_ace.edit('wpcf7-form');
                bc_cf7_ace.mail();
                bc_cf7_ace.mail_2();
                jQuery('#wpcf7-mail-use-html').on('change', bc_cf7_ace.mail);
                jQuery('#wpcf7-mail-2-use-html').on('change', bc_cf7_ace.mail_2);
        	}
        },

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        mail: function(){
            if(jQuery('#wpcf7-mail-use-html').prop('checked')){
                bc_cf7_ace.edit('wpcf7-mail-body');
            } else {
                bc_cf7_ace.destroy('wpcf7-mail-body');
            }
        },

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        mail_2: function(){
            if(jQuery('#wpcf7-mail-2-use-html').prop('checked')){
                bc_cf7_ace.edit('wpcf7-mail-2-body');
            } else {
                bc_cf7_ace.destroy('wpcf7-mail-2-body');
            }
        },

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    };
}
