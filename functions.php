<?php

function themename_setup() {
   load_theme_textdomain( 'themename');
   add_theme_support('title-tag');
   add_theme_support('post-thumbnails');
   register_nav_menus( array('top'    => __( 'Top Menu', 'themename' )));
   add_theme_support( 'html5', array('comment-form','comment-list','gallery','caption',));
   add_theme_support( 'post-formats', array('aside','image','video','quote','link','gallery','audio',));
}

add_action( 'after_setup_theme', 'themename_setup' );

function themename_widgets_init(){
    register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'themename'),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'themename_widgets_init' );

function themename_scripts(){
    wp_enqueue_style( 'style_css', get_template_directory_uri() . '/style.css');
}

add_action( 'wp_enqueue_scripts', 'themename_scripts' );

add_action( 'admin_enqueue_scripts', 'themename_admin_scripts');

function themename_admin_scripts() {
	wp_enqueue_script('jquery');
	// wp_enqueue_script('jquery-ui');
    wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'jquery-ui' );
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'admin_script_js', get_template_directory_uri() . '/assets/js/admin_script.js', ['jquery'], false, true );
}

/* Custom Post Type Class */

class post_type{

	public function __construct($name, $singluar_name, $args){
		$this -> register_post_type($name, $singluar_name, $args);
	}

	//Registering Post Types
	public function register_post_type($name, $singluar_name, $args){

	    $args = array_merge(
			array(
				'labels' => array(
							'name' 			=> $name,
							'singular_name' => $singluar_name,
							'add_new'		=> "Add New $singluar_name",
							'add_new_item' 	=> "Add New $singluar_name",
							'edit_item' 	=> "Edit $singluar_name",
							'new_item' 		=> "New $singluar_name",
							'view_item' 	=> "View $singluar_name",
							'search_items' 	=> "Search $name",
							'not_found' 	=> "No $name found",
							'all_items' => "All $name",
							'not_found_in_trash' 	=> "No $name found in Trash",
							'parent_item_colon' 	=> '',
							'menu_name' 	=>  $name
						  ),
				'public' 	=> true,
				'query_var' => strtolower($singluar_name),
				'hierarchical' => true,
				'rewrite' 	=> array('slug' => $name),
				'menu_icon' =>	admin_url().'images/media-button-video.gif',
            //	'supports' 	=> array('title','editor')
				'supports' 	=> array('')

			),
			$args
	    );

		register_post_type(strtolower($name),$args);
	}

	//Taxonomies
	public function taxonomies($post_types, $tax_arr){

		$taxonomies = array();

		foreach ($tax_arr as $name => $arr){

			$singular_name = $arr['singular_name'];

			$labels = array(
					'name' => $name,
					'singular_name' => $singular_name,
					'add_new' => "Add New $singular_name",
					'add_new_item' => "Add New $singular_name",
					'edit_item' => "Edit $singular_name",
					'new_item' => "New $singular_name",
					'view_item' => "View $singular_name",
					'update_item' => "Update $singular_name",
					'search_items' => "Search $name",
					'not_found' => "$name Not Found",
					'not_found_trash' => "$name Not Found in Trash",
					'all_items' => "All $name",
					'separate_items_with_comments' => "Separate tags with commas"
			);

			$defaultArr = array(
				'hierarchical' => true,
				'query_var' => true,
				'rewrite' => array('slug' => $name),
				'labels' => $labels
			);

			$taxonomies[$name] =  array_merge($defaultArr, $arr);
		}

		$this -> register_all_taxonomies($post_types, $taxonomies);
	}

	public function register_all_taxonomies($post_types, $taxonomies){
		foreach($taxonomies as $name => $arr){
			register_taxonomy(strtolower($name),strtolower($post_types), $arr);
		}
	}
}

