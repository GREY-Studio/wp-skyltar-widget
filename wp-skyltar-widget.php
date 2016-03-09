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

  //Function form
  function form() {

  }

  //Function update
  function update() {

  }

  /**
  * Function widget
  *
  * @param $args Arguments
  * @param $instance Instaces
  */
  function widget($args, $instance) {
    ?>
      <div class="widget wp-skyltar-widget">
        <h2>Title</h2>
      </div>
    <?php
  }

}

//Add action on load of page, initiate function register_widget
add_action('widgets_init', function() {
  register_widget('o_skyltar_widget');
});


?>
