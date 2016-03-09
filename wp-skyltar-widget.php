<?php
/*
Plugin Name: WP Skyltar Widget
Plugin URI: http://focusneon.se/
Description: Block som använder variablerna bokstavshöjd, färg och läsbarhet för kalkylering mellan dessa.
Version: 1.0
Author: Emil Olsson (GREY-Studio)
License: MIT
*/

/**
 * Class o_skyltar_widget -> Extends WP_Widget
 * Start instance when window loads the object and fire __construct.
 *
 * @since 1.0
 *
 */
class o_skyltar_widget extends WP_Widget {

  //Constructor
  function __construct() {
    parent::__construct(false, $name = __('WP Skyltar Widget'));
  }

  /**
  * Function Form
  * Displays & builds the widget's backend options.
  *
  * @since 1.0
  * @param $instance Instances
  */
  function form($instance) {

    #Variables
    $title = '';

    #Check instance of title -> Set title to backend title if it exists
    if(isset($instance['title'])){
      $title = $instance['title'];
    }

    #Backend input fields
    echo '<p><label for="' .$this->get_field_id('title'). '">Titel:</label><br>';
    echo '<input type="text" value="' .$title. '" name="' .$this->get_field_name('title'). '" id="' .$this->get_field_id('title'). '"></p>';

  }

  /**
  * Function Update
  * Updates the current information & values with the new ones.
  *
  * @since 1.0
  * @param $new_instance New instances
  * @param $old_instance Old instances
  */
  function update($new_instance, $old_instance) {

    #Set instances to the updated ones
    $instance['title'] = $new_instance['title'];

    #Return updated instances
    return $instance;
  }

  /**
  * Function Widget
  * Displays & builds the widget's fontend.
  *
  * @since 1.0
  * @param $args Arguments
  * @param $instance Instaces
  */
  function widget($args, $instance) {
      echo $args['before_widget']; //Start widget

      #Widget Wrapper
      echo '<div class="widget wp-skyltar-widget">';

        #Title
        echo $args['before_title'] .$instance['title']. $args['after_title'];



      echo '</div>'; //End widget wrapper

      echo $args['after_widget']; //End widget
  }

}

//Add action on load of page, initiate function register_widget
add_action('widgets_init', function() {
  register_widget('o_skyltar_widget');
});


?>
