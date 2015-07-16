(function ( $ ) {
	"use strict";

	$(function () {

		$('.sections-list ul li a').click(
			function(){
				var $this = $(this);
				$('.sections-body .one-section-body.active').removeClass('active');
				$('.sections-body #' + $this.data('section')).addClass('active');
				$this.parents('.sections-list').find('li .active').removeClass('active');
				$this.addClass('active');
				$('.panel-header h2').html($this.html());
				$('.panel-header .section-description').html($this.data('description'));

				return false;

			}
		);



		$(".radio-image label").height($(this).parent().height());
		//This script switch visible radio buttons and check hidden input fields
		$(".radio-image label").click(
			function(){
				$(".radio-image label").removeClass("checked");
				$(this).addClass("checked");
				$(".radio-image label input").prop('checked', false);
				$(".radio-image label input").removeAttr('checked');
				$(this).find("input").attr('checked',"checked");
			}
		);

		$('.on-off-box').click(
			function(){
				var $this = $(this);
				if ($this.hasClass('on')) {
					$this.removeClass('on');
					$this.find("input").removeAttr('checked');
					$this.find("input.off").attr('checked',"checked");
				} else {
					$this.addClass('on');
					$this.find("input").removeAttr('checked');
					$this.find("input.on").attr('checked',"checked");

				}
				return false;
			}
		);
		$(".color-picker-hex").wpColorPicker();

		if ($('.set_custom_images').length > 0) {
			if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
				$('.wrap').on('click', '.set_custom_images', function(e) {
					e.preventDefault();
					var button = $(this);
					var id = button.prev();
					wp.media.editor.send.attachment = function(props, attachment) {
						id.val(attachment.id);
					};
					wp.media.editor.open(button);
					return false;
				});
			}
		};
        //googlefonts

        $('.google-webfonts').each(function(){
            var $this = $(this);

            $this.find('.demotext').text($this.find('.demotextinput').val());
        });

        var WebFontConfig = {
            google: { families: [ 'Roboto:700:latin,greek' ] }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();

	});








}(jQuery));