<?php
 
// Create Custom Post Type
     
    function register_Header_Slides_posttype() {
        $labels = array(
            'name'              => _x( 'Header_Slides', 'post type general name' ),
            'singular_name'     => _x( 'Header_Slide', 'post type singular name' ),
            'add_new'           => __( 'Add New Header_Slide' ),
            'add_new_item'      => __( 'Add New Header_Slide' ),
            'edit_item'         => __( 'Edit Header_Slide' ),
            'new_item'          => __( 'New Header_Slide' ),
            'view_item'         => __( 'View Header_Slide' ),
            'search_items'      => __( 'Search Header_Slides' ),
            'not_found'         => __( 'Header_Slide' ),
            'not_found_in_trash'=> __( 'Header_Slide' ),
            'parent_item_colon' => __( 'Header_Slide' ),
            'menu_name'         => __( 'Header_Slides' )
        );
 
        $taxonomies = array();
 
        $supports = array('title','thumbnail');
 
        $post_type_args = array(
            'labels'            => $labels,
            'singular_label'    => __('Header_Slide'),
            'public'            => true,
            'show_ui'           => true,
            'publicly_queryable'=> true,
            'query_var'         => true,
            'capability_type'   => 'post',
            'has_archive'       => false,
            'hierarchical'      => false,
            'rewrite'           => array( 'slug' => 'Header_Slides', 'with_front' => false ),
            'supports'          => $supports,
            'menu_position'     => 27, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
            'menu_icon'         => get_template_directory_uri() . '/inc/Header_Slider/images/icon.png',
            'taxonomies'        => $taxonomies
        );
        register_post_type('Header_Slides',$post_type_args);
    }
	
    add_action('init', 'register_Header_Slides_posttype'); 
	
	
	// Meta Box for Header_Slider URL
     
    $Header_Slidelink_2_metabox = array( 
        'id' => 'Header_Slidelink',
        'title' => 'Header_Slide Link',
        'page' => array('Header_Slides'),
        'context' => 'normal',
        'priority' => 'default',
        'fields' => array(
     
                     
                    array(
                        'name'          => 'Header_Slide URL',
                        'desc'          => '',
                        'id'                => 'wptuts_Header_Slideurl',
                        'class'             => 'wptuts_Header_Slideurl',
                        'type'          => 'text',
                        'rich_editor'   => 0,            
                        'max'           => 0             
                    ),
                    )
    );          
                 
    add_action('admin_menu', 'wptuts_add_Header_Slidelink_2_meta_box');
    function wptuts_add_Header_Slidelink_2_meta_box() {
     
        global $Header_Slidelink_2_metabox;        
     
        foreach($Header_Slidelink_2_metabox['page'] as $page) {
            add_meta_box($Header_Slidelink_2_metabox['id'], $Header_Slidelink_2_metabox['title'], 'wptuts_show_Header_Slidelink_2_box', $page, 'normal', 'default', $Header_Slidelink_2_metabox);
        }
    }
     
    // function to show meta boxes
    function wptuts_show_Header_Slidelink_2_box()  {
        global $post;
        global $Header_Slidelink_2_metabox;
        global $wptuts_prefix;
        global $wp_version;
         
        // Use nonce for verification
        echo '<input type="hidden" name="wptuts_Header_Slidelink_2_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
         
        echo '<table class="form-table">';
     
        foreach ($Header_Slidelink_2_metabox['fields'] as $field) {
            // get current post meta data
     
            $meta = get_post_meta($post->ID, $field['id'], true);
             
            echo '<tr>',
                    '<th style="width:20%"><label for="', $field['id'], '">', stripslashes($field['name']), '</label></th>',
                    '<td class="wptuts_field_type_' . str_replace(' ', '_', $field['type']) . '">';
            switch ($field['type']) {
                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', stripslashes($field['desc']);
                    break;
            }
            echo    '<td>',
                '</tr>';
        }
         
        echo '</table>';
    }   
     
    // Save data from meta box
    add_action('save_post', 'wptuts_Header_Slidelink_2_save');
    function wptuts_Header_Slidelink_2_save($post_id) {
        global $post;
        global $Header_Slidelink_2_metabox;
         
        // verify nonce
        if (!wp_verify_nonce($_POST['wptuts_Header_Slidelink_2_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
     
        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
     
        // check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
         
        foreach ($Header_Slidelink_2_metabox['fields'] as $field) {
         
            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];
             
            if ($new && $new != $old) {
                if($field['type'] == 'date') {
                    $new = wptuts_format_date($new);
                    update_post_meta($post_id, $field['id'], $new);
                } else {
                    if(is_string($new)) {
                        $new = $new;
                    } 
                    update_post_meta($post_id, $field['id'], $new);
                     
                     
                }
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }