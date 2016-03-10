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
 * Function Load
 * Include CSS & JQuery files wp-skyltar-css & ... for widget styling
 *
 * @since 1.0
 */
 function load() {

   #Cascade Styling Sheets
   wp_register_style('style', plugins_url('wp-skyltar-style.css',__FILE__ ));
   wp_enqueue_style('style');

   #JQuery
   //JQuery library include
   wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js');
   wp_enqueue_script('jquery');

   //Widget jQuery script
   wp_register_script('script', plugins_url('wp-skyltar-jquery.js',__FILE__ ), array('jquery'));
   wp_enqueue_script('script');

   //Add variables to array -> Enable usage in jQuery file
   $translation_array = array('templateUrl' => plugins_url('wp-skyltar-widget.php'));
   wp_localize_script('script', 'object', $translation_array);
 }

/**
 * Class o_skyltar_widget -> Extends WP_Widget
 * Start instance when window loads the object and fire __construct.
 *
 * @since 1.0
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
    $red;
    $green;
    $blue;

    #Check instance of title -> Set title to backend title if it exists
    if(isset($instance['title'])){ $title = $instance['title']; }

    #Check instances of colors -> Set percentages if they exist
    if (isset($instance['red'])) { $red = $instance['red'];}
    if (isset($instance['green'])) { $green = $instance['green'];}
    if (isset($instance['blue'])) { $blue = $instance['blue'];}

    #Backend input fields

    //Title
    echo '<p><b><label for="' .$this->get_field_id('title'). '">Titel:</label></b><br>';
    echo '<input type="text" value="' .$title. '" name="' .$this->get_field_name('title'). '" id="' .$this->get_field_id('title'). '"></p>';

    //Color percentages
    echo '<p><b><label>Färg förändringsfaktor (procent):</label></b><br>';

    //Red
    echo '<label for="' .$this->get_field_id('red'). '">Röd: </label>';
    echo '<input type="text" value="' .$red. '" name="' .$this->get_field_name('red'). '" id="' .$this->get_field_id('red'). '"><br>';

    //Green
    echo '<label for="' .$this->get_field_id('green'). '">Grön: </label>';
    echo '<input type="text" value="' .$green. '" name="' .$this->get_field_name('green'). '" id="' .$this->get_field_id('green'). '"><br>';

    //Blue
    echo '<label for="' .$this->get_field_id('blue'). '">Blå: </label>';
    echo '<input type="text" value="' .$blue. '" name="' .$this->get_field_name('blue'). '" id="' .$this->get_field_id('blue'). '"></p><br>';

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
    $instance['red'] = $new_instance['red'];
    $instance['green'] = $new_instance['green'];
    $instance['blue'] = $new_instance['blue'];

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

        #Input Letter Height
        echo '<br>Bokstavshöjd i millimeter';
        echo '<br><input type="text" placeholder="0 millimeter" maxlength="40" autocapitalize="off" autocorrect="off" spellcheck="false" autocomplete="off" class="sk-letter-height">';

        #Input Colors & Distance
        echo "<br><br>Läsbar till avståndet";
        echo '<br><input type="text" placeholder="0 meter" maxlength="40" autocapitalize="off" autocorrect="off" spellcheck="false" autocomplete="off" name="sk" class="sk-red">';
        echo '<br><input type="text" placeholder="0 meter" maxlength="40" autocapitalize="off" autocorrect="off" spellcheck="false" autocomplete="off" name="sk" class="sk-green">';
        echo '<br><input type="text" placeholder="0 meter" maxlength="40" autocapitalize="off" autocorrect="off" spellcheck="false" autocomplete="off" name="sk" class="sk-blue">';

      echo '</div>'; //End widget wrapper

      echo $args['after_widget']; //End widget
  }

}

//Add action on load of page, initiate function register_widget
add_action('widgets_init', function() {
  register_widget('o_skyltar_widget');
});

//Add action on load of page, initiate function load
add_action('widgets_init', 'load');


?>
