<?php
namespace Zero\Core\Customizer\Controls;

use WP_Customize_Control;

defined( 'ABSPATH' ) || exit;

class Dimension extends WP_Customize_Control {
    public $type = 'number';
    public $input_attrs = [];

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input
                type="number"
                <?php $this->link(); ?>
                value="<?php echo esc_attr( $this->value() ); ?>"
                <?php foreach ( $this->input_attrs as $attr => $val ) {
                    printf( ' %s="%s"', esc_attr( $attr ), esc_attr( $val ) );
                } ?>
            /> px
        </label>
        <?php
    }
}