function init_post_type(){

    $result_arr = array('supports' => array(''),);
    $result = new post_type('Result', 'result', $result_arr);
    $calendar_arr = array('supports' => array(''),);
    $Calendar = new post_type('Calendar', 'calendar', $calendar_arr);
	$dreamr_arr = array('supports' => array(''),);
	$dream = new post_type('Dream', 'dream', $dreamr_arr);
	$dreamr_arr = array('supports' => array(''),);
    $dream = new post_type('common', 'common', $dreamr_arr);
}

add_action('init', 'init_post_type');

add_filter( 'manage_calendar_posts_columns', 'set_custom_edit_calendar_columns' );
add_action( 'manage_calendar_posts_custom_column' , 'custom_calendar_column', 10, 2 );

function set_custom_edit_calendar_columns($columns) {
	unset( $columns['title'] );
	$columns['open_calendar'] = __( 'Open Date', '' );
    return $columns;
}

function custom_calendar_column( $column, $post_id ) {
    switch ( $column ) {
        case 'open_calendar' :
        	 echo get_post_meta( $post_id ,'open_calendar' ,true );
        	 break;
    }
}

add_filter( 'manage_common_posts_columns', 'set_custom_edit_common_columns' );
add_action( 'manage_common_posts_custom_column' , 'custom_common_column', 10, 2 );

function set_custom_edit_common_columns($columns) {
    unset( $columns['title'] );
	$columns['common_direct_meta'] = __( 'Direct', '' );
	$columns['common_house_meta'] = __( 'House', '' );
	$columns['common_ending_meta'] = __( 'Ending', '' );
    return $columns;
}

function custom_common_column( $column, $post_id ) {
    switch ( $column ) {
        case 'common_direct_meta' :
        	 echo get_post_meta( $post_id ,'common_direct_meta' ,true );
        	 break;
        case 'common_house_meta' :
           echo get_post_meta( $post_id , 'common_house_meta' , true );
			break;
		case 'common_ending_meta' :
			echo get_post_meta( $post_id ,'common_ending_meta' ,true );
		break;
    }
}

add_filter( 'manage_result_posts_columns', 'set_custom_edit_result_columns' );
add_action( 'manage_result_posts_custom_column' , 'custom_result_column', 10, 2 );

function set_custom_edit_result_columns($columns) {
    unset( $columns['title'] );
    $columns['result_city_meta'] = __( 'City', '' );
	$columns['result_date_meta'] = __( 'Date', '' );
	$columns['result_fr_meta'] = __( 'FR', '' );
	$columns['result_sr_meta'] = __( 'SR', '' );
    return $columns;
}

function custom_result_column( $column, $post_id ) {
    switch ( $column ) {

        case 'result_city_meta' :
        	 echo get_post_meta( $post_id ,'result_city_meta' ,true );
        	 break;
        case 'result_date_meta' :
           echo get_post_meta( $post_id , 'result_date_meta' , true );
			break;

		case 'result_fr_meta' :
			echo get_post_meta( $post_id ,'result_fr_meta' ,true );
		break;
	   case 'result_sr_meta' :
		  echo get_post_meta( $post_id , 'result_sr_meta' , true );
		break;

    }
}

add_filter( 'manage_dream_posts_columns', 'set_custom_edit_dream_columns' );
add_action( 'manage_dream_posts_custom_column' , 'custom_dream_column', 10, 2 );

function set_custom_edit_dream_columns($columns) {
    unset( $columns['title'] );
    $columns['dream_meta'] = __( 'Dream', '' );
	$columns['direct_meta'] = __( 'Direct', '' );
	$columns['house_meta'] = __( 'House', '' );
	$columns['ending_meta'] = __( 'Ending', '' );
    return $columns;
}

function custom_dream_column( $column, $post_id ) {
    switch ( $column ) {

        case 'dream_meta' :
        	 echo get_post_meta( $post_id ,'dream_meta' ,true );
        	 break;
        case 'direct_meta' :
           echo get_post_meta( $post_id , 'direct_meta' , true );
			break;
		case 'house_meta' :
			echo get_post_meta( $post_id ,'house_meta' ,true );
		break;
	   case 'ending_meta' :
		  echo get_post_meta( $post_id , 'ending_meta' , true );
		break;

    }
}

