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
    $subtitle = '';
    $red;
    $green;
    $blue;
    $yellow;
    $white;

    #Check instance of title -> Set title to backend title if it exists
    if(isset($instance['title'])){ $title = $instance['title']; }

    #Check instance of subtitle -> Set subtitle to backend title if it exists
    if(isset($instance['subtitle'])){ $subtitle = $instance['subtitle']; }

    #Check instances of colors -> Set percentages if they exist
    if (isset($instance['red'])) { $red = $instance['red'];}
    if (isset($instance['green'])) { $green = $instance['green'];}
    if (isset($instance['blue'])) { $blue = $instance['blue'];}
    if (isset($instance['yellow'])) { $yellow = $instance['yellow'];}
    if (isset($instance['white'])) { $white = $instance['white'];}

    #Backend input fields

    //Title
    echo '<p><b><label for="' .$this->get_field_id('title'). '">Titel:</label></b><br>';
    echo '<input type="text" value="' .$title. '" name="' .$this->get_field_name('title'). '" id="' .$this->get_field_id('title'). '"></p>';

    //Sub Title
    echo '<p><b><label for="' .$this->get_field_id('subtitle'). '">Färgrubrik:</label></b><br>';
    echo '<input type="text" value="' .$subtitle. '" name="' .$this->get_field_name('subtitle'). '" id="' .$this->get_field_id('subtitle'). '"></p>';

    //Color percentages
    echo '<p><b><label>Färgernas förändringsfaktor (procent):</label></b><br>';

    //Red
    echo '<label for="' .$this->get_field_id('red'). '">Röd: </label>';
    echo '<input type="text" value="' .$red. '" name="' .$this->get_field_name('red'). '" class="red" id="' .$this->get_field_id('red'). '"><message class="ms_red"></message><br>';

    //Green
    echo '<label for="' .$this->get_field_id('green'). '">Grön: </label>';
    echo '<input type="text" value="' .$green. '" name="' .$this->get_field_name('green'). '" class="green" id="' .$this->get_field_id('green'). '"><message class="ms_green"></message><br>';

    //Blue
    echo '<label for="' .$this->get_field_id('blue'). '">Blå: </label>';
    echo '<input type="text" value="' .$blue. '" name="' .$this->get_field_name('blue'). '" class="blue" id="' .$this->get_field_id('blue'). '"><message class="ms_blue"></message><br>';

    //Yellow
    echo '<label for="' .$this->get_field_id('yellow'). '">Gul: </label>';
    echo '<input type="text" value="' .$yellow. '" name="' .$this->get_field_name('yellow'). '" class="yellow" id="' .$this->get_field_id('yellow'). '"><message class="ms_yellow"></message><br>';

    //White
    echo '<label for="' .$this->get_field_id('white'). '">Vit: </label>';
    echo '<input type="text" value="' .$white. '" name="' .$this->get_field_name('white'). '" class="white" id="' .$this->get_field_id('white'). '"><message class="ms_white"></message></p><br>';

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
    $instance['subtitle'] = $new_instance['subtitle'];
    $instance['red'] = $new_instance['red'];
    $instance['green'] = $new_instance['green'];
    $instance['blue'] = $new_instance['blue'];
    $instance['yellow'] = $new_instance['yellow'];
    $instance['white'] = $new_instance['white'];

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
        echo $args['before_title']. "<h3>" .$instance['title']. "</h3>" .$args['after_title'];

        #Input Letter Height
        #echo '<br>Bokstavshöjd i millimeter';
        echo '<br><input type="text" placeholder="Bokstavshöjd i millimeter" maxlength="5" autocapitalize="off" autocorrect="off" spellcheck="false" autocomplete="off" class="sk-letter-height">
        <input type="text" placeholder="Avstånd i meter" maxlength="4" autocapitalize="off" autocorrect="off" spellcheck="false" autocomplete="off" class="sk-view-distance">';


        #Input Colors & Distance
        echo "<br><br>" .$instance['subtitle'] ;
        echo '<br><div type="text" data-percentage="' .$instance['red']. '" name="sk" class="sk-red same"><h5>0.00 meter</h5></div>';
        echo '<br><div type="text" data-percentage="' .$instance['green']. '" name="sk" class="sk-green same"><h5>0.00 meter</h5></div>';
        echo '<br><div type="text" data-percentage="' .$instance['blue']. '" name="sk" class="sk-blue same"><h5>0.00 meter</h5></div>';
        echo '<br><div type="text" data-percentage="' .$instance['yellow']. '" name="sk" class="sk-yellow same"><h5>0.00 meter</h5></div>';
        echo '<br><div type="text" data-percentage="' .$instance['white']. '" name="sk" class="sk-white same"><h5>0.00 meter</h5></div>';

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
