<?php
/**
 * Plugin Name: Decagon Todo List
 * Plugin URI: https://adeleyeayodeji.com/
 * Author: Adeleye Ayodeji
 * Author URI: https://adeleyeayodeji.com/
 * Description: A simple todo list plugin
 * Version: 0.1.0
 * License: 0.1.0
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: decagon-todo
*/

//add security

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class DecagonTodo 
{
    public function init()
    {
        //run fuction when plugin is ready
        add_action( 'plugins_loaded', array( $this, 'add_todo_shortcode' ) );
         //add ajax
        add_action( 'wp_ajax_decagon_todo_add_todo', array( $this, 'decagon_todo_add_todo' ) );
        add_action( 'wp_ajax_nopriv_decagon_todo_add_todo', array( $this, 'decagon_todo_add_todo' ) );
        //register post type
        add_action( 'init', array( $this, 'register_post_type' ) );
        //add meta box
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        //on post saved
        add_action('save_post', array( $this, 'save_metabox' ), 1, 2);
        //add status and duedate column to admin table view
        add_filter( 'manage_edit-decagon_todo_columns', array( $this, 'add_columns' ) );
        //update column
        add_filter( 'manage_decagon_todo_posts_custom_column', array( $this, 'update_columns' ) ,10, 2);
        //remove admin table quick actions
        add_filter( 'post_row_actions', array( $this, 'remove_quick_actions' ), 10, 2 );
        //test filter
        add_filter( 'decagon_todo_insert_post', array( $this, 'decagon_todo_insert_post_test' ), 10, 1 );
    }

    public function remove_quick_actions( $actions, $post )
    {
        if( $post->post_type == 'decagon_todo' )
        {
            unset( $actions['view'] );
            unset( $actions['trash'] );
            unset( $actions['inline hide-if-no-js'] );
        }
        return $actions;
    }

    public function add_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Title' ),
            'status' => __( 'Status' ),
            'duedate' => __( 'Due Date' ),
            'date' => __( 'Ceated Date' )
        );
        return $columns;
    }

    public function update_columns($column, $post_id)
    {
        switch ($column) {
            case 'status':
                $status = get_post_meta( $post_id, '_decagon_todo_status', true );
                echo esc_html($status);
                break;
            case 'duedate':
                $duedate = get_post_meta( $post_id, '_decagon_todo_duedate', true );
                //convert date to human readable
                if(strpos($duedate, '-'))
                {
                    $date = date("d/m/Y", strtotime($duedate));
                }
                else
                {
                    $date = $duedate;
                }
                echo esc_html($date);
                break;
            default:
                break;
        }
    }

    public function save_metabox( $post_id, $post ) {
        // Add nonce for security and authentication.
        if ( ! wp_verify_nonce( $_POST['security'], 'decagon_addtodo' ) ) {
            return $post_id;
        }
 
        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        //update post meta
        $duedate = sanitize_text_field( $_POST['duedate'] );
        //format date to dd/mm/yyyy
        if(strpos($duedate, '-'))
        {
            $duedate = date("d/m/Y", strtotime($duedate));
        }
        
        $status = sanitize_text_field( $_POST['decagon_status'] );
        //add to array
        $args = array(
            'todo' => $post->post_title,
            'status' => $status,
            'duedate' => $duedate,
        );
        //listen to filter
        $args = apply_filters( 'decagon_todo_insert_post', $args );
        //if post meta is not set
        if ( ! get_post_meta( $post_id, '_decagon_todo_duedate', true ) ) {
            //add meta data to the post
            add_post_meta( $post_id, '_decagon_todo_duedate', $args["duedate"], true );
            update_post_meta( $post_id, '_decagon_todo_status', $args["status"] );
        } else {
            //update meta data
            update_post_meta( $post_id, '_decagon_todo_duedate', $args["duedate"] );
            update_post_meta( $post_id, '_decagon_todo_status', $args["status"] );
        }
        //then update post title
        $post_title = $args["todo"];
        // use raw query to update post title
        global $wpdb;
        $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_title = %s WHERE ID = %d", $post_title, $post_id ) );
    }

    public function add_meta_box()
    {
        add_meta_box(
            'decagon_todo_meta_box',
            'Todo Due Date',
            array( $this, 'render_meta_box' ),
            'decagon_todo',
            'advanced',
            'default'
        );
    }

    public function render_meta_box()
    {
        // Add security nonce
        wp_nonce_field( 'decagon_addtodo', 'security' );
        //get the post id
        global $post;
        //get the meta data _decagon_todo_duedate _decagon_todo_createddate
        $duedate = get_post_meta( $post->ID, '_decagon_todo_duedate', true );
        $createddate = get_post_meta( $post->ID, '_decagon_todo_createddate', true );
        $status = get_post_meta( $post->ID, '_decagon_todo_status', true );
        //include admin page 
        include( plugin_dir_path( __FILE__ ) . 'templates/admin-page.php' );
    } 

    public function register_post_type()
        {
            $labels = array(
                'name' => _x('Decagon Todo', 'decagon-todo'),
                'singular_name' => _x('Decagon Todo', 'decagon-todo'),
                'all_items' => _x('All Decagon Todos', 'decagon-todo'),
                'search_items' => _x('Search Decagon Todos', 'decagon-todo'),
                'not_found' => _x('No Decagon Todos found', 'decagon-todo'),
                'not_found_in_trash' => _x('No Decagon Todos found in Trash', 'decagon-todo'),
                'parent_item_colon' => _x('Parent Decagon Todo:', 'decagon-todo'),
                'menu_name' => _x('Decagon Todo', 'decagon-todo'),
            );

            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'description' => 'Decagon Todo filterable by date',
                'supports' => array('title'),
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 3,
                'menu_icon' => "dashicons-list-view",
                'show_in_nav_menus' => true,
                'publicly_queryable' => true,
                'exclude_from_search' => false,
                'has_archive' => false,
                'query_var' => true,
                'can_export' => true,
                'rewrite' => false,
                'comments' => false,
                'capability_type' => 'post'
            );

            register_post_type('decagon_todo', $args);
        }

    public function add_todo_shortcode()
    {
        //add shortcode
        add_shortcode( 'decagon-todo', array( $this, 'todo_shortcode' ) );
    }

    public function todo_shortcode()
    {
        //add shortcode
        ob_start();
        include_once( 'templates/todo-list.php' );
        return ob_get_clean();
    }

    public function decagon_todo_insert_post_test($args)
    {
        // $args["todo"] = "Update from filter frontend";
        // $args["status"] = "completed";
        // $args["duedate"] = "2020-05-05";
        return $args;
    }

    public function decagon_todo_add_todo()
    {
        header( 'Content-Type: application/json' );
        //verify nonce decagon_addtodo
        if ( ! wp_verify_nonce( $_POST['security'], 'decagon_addtodo' ) ) {
            //json response
            $response = array(
                'status' => 'error',
                'message' => 'Sorry, your nonce did not verify.'
            );
            //return json response
            echo wp_send_json( $response );
            //exit
            die;
        }
        //check type
        if($_POST["type"] == "insert"){
            $todo = sanitize_text_field( $_POST['todo'] );
            //convert string date to mysql date
            $duedate = sanitize_text_field( $_POST['duedate'] );
            $status = sanitize_text_field( $_POST['decagon_status'] );
            //create a new post with post type of decagon_todo
            $args = array(
                'todo' => $todo,
                'status' => $status,
                'duedate' => $duedate,
            );
            //listen to available filter hooks
            $args = apply_filters( 'decagon_todo_insert_post', $args );
            $post_id = wp_insert_post( array(
                'post_title' => $args['todo'],
                'post_type' => 'decagon_todo',
                'post_status' => 'publish',
            ) );
            //add meta data to the post
            add_post_meta( $post_id, '_decagon_todo_duedate', $args['duedate'] );
            add_post_meta( $post_id, '_decagon_todo_status', $args['status'] );
            //return the post id
            if($post_id)
            {
                echo wp_send_json( array(
                    'success' => true,
                    'post_id' => $post_id
                ) );
            }
            else
            {
                echo wp_send_json( array(
                    'success' => false
                ) );
            }
        }elseif($_POST["type"] == "update"){
            $post_id = sanitize_text_field( $_POST['post_id'] );
            $status = sanitize_text_field( $_POST['status'] );
            $args = array(
                'status' => $status
            );
            //listen to available filter hooks
            $args = apply_filters( 'decagon_todo_insert_post', $args );
            //update post meta
            update_post_meta( $post_id, '_decagon_todo_status', $args['status'] );
            //return the post id
            if($post_id)
            {
                echo wp_send_json( array(
                    'success' => true,
                    'post_id' => $post_id,
                    $args
                ) );
            }
            else
            {
                echo wp_send_json( array(
                    'success' => false
                ) );
            }
        }
        wp_die();
    }
}

//init
$decagon_todo = new DecagonTodo();
$decagon_todo->init();