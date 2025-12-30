<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */
 

if (!isset( $content_width ) ) $content_width = 1170;

if(session_id() == '') {
	session_start();
}
 
global $pp_homepage_style;

$tg_menu_layout = kirki_get_option('tg_menu_layout');
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo 'data-style="'.esc_attr($pp_homepage_style).'"'; } ?> data-menu="<?php echo esc_attr($tg_menu_layout); ?>">
<head>
<meta charset="<?php echo get_bloginfo( 'charset' ); ?>" />

<?php
	$tg_mobile_responsive = kirki_get_option('tg_mobile_responsive');
	
	if(!empty($tg_mobile_responsive))
	{
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php
	}
?>

<meta name="format-detection" content="telephone=no">

<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function tg_render_title() {
?>
<title><?php wp_title(); ?></title>
<?php
    }
    add_action( 'wp_head', 'tg_render_title' );
endif;

if(is_single())
{
	if(has_post_thumbnail(get_the_ID(), 'blog_f'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $fb_thumb = wp_get_attachment_image_src($image_id, 'thumbnail', true);
	}

	if(isset($fb_thumb[0]) && !empty($fb_thumb[0]))
	{
		$post_content = get_post_field('post_excerpt', $post->ID);
	?>
	<meta property="og:type" content="article" />
	<meta property="og:image" content="<?php echo esc_url($fb_thumb[0]); ?>"/>
	<meta property="og:title" content="<?php echo esc_attr(get_the_title()); ?>"/>
	<meta property="og:url" content="<?php echo esc_url(get_permalink($post->ID)); ?>"/>
	<meta property="og:description" content="<?php echo esc_attr(strip_tags($post_content)); ?>"/>
	<?php
	}
}
?>

<?php
	/**
	*	Get favicon URL
	**/
	$tg_favicon = str_replace("http://", "https://", kirki_get_option('tg_favicon'));
	
	if(!empty($tg_favicon))
	{
?>
		<link rel="shortcut icon" href="<?php echo esc_url($tg_favicon); ?>" />
<?php
	}
?> 

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '150343692423247');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=150343692423247&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

</head>

