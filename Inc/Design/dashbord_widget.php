<?php
namespace Inc\Design;
/**
 *
 */
class dashbord_widget
{

public function register()
    {
      add_action('wp_dashboard_setup',  array($this, 'yousry_dashbord_widget') );
    }

  public  function yousry_dashbord_widget() {
        wp_add_dashboard_widget(
           'admin_dashboard_widget',
           'Admin Dashboard Widget Title',
            'admin_dashboard_widget_callback'
           );
    }

    function admin_dashboard_widget_callback()
    {
      echo  "yousry widgit ";
    }

}

 ?>
