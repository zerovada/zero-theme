/**
 * customizer-preview.js
 * Live‐preview bindings for Zero Theme Customizer
 */
//console.log( '🔥 Hello from the top of customizer-preview.js' );

( function( wp, $ ) {
    console.log( '▶️ customizer-preview.js loaded in preview iframe' );

    // Site Title toggle
    wp.customize( 'zero_settings[site_title_toggle]', setting => {
        //console.log( 'Binding site_title_toggle' );
        setting.bind( show => {
           // console.log( 'site_title_toggle changed to:', show );
            $( '.site-title' ).toggle( show );
        } );
    } );


    // Tagline
    wp.customize( 'zero_settings[site_tagline_toggle]', setting => {
       // console.log( 'Binding site_tagline_toggle' );
        setting.bind( show => {
          //  console.log( 'site_tagline_toggle changed to:', show );
            $( '.site-tagline').toggle(show);
        } );
    } );

    // Logo (full refresh)
        wp.customize( 'custom_logo', function( value ) {
          //  console.log( 'Binding custom_logo (refresh)' );
            value.bind( function() {
            //    console.log( 'custom_logo changed – refreshing preview' );
                wp.customize.previewer.refresh();
            } );
        } );

        // ————————————————
        // Global Colors → CSS Variable Mapping
        // ————————————————

        wp.customize( 'zero_settings[primary_color]', setting => {
       // console.log( 'Binding primary_color' );
        setting.bind( newVal => {
        //    console.log( 'primary_color changed to:', newVal );
            document.documentElement.style.setProperty( '--color-primary', newVal );
        } );
             } );

        wp.customize( 'zero_settings[secondary_color]', setting => {
       // console.log( 'Binding secondary_color' );
        setting.bind( newVal => {
        //    console.log( 'secondary_color changed to:', newVal );
            document.documentElement.style.setProperty( '--color-secondary', newVal );
        } );
            } );

        wp.customize( 'zero_settings[surface_color]', setting => {
       // console.log( 'Binding accent_color' );
        setting.bind( newVal => {
        //    console.log( 'secondary_color changed to:', newVal );
            document.documentElement.style.setProperty( '--color-surface', newVal );
        } );
            } );

       wp.customize( 'zero_settings[accent_color]', setting => {
       // console.log( 'Binding accent_color' );
        setting.bind( newVal => {
        //    console.log( 'secondary_color changed to:', newVal );
            document.documentElement.style.setProperty( '--color-accent', newVal );
        } );
            } );

    wp.customize( 'zero_settings[text_color]', setting => {
       // console.log( 'Binding text_color' );
        setting.bind( newVal => {
        //    console.log( 'text_color changed to:', newVal );
            document.documentElement.style.setProperty( '--color-text', newVal );
        } );
            } );

    wp.customize( 'zero_settings[link_color]', setting => {
       // console.log( 'Binding link_color' );
        setting.bind( newVal => {
        //    console.log( 'link_color changed to:', newVal );
            document.documentElement.style.setProperty( '--color-link', newVal );
        } );
    } );

    wp.customize( 'zero_settings[link_hover_color]', setting => {
       // console.log( 'Binding link_hover_color' );
        setting.bind( newVal => {
        //    console.log( 'link_color changed to:', newVal );
            document.documentElement.style.setProperty( '--color-link-hover', newVal );
        } );
    } );

    wp.customize( 'zero_settings[background_color]', setting => {
       // console.log( 'Binding background_color' );
        setting.bind( newVal => {
        //    console.log( 'background_color changed to:', newVal );
            document.documentElement.style.setProperty( '--color-background', newVal );
        } );
    } );


    // ————————————————
        // Global Typography → CSS Variable Mapping
        // ————————————————

    // Body Font Size
wp.customize( 'zero_settings[body_font_size]', setting => {
  setting.bind( size => {
    document.documentElement.style.setProperty( '--font-size-base', `${ size }rem` );
  } );
} );

// Body Line Height
wp.customize( 'zero_settings[body_line_height]', setting => {
  setting.bind( lh => {
    document.documentElement.style.setProperty( '--line-height-base', lh );
  } );
} );

// Heading Scale
wp.customize( 'zero_settings[heading_scale]', setting => {
  setting.bind( scale => {
    document.documentElement.style.setProperty( '--heading-scale', scale );
  } );
} );

// Container Width
wp.customize( 'zero_settings[container_width]', setting => {
  setting.bind( w => {
    document.documentElement.style.setProperty( '--container-max-width', `${ w }px` );
  } );
} );

// Site Layout
wp.customize( 'zero_settings[site_layout]', setting => {
  setting.bind( layout => {
    document.body.setAttribute( 'data-site-layout', layout );
  } );
} );

// Sidebar Width
wp.customize( 'zero_settings[sidebar_width]', setting => {
  setting.bind( pct => {
    document.documentElement.style.setProperty( '--sidebar-width', `${ pct }%` );
  } );
} );

// Primary Button
wp.customize( 'zero_settings[btn_primary_bg]', setting => {
  setting.bind( val => document.documentElement.style.setProperty( '--btn-primary-bg', val ) );
} );
wp.customize( 'zero_settings[btn_primary_color]', setting => {
  setting.bind( val => document.documentElement.style.setProperty( '--btn-primary-color', val ) );
} );
wp.customize( 'zero_settings[btn_primary_padding_y]', setting => {
  setting.bind( val => document.documentElement.style.setProperty( '--btn-primary-ptb', `${ val }rem` ) );
} );
wp.customize( 'zero_settings[btn_primary_padding_x]', setting => {
  setting.bind( val => document.documentElement.style.setProperty( '--btn-primary-plr', `${ val }rem` ) );
} );
wp.customize( 'zero_settings[btn_primary_radius]', setting => {
  setting.bind( val => document.documentElement.style.setProperty( '--btn-primary-radius', `${ val }px` ) );
} );

// Secondary Button
wp.customize( 'zero_settings[btn_secondary_bg]', setting => {
  setting.bind( val => document.documentElement.style.setProperty( '--btn-secondary-bg', val ) );
} );
wp.customize( 'zero_settings[btn_secondary_color]', setting => {
  setting.bind( val => document.documentElement.style.setProperty( '--btn-secondary-color', val ) );
} );
wp.customize( 'zero_settings[btn_secondary_padding_y]', setting => {
  setting.bind( val => document.documentElement.style.setProperty( '--btn-secondary-ptb', `${ val }rem` ) );
} );
wp.customize( 'zero_settings[btn_secondary_padding_x]', setting => {
  setting.bind( val => document.documentElement.style.setProperty( '--btn-secondary-plr', `${ val }rem` ) );
} );
wp.customize( 'zero_settings[btn_secondary_radius]', setting => {
  setting.bind( val => document.documentElement.style.setProperty( '--btn-secondary-radius', `${ val }px` ) );
} );

// Header Layout
wp.customize( 'zero_settings[header_layout]', setting => {
  setting.bind( layout => {
    document.body.setAttribute( 'data-header-layout', layout );
  } );
} );

// Header Background Color
wp.customize( 'zero_settings[header_bg_color]', setting => {
  setting.bind( color => {
    document.querySelector('.site-header').style.setProperty( 'background-color', color );
  } );
} );

// Header Text Color
wp.customize( 'zero_settings[header_text_color]', setting => {
  setting.bind( color => {
    document.documentElement.style.setProperty( '--header-text-color', color );
  } );
} );

// Sticky Header
wp.customize( 'zero_settings[header_sticky]', setting => {
  setting.bind( enabled => {
    document.querySelector('.site-header')
      .classList.toggle( 'is-sticky', Boolean(enabled) );
  } );
} );

// Footer Columns
wp.customize( 'zero_settings[footer_columns]', setting => {
  setting.bind( cols => {
    document.querySelector( '.site-footer' )
      .setAttribute( 'data-footer-columns', cols );
  } );
} );

// Footer Background
wp.customize( 'zero_settings[footer_bg_color]', setting => {
  setting.bind( color => {
    document.querySelector( '.site-footer' ).style.backgroundColor = color;
  } );
} );

// Footer Text Color
wp.customize( 'zero_settings[footer_text_color]', setting => {
  setting.bind( color => {
    document.querySelectorAll( '.site-footer, .site-footer *' ).forEach( el => {
      el.style.color = color;
    } );
  } );
} );

// Footer Spacing
wp.customize( 'zero_settings[footer_padding_top]', setting => {
  setting.bind( val => {
    document.documentElement.style.setProperty( '--footer-pt', `${ val }rem` );
  } );
} );
wp.customize( 'zero_settings[footer_padding_bottom]', setting => {
  setting.bind( val => {
    document.documentElement.style.setProperty( '--footer-pb', `${ val }rem` );
  } );
} );

// Show / hide
wp.customize( 'zero_settings[breadcrumb_show]', setting => {
  setting.bind( show => {
    document.querySelector( '.zero-breadcrumbs' )
      .style.display = show ? '' : 'none';
  } );
} );

// Separator
wp.customize( 'zero_settings[breadcrumb_separator]', setting => {
  setting.bind( sep => {
    document.querySelectorAll( '.zero-breadcrumbs .separator' )
      .forEach( el => el.textContent = sep );
  } );
} );

// Background
wp.customize( 'zero_settings[breadcrumb_bg_color]', setting => {
  setting.bind( color => {
    document.querySelector( '.zero-breadcrumbs' )
      .style.backgroundColor = color;
  } );
} );

// Text
wp.customize( 'zero_settings[breadcrumb_text_color]', setting => {
  setting.bind( color => {
    document.querySelectorAll( '.zero-breadcrumbs a, .zero-breadcrumbs' )
      .forEach( el => el.style.color = color );
  } );
} );

// Separator color
wp.customize( 'zero_settings[breadcrumb_sep_color]', setting => {
  setting.bind( color => {
    document.querySelectorAll( '.zero-breadcrumbs .separator' )
      .forEach( el => el.style.color = color );
  } );
} );

// Padding
wp.customize( 'zero_settings[breadcrumb_padding]', setting => {
  setting.bind( val => {
    document.querySelector( '.zero-breadcrumbs' )
      .style.padding = `${ val }rem 1rem`;
  } );
} );

// Shop: products per row / columns
wp.customize( 'zero_settings[wc_products_per_row]', setting => {
  setting.bind( n => {
    document.documentElement.style.setProperty( '--wc-products-per-row', n );
  } );
} );
wp.customize( 'zero_settings[wc_columns]', setting => {
  setting.bind( n => {
    document.documentElement.style.setProperty( '--wc-archive-columns', n );
  } );
} );

// Single: sidebar position
wp.customize( 'zero_settings[wc_single_sidebar]', setting => {
  setting.bind( pos => {
    document.body.setAttribute( 'data-wc-sidebar', pos );
  } );
} );
// Single: image zoom toggle (requires refresh)
wp.customize( 'zero_settings[wc_image_zoom]', setting => {
  setting.bind( enabled => {
    // if false, destroy zoom plugin
    window.location.reload();
  } );
} );

// Cart columns
wp.customize( 'zero_settings[wc_cart_columns]', setting => {
  setting.bind( n => {
    document.documentElement.style.setProperty( '--wc-cart-columns', n );
  } );
} );





} )( wp, jQuery );
