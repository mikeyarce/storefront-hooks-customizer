<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds Customizer TinyMCE Control.
 *
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	class SHCZ_TinyMCE_Custom_control extends WP_Customize_Control {

		public $type = 'tinymce_editor';
		
		public function enqueue(){
            wp_enqueue_script( 'storefront-hooks-customizer-js', plugin_dir_url( dirname( __FILE__ ) ) . 'js/customizer.min.js', array( 'jquery' ), '1.0', true );
            wp_enqueue_editor();
		}
		/**
		 * Render the control
		 */
		public function render_content(){
		?>
			<div class="tinymce-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<textarea id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
			</div>
		<?php
		}
	}
}