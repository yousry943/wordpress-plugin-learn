<?php
/**
* Plugin Name: Yousry plugin
* Description: This  is  yousry  Description

**/

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
    'custom plugin',//page  title
    'Custom Plugin', //menu Title
    'manage_options',
    'custom_plugin_page',
    'custom_plugin_yousry_desion'
  );
}

function custom_plugin_yousry_desion(){
 include_once('Design.php');
 php_deion();
}


?>
