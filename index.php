<?php
/**
* Plugin Name: Yousry plugin
* Description: This  is  yousry  Description

**/

if (file_exists( dirname(__FILE__) . '/vendor/autoload.php' )) {
   require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Inc\Activate;

$Activate = new Activate();
$Activate->create_table_yousryPlugin();

define('PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

if ( class_exists('Inc\\Init' ) ) {

Inc\Init::register_services();

}

//Call function  when you active  plugin
register_activation_hook( __FILE__, array($Activate,'create_table_yousryPlugin') );

function  set_html_content_type()
{
  return  'text/html';
}
//to  add  a shortcout  in  any post
function yousry_example_function()
{
   $content = '<form method="post"  ';

     $content.= ' ';
     $content.= '<br>';

       $content.= 'First Name :<input type="text" name="fname" placeholder="your first name  "/> ';
       $content.= '<br>';
       $content.= '<br>';
       $content.= ' Last Name : <input type="text" name="lname" placeholder="your last name  "/> ';
       $content.= '<br>';
       $content.= '<br>';
       $content.= ' Email : <input type="text" name="email" placeholder="Email"/> ';
       $content.= '<br>';
       $content.= '<br>';
       $content.= '<input type="submit" name="send" value="save"/> ';
   $content.= "</form>";
   return $content;
}
add_shortcode('example','yousry_example_function');

function yousry_form_capture()
{
  global  $post,$wpdb;

if (isset($_POST['fname'])) {
  // code...

    $to = "ayousry943@gmail.com";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $subject = "this is  yousry  test ";
    $body = "my  yousry  body  ";
    $body.= "first name : ".$_POST['fname']."</br>";
    $body.= "last name: ".$_POST['lname']."</br>";
    $body.= "email: ".$_POST['email']."</br>";
    add_filter('wp_mail_content_type','set_html_content_type');
        wp_mail($to,$subject,$body);
    remove_filter('wp_mail_content_type','set_html_content_type');
    /*insert  data unto  commet */
    $time = current_time('mysql');

           $data = array(
               'comment_post_ID' => $post->ID,
               'comment_author' => 'admin',
               'comment_author_email' => 'admin@admin.com',
               'comment_author_url' => 'http://www.google.com',
               'comment_content' => 'class  yousry contact ',
               'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
               'user_id' => 1,
               'comment_date' => $time,
               'comment_approved' => 1,
               'comment_type' => 'custom-comment-class'
           );
           // insert  data  as  comment
         wp_insert_comment($data);

// insert  data  as  database table
          $insertData = $wpdb->get_results("INSERT INTO wp_yousry_plugin_email (email_to,fname,lname,subject,email_time) VALUES ('$to','$fname','$lname','$subject', '$time')"  );



}

}
add_action('wp_head','yousry_form_capture');



function yousry_dashbord_widget() {
    wp_add_dashboard_widget(
       'admin_dashboard_widget',
       'Admin Dashboard Widget Title',
        'admin_dashboard_widget_callback'
       );
}

add_action( 'wp_dashboard_setup', 'yousry_dashbord_widget' );


function admin_dashboard_widget_callback()
{
  echo  "yousry widgit ";
}






add_action( 'admin_menu', 'custom_yousry_plugin_show_in_nav' );


function custom_yousry_plugin_show_in_nav()
{
  add_menu_page(
    'custom plugin yousry',//page  title
    'Custom Plugin yousry', //menu Title
    'manage_options',
    'my-top-level-handle', // name of submenu
    'custom_plugin_yousry_desion' //call back function
  );

  add_submenu_page( 'my-top-level-handle', 'Page title', 'Sub-menu title', 'manage_options', 'my-submenu-handle', 'custom_plugin_yousry_desion');
  add_submenu_page( 'my-top-level-handle', 'yousry title', 'yousry title', 'manage_options', 'my-submenu-handle', 'custom_plugin_yousry_desion');



}

function custom_plugin_yousry_desion(){
//run  sql  SELECT queary

 include_once('Design.php');
 php_deion();
}



//add style  Sheets
add_action('admin_enqueue_scripts','add_yousry_style');
function add_yousry_style()
{
  wp_enqueue_style('cover_stylesheet',plugins_url('assets/css/style.css',__FILE__));
}


// //add style  scripts

add_action( 'admin_enqueue_scripts', 'my_plugin_assets' );
function my_plugin_assets() {
    // wp_enqueue_style( 'custom-gallery', plugins_url( '/css/gallery.css' , __FILE__ ) );
    wp_enqueue_script( 'custom-gallery', plugins_url( 'assets/js/scripts.js' , __FILE__ ) );
}


// Create Table for Your  Plugin

// function  create_table_yousryPlugin()
// {
//         global $wpdb;
//          $table_name = $wpdb->prefix . "table_yousryPlugin";
//
//       $charset_collate = $wpdb->get_charset_collate();
//
//       $sql = "CREATE TABLE IF NOT EXISTS $table_name (
//         id mediumint(9) NOT NULL AUTO_INCREMENT,
//         time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
//         name tinytext NOT NULL,
//         text text NOT NULL,
//         url varchar(55) DEFAULT '' NOT NULL,
//         PRIMARY KEY  (id)
//       ) $charset_collate;";
//
//       require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//       dbDelta( $sql );
//
//
// }
//
// //Call function  when you active  plugin
// register_activation_hook( __FILE__, 'create_table_yousryPlugin' );


// select queary
function  select_plugin_yousry()
{
  global $wpdb;
  $db_results = $wpdb->get_results(
    $wpdb->prepare(
      "SELECT * from wp_posts order by ID limit 5",''
      )
  );
  echo "<pre>", print_r($db_results); echo "</pre>";
}


// delete  quary
function delete_plugin_yousry()
{
   global  $wpdb;
   $wpdb->delete(
     "wp_custom_plugin",
     array(
       "id"=>5
     )
   );
}


?>
