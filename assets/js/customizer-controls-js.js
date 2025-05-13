( function( $ ) {
    // You can add custom UI behaviors for the controls pane here.
    $( function() {
        // Example: add a description under toggles
        $( '#customize-control-site_title_toggle .customize-control-title' )
          .after( '<p class="description">Toggle the display of your site title.</p>' );
    } );
} )( jQuery );

( function( $ ) {
    // Initialize WP color picker on our inputs
    $( function() {
        $( '.my-color-field' ).wpColorPicker({
            palettes: true,
            // change: function(event, ui){ /* instant update if desired */ },
        });
    } );
} )( jQuery );