add_action( 'admin_init', 'add_meta_boxes' );

function add_meta_boxes() {
	add_meta_box('result_metabox','Result Information','result_field','result');
	add_meta_box('dream_metabox','Dream Information','dream_field','dream');
	add_meta_box('common_metabox','Common Information','common_field','common');
	add_meta_box('calendar_metabox','Calendar Information','calendar_field','calendar');
}

function calendar_field(){
	global $post;
    $open_calendar=get_post_meta($post->ID, 'open_calendar',true);
?>
	<table class="form-table">
		<tbody>
			<tr>
				<td>
    				<label for=""> Open Date</label>
    				<input type="text" name="open_calendar" id="datepicker" class="datepicker" value="<?php echo $open_calendar;?>">
    			</td>
    		</tr>
    	</tbody>
    </table>
 <?php
}


function common_field(){
	global $post;
	$common_direct_meta = get_post_meta($post->ID, 'common_direct_meta',true);
	$common_house_meta  = get_post_meta($post->ID, 'common_house_meta', true);
	$common_ending_meta = get_post_meta($post->ID, 'common_ending_meta', true);
?>
	<table class="form-table">
		<tbody>
			<tr>
				<td> <label for="" class="common_label"> DIRECT</label> </td>
    			<td>
    				<input type="text" class="common_text" name="common_direct_meta" id="" value="<?php echo $common_direct_meta;?>">
    			</td>
    		</tr>

    		<tr>
				<td> <label for="" class="common_label"> HOUSE</label> </td>
    			<td> <input type="text" class="common_text" name="common_house_meta" id="" value="<?php echo $common_house_meta;?>"> </td>
    		</tr>

    		<tr>
				<td> <label for="" class="common_label"> ENDING</label> </td>
    			<td> <input type="text" class="common_text" name="common_ending_meta" id="" value="<?php echo $common_ending_meta;?>"> </td>
    		</tr>
    	</tbody>
    </table>
 <?php
}


function result_field(){

	global $post;
	$result_city_meta=get_post_meta($post->ID, 'result_city_meta',true);
    $result_date_meta=get_post_meta($post->ID, 'result_date_meta',true);
    $result_fr_meta=get_post_meta($post->ID, 'result_fr_meta',true);
    $result_sr_meta=get_post_meta($post->ID, 'result_sr_meta',true);
?>
		<table class="form-table">
			<tbody>
				<tr>
					<td> <label for="" class="result_label"> City</label> </td>
					<td> <input type="text" name="result_city_meta" class="result_text" id="" value="<?php echo $result_city_meta;?>"> </td>
				</tr>

			    <tr>
			    	<td> <label for="" class="result_label"> Date</label> </td>
			    	<td> <input type="text" name="result_date_meta" class="datepicker" id="datepicker" value="<?php echo $result_date_meta;?>"> </td>
			    </tr>
			    <tr>
    				<td> <label for="" class="result_label"> FR</label> </td>
    				<td>  <input type="text" name="result_fr_meta"  class="result_text" id="" value="<?php echo $result_fr_meta;?>"> </td>
    			</tr>

				<tr>
					<td>  <label for="" class="result_label"> SR</label> </td>
					<td> <input type="text" name="result_sr_meta"  class="result_text" id="" value="<?php echo $result_sr_meta;?>"> </td>
				</tr>
			</tbody>
		</table>
 <?php }


