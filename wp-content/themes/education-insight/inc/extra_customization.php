<?php 

	/*---------------------------Width -------------------*/

	$education_insight_custom_style= "";
	
	$education_insight_theme_width = get_theme_mod( 'education_insight_width_options','full_width');

    if($education_insight_theme_width == 'full_width'){

		$education_insight_custom_style .='body{';

			$education_insight_custom_style .='max-width: 100%;';

		$education_insight_custom_style .='}';

	}else if($education_insight_theme_width == 'container'){

		$education_insight_custom_style .='body{';

			$education_insight_custom_style .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px;  margin-right: auto !important; margin-left: auto !important;';

		$education_insight_custom_style .='}';
		

	}else if($education_insight_theme_width == 'container_fluid'){

		$education_insight_custom_style .='body{';

			$education_insight_custom_style .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';

		$education_insight_custom_style .='}';
	}
	//--------------------sticky header----------------------
	if( get_option( 'education_insight_sticky_header',true) != 'on') {

		$education_insight_custom_style .='.fixed_header.fixed{';

			$education_insight_custom_style .='position: static;';
			
		$education_insight_custom_style .='}';
	}

	if( get_option( 'education_insight_sticky_header',true) != 'off') {

		$education_insight_custom_style .='.fixed_header.fixed{';

			$education_insight_custom_style .='position: fixed;';
			
		$education_insight_custom_style .='}';
	}
	/*---------------------------Scroll-top-position -------------------*/
	
	$education_insight_scroll_options = get_theme_mod( 'education_insight_scroll_options','right_align');

    if($education_insight_scroll_options == 'right_align'){

		$education_insight_custom_style .='.scroll-top button{';

			$education_insight_custom_style .='';

		$education_insight_custom_style .='}';

	}else if($education_insight_scroll_options == 'center_align'){

		$education_insight_custom_style .='.scroll-top button{';

			$education_insight_custom_style .='right: 0; left:0; margin: 0 auto; top:85% !important';

		$education_insight_custom_style .='}';

	}else if($education_insight_scroll_options == 'left_align'){

		$education_insight_custom_style .='.scroll-top button{';

			$education_insight_custom_style .='right: auto; left:5%; margin: 0 auto';

		$education_insight_custom_style .='}';
	}

			/*---------------------------text-transform-------------------*/

	$education_insight_text_transform = get_theme_mod( 'education_insight_menu_text_transform','CAPITALISE');
    if($education_insight_text_transform == 'CAPITALISE'){

		$education_insight_custom_style .='nav#top_gb_menu ul li a{';

			$education_insight_custom_style .='text-transform: capitalize ; font-size: 14px;';

		$education_insight_custom_style .='}';

	}else if($education_insight_text_transform == 'UPPERCASE'){

		$education_insight_custom_style .='nav#top_gb_menu ul li a{';

			$education_insight_custom_style .='text-transform: uppercase ; font-size: 14px;';

		$education_insight_custom_style .='}';

	}else if($education_insight_text_transform == 'LOWERCASE'){

		$education_insight_custom_style .='nav#top_gb_menu ul li a{';

			$education_insight_custom_style .='text-transform: lowercase ; font-size: 14px;';

		$education_insight_custom_style .='}';
	}

			/*-------------------------Slider-content-alignment-------------------*/

		$education_insight_slider_content_alignment = get_theme_mod( 'education_insight_slider_content_alignment','CENTER-ALIGN');

		 if($education_insight_slider_content_alignment == 'LEFT-ALIGN'){

				$education_insight_custom_style .='.slider-inner{';

					$education_insight_custom_style .='text-align:left;';

				$education_insight_custom_style .='}';


			}else if($education_insight_slider_content_alignment == 'CENTER-ALIGN'){

				$education_insight_custom_style .='.slider-inner{';

					$education_insight_custom_style .='text-align:center;';

				$education_insight_custom_style .='}';


			}else if($education_insight_slider_content_alignment == 'RIGHT-ALIGN'){

				$education_insight_custom_style .='.slider-inner{';

					$education_insight_custom_style .='text-align:right;';

				$education_insight_custom_style .='}';

			}
//---------------------------------Logo-Max-height------------------------------	
			$education_insight_logo_max_height = get_theme_mod('education_insight_logo_max_height','50');

			if($education_insight_logo_max_height != false){

				$education_insight_custom_style .='.custom-logo-link img{';

					$education_insight_custom_style .='max-width: '.esc_html($education_insight_logo_max_height).'px;';

				$education_insight_custom_style .='}';
			}
//---------------------theme-button-color-------------//

	

	$education_insight_theme_button_color = get_theme_mod('education_insight_theme_button_color');

			if($education_insight_theme_button_color != false){

		$education_insight_custom_style .='button,input[type="button"],input[type="submit"],.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,button.search-submit,a.more-link,a.added_to_cart.wc-forward,home-btn,.site-footer .search-form .search-submit,.prev.page-numbers, .next.page-numbers, .page-numbers.current,.admision-btn a, .slide-btn a, .page-template-custom-home-page .admision-btn a,.slider-btn a{';

			$education_insight_custom_style .='background-color: '.esc_attr($education_insight_theme_button_color).';';

		$education_insight_custom_style .='}';
	}
	$education_insight_button_border = get_theme_mod('education_insight_button_border_radius','5');
		
		if($education_insight_button_border != false){

				$education_insight_custom_style .='button,input[type="button"],input[type="submit"],.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,button.search-submit,a.more-link,a.added_to_cart.wc-forward,home-btn,.site-footer .search-form .search-submit,#sidebar input[type="search"], input[type="search"], .prev.page-numbers, .next.page-numbers,.admision-btn a,.slide-btn a,.slider-btn a{';

		$education_insight_custom_style .='border-radius: '.esc_attr(

			$education_insight_button_border).'px;';
				
				$education_insight_custom_style .='}';
		}