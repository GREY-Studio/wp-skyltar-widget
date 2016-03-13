/**
 * JQuery - wp-skyltar-widget
 *
 * @since 1.0
 */

//IIFE - Immediately Invoked Function Expression
(function($) {

  //The global JQuery object is passed as a parameter
  //The $ is now locally scoped

  //Private variables
  var $input,
      $bk_input,
      $bk_button,
      $sk_lh,
      $sk_red,
      $sk_green,
      $sk_blue,
      $data,
      $path = object.templateUrl;

   //---------------------------------------------
   // Calculations
   //---------------------------------------------

   /**
    * Function Calculate
    *
    * @since 1.0
    * @param $input Input
    */
    function calculate($input) {
      var $list = [],
          $letter_height = $sk_lh.val(),
          $input_red = $sk_red.val(),
          $input_green = $sk_green.val(),
          $input_blue = $sk_blue.val();

      if($input.hasClass('sk-letter-height') && $.isNumeric($letter_height) && processed_input()){
        equation('bok_h');
      }

      /**
       * Function Equation (inner function)
       *
       * @since 1.0
       * @param $type Type
       */
      function equation($type) {
        var $res_red,
            $res_green,
            $res_blue;

        if($type == 'bok_h'){
          $res_red = $letter_height*$sk_red.data("percentage");
          $res_green = $letter_height*$sk_green.data("percentage");
          $res_blue = $letter_height*$sk_blue.data("percentage");
        }

        //Update the textfields
        $sk_red.val($res_red.toFixed(2) + ' meter');
        $sk_green.val($res_green.toFixed(2) + ' meter');
        $sk_blue.val($res_blue.toFixed(2) + ' meter');

      }

      //---------------------------------------------
      // Input Management
      //---------------------------------------------


      /**
       * Function Processed Input (inner function)
       * Check the inputs for errors & get the integers, despite the strings
       *
       * @since 1.0
       */
      function processed_input() {
        return true;
      }

    }

  //---------------------------------------------
  // Activate & Deactivate
  //---------------------------------------------

  /**
  * Function check_active
  * If inputs behold a number -> add 'aktiverad' else -> add 'deaktiverad'
  *
  * @since 1.0
  * @param $input input
  */
  function check_active($input) {
    var $processed_string,
        $value = $input.val(),
        $processed_class = $input.attr("class"),
        $message_class = $('.widget-content .ms_' + $processed_class);

    $message_class.removeClass('activated').removeClass('deactivated');

    if($value > 0){
      $message_class.addClass('activated');
      $message_class.html('Aktiverad');
    } else {
      $message_class.addClass('deactivated');
      $message_class.html('Deaktiverad');
    }

  }

  //---------------------------------------------
  // Action Events
  //---------------------------------------------

  /**
  * Function on_change
  * Define what change was made and sends it to recalculate
  *
  * @since 1.0
  * @param e Event
  */
  function on_change(e) {
    var $this = $(this);
    calculate($this);
  }

  /**
  * Function Activate
  * Define what change was made and sends it to activate / deactivate
  *
  * @since 1.0
  * @param e Event
  */
  function activate(e) {
    var $this = $(this);
    check_active($this);
  }

  /**
  * Function Reactivate
  * Define what changes was made on button click and reactivate / deactivate
  *
  * @since 1.0
  * @param e Event
  */
  function reactivate(e) {
    setTimeout(function() {
      var $sk_list = [$('#widget-o_skyltar_widget-2-red'), $('#widget-o_skyltar_widget-2-green'), $('#widget-o_skyltar_widget-2-blue')];

      for (var i = 0; i < $sk_list.length; i++) {
        check_active($sk_list[i]);
      }

      bindings();
    }, 300);
  }

  //Function bindings
  function bindings() {
   $input.on('keyup', on_change);
   $bk_input.on('change', activate);
   $bk_button.on('click', reactivate);
  }

  $(function() {
    //The DOM is ready!
    //console.log('The DOM is ready!');

    //Define variables
    $input = $('.wp-skyltar-widget input');
    $bk_input = $('.widget-content input');
    $bk_button = $('#widget-o_skyltar_widget-2-savewidget');
    $sk_lh = $('.sk-letter-height');
    $sk_red = $('.sk-red');
    $sk_green = $('.sk-green');
    $sk_blue = $('.sk-blue');

    //Initiate on load
    var $sk_list = [$('#widget-o_skyltar_widget-2-red'), $('#widget-o_skyltar_widget-2-green'), $('#widget-o_skyltar_widget-2-blue')];

    for (var i = 0; i < $sk_list.length; i++) {
      check_active($sk_list[i]);
    }

    //Call function with bindings
    bindings();
  });

})(jQuery);
