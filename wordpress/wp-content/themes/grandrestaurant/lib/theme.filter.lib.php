<?php
function pp_tag_cloud_filter($args = array()) {
   $args['smallest'] = 13;
   $args['largest'] = 13;
   $args['unit'] = 'px';
   return $args;
}

add_filter('widget_tag_cloud_args', 'pp_tag_cloud_filter', 90);

//Control post excerpt length
function tg_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'tg_excerpt_length', 200 );

/**
 * Change default fields, add placeholder and change type attributes.
 *
 * @param  array $fields
 * @return array
 */
add_filter( 'comment_form_default_fields', 'wpse_62742_comment_placeholders' );
 
function wpse_62742_comment_placeholders( $fields )
{
    $fields['author'] = str_replace('<input', '<input placeholder="'. __('Name', THEMEDOMAIN). '"',$fields['author']);
    $fields['email'] = str_replace('<input id="email" name="email" type="text"', '<input type="email" placeholder="'.__('Email', THEMEDOMAIN).'"  id="email" name="email"',$fields['email']);
    $fields['url'] = str_replace('<input id="url" name="url" type="text"', '<input placeholder="'.__('Website', THEMEDOMAIN).'" id="url" name="url" type="url"',$fields['url']);

    return $fields;
}

//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');

//Add upload form to page
if (is_admin()) {
  $current_admin_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);

  if ($current_admin_page == 'post' || $current_admin_page == 'post-new')
  {
 
    /** Need to force the form to have the correct enctype. */
    function add_post_enctype() {
      echo "<script type=\"text/javascript\">
        jQuery(document).ready(function(){
        jQuery('#post').attr('enctype','multipart/form-data');
        jQuery('#post').attr('encoding', 'multipart/form-data');
        });
        </script>";
    }
 
    add_action('admin_head', 'add_post_enctype');
  }
}

// remove version query string from scripts and stylesheets
function wcs_remove_script_styles_version( $src ){
    return remove_query_arg( 'ver', $src );
}
add_filter( 'script_loader_src', 'wcs_remove_script_styles_version' );
add_filter( 'style_loader_src', 'wcs_remove_script_styles_version' );

add_filter('redirect_canonical','custom_disable_redirect_canonical');
function custom_disable_redirect_canonical($redirect_url) {if (is_paged() && is_singular()) $redirect_url = false; return $redirect_url; }

add_action( 'edit_form_after_title', 'grandrestaurant_content_builder_enable');

function grandrestaurant_content_builder_enable ($post) 
{
	//Check if enable content builder
	$ppb_enable = get_post_meta($post->ID, 'ppb_enable');
	$enable_builder_class = '';
	$enable_classic_builder_class = '';
	
	if(!empty($ppb_enable))
	{
		$enable_builder_class = 'hidden';
		$enable_classic_builder_class = 'visible';
	}
	
	//Check if user edit page
	$page_id = '';
	
	if (isset($_GET['action']) && $_GET['action'] == 'edit')
	{
		$page_id = $post->ID;
	}

	//Display only on page and portfolio
	if($post->post_type == 'page' OR $post->post_type == 'portfolios')
	
    echo '<a href="javascript:;" id="enable_builder" class="'.esc_attr($enable_builder_class).'" data-page-id="'.esc_attr($page_id).'"><i class="fa fa-th-list"></i>'.esc_html__('Edit in Content Builder', 'photography-translation' ).'</a>';
    echo '<a href="javascript:;" id="enable_classic_builder" class="'.esc_attr($enable_classic_builder_class).'"><i class="fa fa-edit"></i>'.esc_html__('Edit in Classic Editor', 'photography-translation' ).'</a>';
}
?>