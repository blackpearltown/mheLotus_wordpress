(function ( $ ) {

	window['InlineShortcodeView_slick-slider'] = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window['InlineShortcodeView_slick-slider'].__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function () {
				this.wpsisac_pro_slick_slider_init();
			});
			return this;
		}
	});

	window['InlineShortcodeView_slick-carousel-slider'] = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window['InlineShortcodeView_slick-carousel-slider'].__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function () {
				this.wpsisac_pro_slick_carousel_init();
			});
			return this;
		}
	});

	window['InlineShortcodeView_slick-variable-slider'] = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window['InlineShortcodeView_slick-variable-slider'].__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function () {
				this.wpsisac_pro_slick_variable_init();
			});
			return this;
		}
	});

	window.InlineShortcodeView_vc_wp_text = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window.InlineShortcodeView_vc_wp_text.__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function (){
				this.wpsisac_pro_slick_slider_init();
				this.wpsisac_pro_slick_carousel_init();
				this.wpsisac_pro_slick_variable_init();
			});
			return this;
		}
	});

	window.InlineShortcodeView_vc_column_text = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window.InlineShortcodeView_vc_column_text.__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function (){
				this.wpsisac_pro_slick_slider_init();
				this.wpsisac_pro_slick_carousel_init();
				this.wpsisac_pro_slick_variable_init();
			});
			return this;
		}
	});
	
	window.InlineShortcodeView_vc_raw_html = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window.InlineShortcodeView_vc_raw_html.__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function (){
				this.wpsisac_pro_slick_slider_init();
				this.wpsisac_pro_slick_carousel_init();
				this.wpsisac_pro_slick_variable_init();
			});
			return this;
		}
	});

	window.InlineShortcodeView_vc_message = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window.InlineShortcodeView_vc_message.__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function (){
				this.wpsisac_pro_slick_slider_init();
				this.wpsisac_pro_slick_carousel_init();
				this.wpsisac_pro_slick_variable_init();
			});
			return this;
		}
	});

	window.InlineShortcodeView_vc_toggle = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window.InlineShortcodeView_vc_toggle.__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function (){
				this.wpsisac_pro_slick_slider_init();
				this.wpsisac_pro_slick_carousel_init();
				this.wpsisac_pro_slick_variable_init();
			});
			return this;
		}
	});

	window.InlineShortcodeView_vc_cta = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window.InlineShortcodeView_vc_cta.__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function (){
				this.wpsisac_pro_slick_slider_init();
				this.wpsisac_pro_slick_carousel_init();
				this.wpsisac_pro_slick_variable_init();
			});
			return this;
		}
	});

})( window.jQuery );