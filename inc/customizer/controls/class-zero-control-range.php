<?php
namespace Zero\Core\Customizer\Controls;

use WP_Customize_Control;

defined( 'ABSPATH' ) || exit;

/**
 * Range Slider control.
 */
class Range extends WP_Customize_Control {
    public $type = 'range';

    public function enqueue() {
        // nothing extra
    }

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input
                type="range"
                <?php $this->link(); ?>
                value="<?php echo esc_attr( $this->value() ); ?>"
                <?php
                foreach ( $this->input_attrs as $attr => $val ) {
                    echo sprintf( ' %s="%s"', esc_attr( $attr ), esc_attr( $val ) );
                }
                ?>
            />
            <span class="range-value"><?php echo esc_html( $this->value() ); ?></span>
        </label>
        <?php
    }
}
