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
 */
class o_skyltar_widget extends WP_Widget {

  function __construct() {
    parent::__construct(false, $name = __('WP Skyltar Widget'));
  }

  function form() {

  }

  function update() {

  }

  function widget($args, $instance) {

  }

}

add_action('widgets_init', function() {
  register_widget('o_skyltar_widget');
});


?>
