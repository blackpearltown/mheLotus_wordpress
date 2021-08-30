<?php
/**
  * @ Thiết lập các hằng dữ liệu quan trọng
  * @ THEME_URL = get_stylesheet_directory() – đường dẫn tới thư mục theme
  * @ CORE = thư mục /core của theme, chứa các file nguồn quan trọng.
  **/
  define( 'THEME_URL', get_stylesheet_directory() );
  define( 'CORE', THEME_URL . '/core' );
  
  if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.0' );
  }

/**
  * @ Load file /core/init.php
  * @ Đây là file cấu hình ban đầu của theme mà sẽ không nên được thay đổi sau này.
  **/


  require_once( CORE . '/init.php' );


 /**
  * @ Thiết lập $content_width để khai báo kích thước chiều rộng của nội dung
  **/
  if ( ! isset( $content_width ) ) {
  	/*
  	 * Nếu biến $content_width chưa có dữ liệu thì gán giá trị cho nó
  	 */
  	$content_width = 1200;
   }


/**
  * @ Thiết lập các chức năng sẽ được theme hỗ trợ
  **/
if ( ! function_exists( 'mhe_theme_setup' ) ) {
  	/*
  	 * Nếu chưa có hàm mhe_theme_setup() thì sẽ tạo mới hàm đó
  	 */
  	function mhe_theme_setup() {
  		/*
  		 * Thiết lập theme có thể dịch được
  		 */
  		$language_folder = THEME_URL . '/languages';
  		load_theme_textdomain( 'mheLotus', $language_folder );


        /*
  		 * Thêm CSS, JS
  		 */
        wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime(), 'all');
        wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css');
        wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

        wp_enqueue_script('script', get_theme_file_uri('./JS/script.js'), NULL, microtime(), true);
        wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', NULL, microtime(), true);
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', NULL, microtime(), true);
        wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', NULL, microtime(), true);
        wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', NULL, microtime(), true);
        



  		/*
  		 * Thêm chức năng title-tag để tự thêm <title>
  		 */
  		add_theme_support( 'title-tag' );

  		/*
  		 * Thêm chức năng post format
  		 */
  		add_theme_support( 'post-formats',
  			array(
  				'video',
  				'image',
  				'audio',
  				'gallery'
  			)
  		 );

        /*
         * Tạo menu cho theme
         */
        register_nav_menu ( 'primary-menu', __('Main Menu', 'mhe') );


  	}
  	add_action ( 'init', 'mhe_theme_setup' );
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mhelotus_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'mhelotus' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mhelotus' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mhelotus_widgets_init' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Load Block * Admin
 */

add_theme_support( 'block-discovery' );
function custom_discovery_post_type()
{
    $label = array(
        'name' => 'Discovery home',
        'discovery' => 'discovery'
    );
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Post type Discovery', //Mô tả của post type
        'supports' => array(
            'title',
        ), //Các tính năng được hỗ trợ trong post type
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, false thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 11, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-format-image', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => true, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );
    register_post_type('block-discovery', $args);
}

add_action('init', 'custom_discovery_post_type');

/**
 * Custom Field Function Block Discovery Admin
 */

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_612c61942f1a4',
		'title' => 'Discovery Home',
		'fields' => array(
			array(
				'key' => 'field_612c61aa54bea',
				'label' => 'Tiêu đề',
				'name' => 'title_discovery',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'invisible' => 0,
				'only_front' => 0,
				'hide_admin' => 0,
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 0,
				'delay' => 0,
			),
			array(
				'key' => 'field_612c61f154beb',
				'label' => 'Mô tả',
				'name' => 'desc_discovery',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'invisible' => 0,
				'only_front' => 0,
				'hide_admin' => 0,
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 0,
				'delay' => 0,
			),
			array(
				'key' => 'field_612c621354bec',
				'label' => 'Button',
				'name' => 'button_discovery',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'invisible' => 0,
				'only_front' => 0,
				'hide_admin' => 0,
				'default_value' => '',
				'tabs' => 'text',
				'media_upload' => 0,
				'toolbar' => 'full',
				'delay' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'block-discovery',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'left',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'acfe_display_title' => '',
		'acfe_autosync' => array(
			0 => 'php',
		),
		'acfe_form' => 0,
		'acfe_meta' => '',
		'acfe_note' => '',
	));
	
	endif;
/**
 * Load Block About Admin
 */

add_theme_support( 'block-about' );
function custom_about_post_type()
{
    $label = array(
        'name' => 'About home',
        'about' => 'about'
    );
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Post type About', //Mô tả của post type
        'supports' => array(
            'title',
        ), //Các tính năng được hỗ trợ trong post type
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, false thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 11, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-format-image', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => true, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );
    register_post_type('block-about', $args);
}

add_action('init', 'custom_about_post_type');

/**
 * Custom Field Function Block About Admin
 */

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_612c66122a53c',
		'title' => 'About Home',
		'fields' => array(
			array(
				'key' => 'field_612c662150333',
				'label' => 'Mô tả về chúng tôi',
				'name' => 'desc_about',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'invisible' => 0,
				'only_front' => 0,
				'hide_admin' => 0,
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 0,
				'delay' => 0,
			),
			array(
				'key' => 'field_612c664950334',
				'label' => 'Button',
				'name' => 'button_about',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'invisible' => 0,
				'only_front' => 0,
				'hide_admin' => 0,
				'default_value' => '',
				'tabs' => 'text',
				'media_upload' => 0,
				'toolbar' => 'full',
				'delay' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'block-about',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'left',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'acfe_display_title' => '',
		'acfe_autosync' => '',
		'acfe_form' => 0,
		'acfe_meta' => '',
		'acfe_note' => '',
	));
	
	endif;