function dream_field(){
	global $post;
	$dream_meta  = get_post_meta($post->ID, 'dream_meta', true);
	$direct_meta = get_post_meta($post->ID, 'direct_meta',true);
	$house_meta  = get_post_meta($post->ID, 'house_meta', true);
	$ending_meta = get_post_meta($post->ID, 'ending_meta', true);
?>
		<table class="form-table">
			<tbody>
				<tr>
					<td>  <label for="" class="dream_label"> Dream</label> </td>
	  				<td> <input type="text" name="dream_meta" id="" class="dream_text" value="<?php echo $dream_meta;?>"> </td>
	  			</tr>

    			<tr>
    				<td>  <label for="" class="dream_label"> DIRECT</label> </td>
    				<td>  <input type="text" name="direct_meta" id="" class="dream_text" value="<?php echo $direct_meta;?>"> </td>
    			</tr>
			    <tr>
			     	<td> <label for="" class="dream_label"> HOUSE</label> </td>
			    	<td> <input type="text" name="house_meta" id="" class="dream_text" value="<?php echo $house_meta;?>"> </td>
			    </tr>

    			<tr>
    				<td> <label for="" class="dream_label"> ENDING</label> </td>
    				<td> <input type="text" name="ending_meta" class="dream_text" id="" value="<?php echo $ending_meta;?>"> </td>
    			</tr>
			</tbody>
		</table>
 <?php }


add_action( 'save_post', 'save_result_field',10, 2 );
add_action( 'save_post', 'save_dream_field',10, 2 );
add_action( 'save_post', 'save_common_field',10, 2 );
add_action( 'save_post', 'save_calendar_field',10, 2 );

function save_result_field($post_id, $post ){
    if ( 'result' != $post->post_type )
        return ;

    if ( isset($_POST['result_city_meta'] ) && isset($_POST['result_date_meta']) && isset( $_POST['result_fr_meta'] ) && isset( $_POST['result_sr_meta'] ) ) {

		$result_city_meta=$_POST['result_city_meta'];
		$result_date_meta=$_POST['result_date_meta'];
		$result_fr_meta=$_POST['result_fr_meta'];
		$result_sr_meta=$_POST['result_sr_meta'];

    	update_post_meta($post->ID, 'result_city_meta', $result_city_meta);
    	update_post_meta($post->ID, 'result_date_meta', $result_date_meta);
    	update_post_meta($post->ID, 'result_fr_meta', $result_fr_meta);
    	update_post_meta($post->ID, 'result_sr_meta', $result_sr_meta);
    }
}

function save_dream_field( $post_id, $post ) {
    if ( 'dream'!= $post->post_type )
        return ;

    if ( isset($_POST['dream_metabox'] ) && isset($_POST['direct_meta']) && isset( $_POST['house_meta'] ) && isset( $_POST['ending_meta'] ) ) {

		$dream_meta  = $_POST['dream_meta'];
		$direct_meta = $_POST['direct_meta'];
		$house_meta  = $_POST['house_meta'];
		$ending_meta = $_POST['ending_meta'];

	    update_post_meta( $post->ID, 'dream_meta', $dream_meta );
	    update_post_meta( $post->ID, 'direct_meta', $direct_meta );
	    update_post_meta( $post->ID, 'house_meta', $house_meta );
	    update_post_meta( $post->ID, 'ending_meta', $ending_meta );
	}
}

function save_common_field($post_id, $post){
    if ('common'!= $post->post_type)
        return ;

    if( isset($_POST['common_direct_meta'] ) && isset($_POST['common_house_meta']) && isset( $_POST['common_ending_meta'] ) ) {
		$common_direct_meta = sanitize_text_field( $_POST['common_direct_meta'] );
		$common_house_meta  = sanitize_text_field( $_POST['common_house_meta'] );
		$common_ending_meta = sanitize_text_field( $_POST['common_ending_meta'] );

    	update_post_meta( $post->ID, 'common_direct_meta', $common_direct_meta );
    	update_post_meta( $post->ID, 'common_house_meta', $common_house_meta );
    	update_post_meta( $post->ID, 'common_ending_meta', $common_ending_meta );
    }
}


function save_calendar_field($post_id, $post){
    if ('calendar'!= $post->post_type)
		return ;

	if( isset( $_POST['common_direct_meta'] ) ) {
		$open_calendar = sanitize_text_field( $_POST['open_calendar'] );
		update_post_meta($post->ID, 'open_calendar', $open_calendar);
	}
}