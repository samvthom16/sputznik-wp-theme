<?php
	
	add_theme_support( 'post-thumbnails' );

	add_action('wp_enqueue_scripts', function(){
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() .'/style.css', array( 'sp-core-style' ), '1.0.3' );
	});

	
	
	function sp_breadcrumb(){
		if(!is_home()){
			echo '<nav class="breadcrumb">';
			echo '<a href="'.home_url('/').'">'.get_bloginfo('name').'</a><span class="divider"> / </span>';
				
			if(is_single()){
				$post_type = get_post_type();
	              
	            // If it is a custom post type display name and link
	            if($post_type != 'post') {
	                  
	                $post_type_object = get_post_type_object($post_type);
	                $post_type_archive = get_post_type_archive_link($post_type);
	              
	                echo '<a href="' . $post_type_archive . '" >' . $post_type_object->labels->name . '</a>';
	              
	                echo '<span class="divider"> / </span>';

	            }

	            echo the_title();
					
			}
			elseif(is_page()){
				echo the_title();
			}
			echo '</nav>';
		}
		
	}

	
	add_action('sp_logo', function(){
		
		echo '<hr><h1 class="text-center hdr-rocket"><span class="rocket"><img src="'.get_stylesheet_directory_uri().'/images/s-rocket.png"></span>
		</h1>';
		
		
	}, 10 );
	
	
	add_action( 'sp_pre_footer', function(){
		
		if( is_active_sidebar( 'pre-footer-sidebar' ) ){ dynamic_sidebar( 'pre-footer-sidebar' ); }
	} );
	
	add_action( 'widgets_init', function(){
		
		register_sidebar( array(
			'name' 			=> 'Pre Footer',
			'id' 			=> 'pre-footer-sidebar',
			'description' 	=> 'Appears before the footer area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
		) );
		
	});

	add_shortcode('sp_taxonomy_terms', function( $atts ){
		global $post;

		ob_start();

		$args = shortcode_atts( array(
				'taxonomy' => 'category'
			), $atts );
		
		$tax_terms = wp_get_object_terms( $post->ID, $args['taxonomy'] );
		
		if( count($tax_terms) ) { 
			foreach ($tax_terms as $tax_term) {
				$term_link = get_term_link( $tax_term );
				echo '<div class="tax-term"><i class="fa fa-tag"></i><a href="'.$term_link.'">'. $tax_term->name. '</a> </div>';
			}
		}
			
		return ob_get_clean();
	});