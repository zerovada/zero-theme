<?php
namespace Zero\Core\Customizer\Controls;

use WP_Customize_Control;

defined( 'ABSPATH' ) || exit;

class Radio_Image extends WP_Customize_Control {
    public $type = 'radio-image';

    public function enqueue() {
        wp_enqueue_style( 'zero-radio-image-control', get_template_directory_uri() . '/assets/dist/css/customizer-controls.css', [], null );
    }

    public function render_content() {
        if ( empty( $this->choices ) ) {
            return;
        }
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <ul class="radio-image-list">
            <?php foreach ( $this->choices as $value => $url ) : ?>
                <li>
                    <label>
                        <input
                            type="radio"
                            name="<?php echo esc_attr( $this->id ); ?>"
                            value="<?php echo esc_attr( $value ); ?>"
                            <?php $this->link(); checked( $this->value(), $value ); ?>
                        />
                        <img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $value ); ?>" />
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }
}
