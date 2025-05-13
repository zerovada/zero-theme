<?php
/**
 * Range Slider control for Zero Theme Customizer.
 *
 * Renders an HTML5 range input with a live‐updating value display.
 *
 * @package Zero
 */

namespace Zero\Core\Customizer\Controls;

use WP_Customize_Control;

defined( 'ABSPATH' ) || exit;

class Range extends WP_Customize_Control {
    /**
     * The type of control being rendered.
     *
     * @var string
     */
    public $type = 'range';

    /**
     * Additional attributes for the <input> element.
     *
     * E.g. [ 'min' => 0, 'max' => 2, 'step' => 0.1 ].
     *
     * @var array
     */
    public $input_attrs = [];

    /**
     * Enqueue any scripts/styles for this control.
     *
     * Here we enqueue jQuery (already bundled with WP) if needed,
     * but rely on inline script for span update.
     */
    public function enqueue() {
        // No external scripts or styles needed.
    }

    /**
     * Render the content of the control in the Customizer.
     */
    public function render_content() {
        if ( empty( $this->input_attrs ) || ! is_array( $this->input_attrs ) ) {
            $this->input_attrs = [];
        }
        ?>
        <label>
            <?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif; ?>

            <input
                type="range"
                <?php $this->link(); ?>
                value="<?php echo esc_attr( $this->value() ); ?>"
                <?php
                // Output input attributes: min, max, step, etc.
                foreach ( $this->input_attrs as $attr => $val ) {
                    printf( ' %s="%s"', esc_attr( $attr ), esc_attr( $val ) );
                }
                ?>
            />
            <span class="range-value"><?php echo esc_html( $this->value() ); ?></span>
        </label>

        <script>
        ( function( $ ) {
            // When the range input changes, update the adjacent .range-value
            $( document ).on( 'input change', '.customize-control-<?php echo esc_attr( $this->id ); ?> input[type="range"]', function() {
                $( this ).next( '.range-value' ).text( this.value );
            } );
        } )( jQuery );
        </script>
        <?php
    }
}
