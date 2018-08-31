<?php
	
	add_theme_support( 'post-thumbnails' );

	add_action('wp_enqueue_scripts', function(){
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() .'/style.css', array( 'sp-core-style' ), '1.0.3' );
	});

	
	
	function sp_breadcrumb(){
		if(!is_home()){
			echo '<nav class="breadcrumb">';
			echo '<a href="'.home_url('/').'">'.get_bloginfo('name').'</a><span class="divider"> / </span>';
			if(is_category() || is_single()){
				the_category('<span class="divider"> / </span>');
				if(is_single()){
					echo '<span class="divider"> / </span>';
					the_title();
				}
			}
			elseif(is_page()){
				echo the_title();
			}
			echo '</nav>';
		}
		
	}

	
	add_action('sp_header1_after', function(){
		echo '<div class="container"><div class="row"><div class="col-md-12">';
		echo '<hr><h1 class="text-center hdr-rocket"><span class="rocket"><img src="'.get_stylesheet_directory_uri().'/images/s-rocket.png"></span>
		</h1>';
		echo '</div></div></div>';
		
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