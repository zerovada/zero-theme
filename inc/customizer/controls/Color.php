<?php
namespace Zero\Core\Customizer\Controls;

use WP_Customize_Control;

defined( 'ABSPATH' ) || exit;

/**
 * Color Picker control with alpha support.
 */
class Color extends WP_Customize_Control {
    public $type = 'color';

    public function enqueue() {
        // If you need alpha picker, enqueue iris & alpha plugin here
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input
                type="text"
                <?php $this->link(); ?>
                value="<?php echo esc_attr( $this->value() ); ?>"
                class="my-color-field"
                data-alpha="true"
            />
        </label>
        <?php
    }
}