<body <?php body_class(); ?>>

	<?php
		//Check if disable right click
		$tg_enable_right_click = kirki_get_option('tg_enable_right_click');
		
		//Check if disable image dragging
		$tg_enable_dragging = kirki_get_option('tg_enable_dragging');
		
		//Check if use AJAX search
		$tg_menu_search_instant = kirki_get_option('tg_menu_search_instant');
		
		//Check if sticky menu
		$tg_fixed_menu = kirki_get_option('tg_fixed_menu');
		
		//Check if display top bar
		$tg_topbar = kirki_get_option('tg_topbar');
		if(THEMEDEMO && isset($_GET['topbar']) && !empty($_GET['topbar']))
		{
			$tg_topbar = true;
		}
		
		//Check if add blur effect
		$tg_page_title_img_blur = kirki_get_option('tg_page_title_img_blur');

		//Check menu layout
		$tg_menu_layout = kirki_get_option('tg_menu_layout');
		
		//Check filterable link option
		$tg_project_filterable_link = kirki_get_option('tg_project_filterable_link');
	?>
	<input type="hidden" id="pp_menu_layout" name="pp_menu_layout" value="<?php echo esc_attr($tg_menu_layout); ?>"/>
	<input type="hidden" id="pp_enable_right_click" name="pp_enable_right_click" value="<?php echo esc_attr($tg_enable_right_click); ?>"/>
	<input type="hidden" id="pp_enable_dragging" name="pp_enable_dragging" value="<?php echo esc_attr($tg_enable_dragging); ?>"/>
	<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>
	<input type="hidden" id="pp_homepage_url" name="pp_homepage_url" value="<?php echo esc_url(home_url()); ?>"/>
	<input type="hidden" id="pp_ajax_search" name="pp_ajax_search" value="<?php echo esc_attr($tg_menu_search_instant); ?>"/>
	<input type="hidden" id="pp_fixed_menu" name="pp_fixed_menu" value="<?php echo esc_attr($tg_fixed_menu); ?>"/>
	<input type="hidden" id="pp_topbar" name="pp_topbar" value="<?php echo esc_attr($tg_topbar); ?>"/>
	<input type="hidden" id="post_client_column" name="post_client_column" value="4"/>
	<input type="hidden" id="pp_back" name="pp_back" value="<?php _e( 'Back', THEMEDOMAIN ); ?>"/>
	<input type="hidden" id="pp_page_title_img_blur" name="pp_page_title_img_blur" value="<?php echo esc_attr($tg_page_title_img_blur); ?>"/>
	<input type="hidden" id="tg_project_filterable_link" name="tg_project_filterable_link" value="<?php echo esc_attr($tg_project_filterable_link); ?>"/>
	
	<?php
		//Check footer sidebar columns
		$tg_footer_sidebar = kirki_get_option('tg_footer_sidebar');
	?>
	<input type="hidden" id="pp_footer_style" name="pp_footer_style" value="<?php echo esc_attr($tg_footer_sidebar); ?>"/>
	
	<!-- Begin mobile menu -->
	<div class="mobile_menu_wrapper">
		<a id="close_mobile_menu" href="javascript:;"><i class="fa fa-close"></i></a>
		
		<?php
    	    //Check if display search in header	
    	    $tg_menu_search = kirki_get_option('tg_menu_search');
    	    if($tg_menu_layout == 'leftmenu')
    	    {
	    	    $tg_menu_search = 0;
    	    }
    	    
    	    if(!empty($tg_menu_search))
    	    {
    	?>
    	<form role="search" method="get" name="searchform" id="searchform" action="<?php echo home_url(); ?>/">
    	    <div>
    	    	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off" placeholder="<?php _e( 'Search...', THEMEDOMAIN ); ?>"/>
    	    	<button>
    	        	<i class="fa fa-search"></i>
    	        </button>
    	    </div>
    	    <div id="autocomplete"></div>
    	</form>
    	<?php
    	    }
    	?>
    	
    	<?php 
    		//Working on page transparent logic
    	
			//Get page ID
			if(is_object($post))
			{
			    $page = get_page($post->ID);
			}
			$current_page_id = '';
			
			if(isset($page->ID))
			{
			    $current_page_id = $page->ID;
			}
			elseif(is_home())
			{
			    $current_page_id = get_option('page_on_front');
			}
			
		    //If enable menu transparent
		    $page_menu_transparent = 0;
		    
		    if(is_page())
		    {
		    	$page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);
		    }
		    
		    if(is_single())
		    {
		    	if(has_post_thumbnail(get_the_ID(), 'original') && $tg_menu_layout != 'leftmenu')
		    	{
		    		$page_menu_transparent = 1;
		    	}
		    }
	
			//Check if Woocommerce is installed	
			if(class_exists('Woocommerce'))
			{
			    //Check if woocommerce page
				if(tg_is_woocommerce_page() && !is_product_category() && !is_product())
				{
					$shop_page_id = get_option( 'woocommerce_shop_page_id' );
					$page_menu_transparent = get_post_meta($shop_page_id, 'page_menu_transparent', true);
				}
				elseif(tg_is_woocommerce_page() && is_product_category() && !is_product())
				{
					$page_menu_transparent = 0;
				}
				elseif(is_product())
				{
					$page_menu_transparent = 0;
				}
			}
			
			if($pp_homepage_style == 'fullscreen')
		    {
		        $page_menu_transparent = 1;
		    }
		    
		    if(is_search())
		    {
			    $page_menu_transparent = 0;
		    }
		    
		    if(is_404())
		    {
			    $page_menu_transparent = 0;
		    }
		?>
    	
    	<?php
    		//If left menu then display logo
    		if($tg_menu_layout == 'leftmenu')
    	    {
    	?>
    	
    	<?php
    	    //get custom logo
    	    $tg_retina_logo = kirki_get_option('tg_retina_logo');

    	    if(!empty($tg_retina_logo))
    	    {	
    	    	//Get image width and height
		    	$image_id = pp_get_image_id($tg_retina_logo);
		    	$obj_image = wp_get_attachment_image_src($image_id, 'original');
		    	$image_width = 0;
		    	$image_height = 0;
		    	
		    	if(isset($obj_image[1]))
		    	{
		    		$image_width = intval($obj_image[1]/2);
		    	}
		    	if(isset($obj_image[2]))
		    	{
		    		$image_height = intval($obj_image[2]/2);
		    	}
    	?>
    	<div id="logo_normal" class="logo_container">
    		<div class="logo_align">
	    	    <a id="custom_logo" class="logo_wrapper <?php if(!empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo home_url(); ?>">
	    	    	<?php
						if($image_width > 0 && $image_height > 0)
						{
					?>
					<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
					<?php
						}
						else
						{
					?>
	    	    	<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="154" height="59"/>
	    	    	<?php 
		    	    	}
		    	    ?>
	    	    </a>
    		</div>
    	</div>
    	<?php
    	    }
    	?>
    	
    	<?php
    		//get custom logo transparent
    	    $tg_retina_transparent_logo = kirki_get_option('tg_retina_transparent_logo');

    	    if(!empty($tg_retina_transparent_logo))
    	    {
    	    	//Get image width and height
		    	$image_id = pp_get_image_id($tg_retina_transparent_logo);
		    	$obj_image = wp_get_attachment_image_src($image_id, 'original');
		    	$image_width = 0;
		    	$image_height = 0;
		    	
		    	if(isset($obj_image[1]))
		    	{
		    		$image_width = intval($obj_image[1]/2);
		    	}
		    	if(isset($obj_image[2]))
		    	{
		    		$image_height = intval($obj_image[2]/2);
		    	}
    	?>
    	<div id="logo_transparent" class="logo_container">
    		<div class="logo_align">
	    	    <a id="custom_logo_transparent" class="logo_wrapper <?php if(empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo home_url(); ?>">
	    	    	<?php
						if($image_width > 0 && $image_height > 0)
						{
					?>
					<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
					<?php
						}
						else
						{
					?>
	    	    	<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="154" height="59"/>
	    	    	<?php 
		    	    	}
		    	    ?>
	    	    </a>
    		</div>
    	</div>
    	<?php
    	    }
    	?>
    	<!-- End logo -->
    	<?php
    		}
    	?>
    	
	    <?php 
	    	//Check if has custom menu
			if(is_object($post) && $post->post_type == 'page')
			{
			    $page_menu = get_post_meta($post->ID, 'page_menu', true);
			}	
			
			if ( has_nav_menu( 'side-menu' ) ) 
			{
			    //Get page nav
			    wp_nav_menu( 
			        array( 
			            'menu_id'			=> 'mobile_main_menu',
		                'menu_class'		=> 'mobile_main_nav',
			            'theme_location' 	=> 'side-menu',
			        )
			    ); 
			}
		?>
		
		<!-- Begin Reservation -->
		<?php
		    //Reservation button
		    $pp_reservation_email = get_option('pp_reservation_email');
		    
		    if(!empty($pp_reservation_email))
		    {
		?>
		<a href="javascript:;" id="tg_sidemenu_reservation" class="button"><?php _e( 'Reservation', THEMEDOMAIN ); ?></a>
		<?php
		    }
		?>
		<!-- End Reservation -->
		
		<!-- Begin side menu sidebar -->
		<div class="page_content_wrapper">
			<div class="sidebar_wrapper">
		        <div class="sidebar">
		        
		        	<div class="content">
		        
		        		<ul class="sidebar_widget">
		        		<?php dynamic_sidebar('Side Menu Sidebar'); ?>
		        		</ul>
		        	
		        	</div>
		    
		        </div>
			</div>
		</div>
		<!-- End side menu sidebar -->
	</div>
	<!-- End mobile menu -->

	<!-- Begin template wrapper -->
	<div id="wrapper" <?php if(!empty($page_menu_transparent)) { ?>class="hasbg"<?php } ?>>
	
	<?php
		$tg_menu_layout = kirki_get_option('tg_menu_layout');
	
		if($tg_menu_layout == 'centermenu')
		{
			get_template_part("/templates/template-centermenu");
		}
		else
		{
			get_template_part("/templates/template-topmenu");
		}
	?>
	
	<?php
	    //Check if theme demo then enable layout switcher
	    if(THEMEDEMO)
	    {
	?>
	    <div id="option_wrapper">
	    <div class="inner">
	    	<div style="text-align:center">
	    	<h6>PREDEFINED DEMOS</h6>
	    	<p>
	    	Grand Restaurant is so powerful theme allow you to easily create your own style of restaurant site. Here are example that can be imported with one click.</p>
	    	<ul class="demo_list">
	    		<li>
		    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/cache/demos/screen1.jpg" alt=""/>
		    		<div class="demo_thumb_hover_wrapper">
		    		    <div class="demo_thumb_hover_inner">
		    		    	<div class="demo_thumb_desc">
			    	    		<h6>Modern Cuisine</h6>
			    	    		<a href="http://themes.themegoods2.com/grandrestaurant/" target="_blank" class="button white">Launch</a>
		    		    	</div> 
		    		    </div>	   
		    		</div>		   
	    		</li>
	    		<li>
	    			<span class="new_item">New</span>
		    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/cache/demos/screen6.jpg" alt=""/>
		    		<div class="demo_thumb_hover_wrapper">
		    		    <div class="demo_thumb_hover_inner">
		    		    	<div class="demo_thumb_desc">
			    	    		<h6>Luxury</h6>
			    	    		<a href="http://themes.themegoods2.com/grandrestaurant_demos/demo6/" target="_blank" class="button white">Launch</a>
		    		    	</div> 
		    		    </div>	   
		    		</div>		   
	    		</li>
	    		<li>
		    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/cache/demos/screen2.jpg" alt=""/>
		    		<div class="demo_thumb_hover_wrapper">
		    		    <div class="demo_thumb_hover_inner">
		    		    	<div class="demo_thumb_desc">
			    	    		<h6>Asian Cuisine</h6>
			    	    		<a href="http://themes.themegoods2.com/grandrestaurant2" target="_blank" class="button white">Launch</a>
		    		    	</div> 
		    		    </div>	   
		    		</div>		   
	    		</li>
	    		<li>
		    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/cache/demos/screen3.jpg" alt=""/>
		    		<div class="demo_thumb_hover_wrapper">
		    		    <div class="demo_thumb_hover_inner">
		    		    	<div class="demo_thumb_desc">
			    	    		<h6>Elegant</h6>
			    	    		<a href="http://themes.themegoods2.com/grandrestaurant3" target="_blank" class="button white">Launch</a>
		    		    	</div> 
		    		    </div>	   
		    		</div>		   
	    		</li>
	    		<li>
		    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/cache/demos/screen4.jpg" alt=""/>
		    		<div class="demo_thumb_hover_wrapper">
		    		    <div class="demo_thumb_hover_inner">
		    		    	<div class="demo_thumb_desc">
			    	    		<h6>Left Menu</h6>
			    	    		<a href="http://themes.themegoods2.com/grandrestaurant4" target="_blank" class="button white">Launch</a>
		    		    	</div> 
		    		    </div>	   
		    		</div>		   
	    		</li>
	    		<li>
		    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/cache/demos/screen5.jpg" alt=""/>
		    		<div class="demo_thumb_hover_wrapper">
		    		    <div class="demo_thumb_hover_inner">
		    		    	<div class="demo_thumb_desc">
			    	    		<h6>Bakery With Boxed Layout</h6>
			    	    		<a href="http://themes.themegoods2.com/grandrestaurant5" target="_blank" class="button white">Launch</a>
		    		    	</div> 
		    		    </div>	   
		    		</div>		   
	    		</li>
	    	</ul>
	    	</div>
	    </div>
	    </div>
	    <div id="option_btn">
	    	<a href="javascript:;" class="demotip" title="Choose Theme Demo"><i class="fa fa-cog"></i></a>
			<a href="http://themes.themegoods2.com/grandrestaurant_demos/test/wp-content/plugins/gt-custom/gt-custom.php?gtlo" class="demotip" title="Test Customizer of Theme" target="_blank"><i class="fa fa-edit"></i></a>
			<a href="http://themes.themegoods2.com/grandrestaurant_doc" class="demotip" title="Theme Documentation" target="_blank"><i class="fa fa-book"></i></a>
    	<a href="http://themeforest.net/item/grand-restaurant-restaurant-cafe-theme/11812117?ref=ThemeGoods&license=regular&open_purchase_for_item_id=11812117&purchasable=source&ref=ThemeGoods" class="demotip" title="Purchase Theme" target="_blank"><i class="fa fa-shopping-basket"></i></a>
	    </div>
	<?php
	    	wp_enqueue_script("jquery.cookie", get_stylesheet_directory_uri()."/js/jquery.cookie.js", false, THEMEVERSION, true);
	    	wp_enqueue_script("script-demo", get_stylesheet_directory_uri()."/templates/script-demo.php", false, THEMEVERSION, true);
	    }
	?>
