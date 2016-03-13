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
       * Function Equation
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

    }

  //---------------------------------------------
  // Input Management
  //---------------------------------------------

  function processed_input() {
    return true;
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

  //Function bindings
  function bindings() {
   $input.on('keyup', on_change);
  }

  $(function() {
    //The DOM is ready!
    //console.log('The DOM is ready!');

    //Define variables
    $input = $('.wp-skyltar-widget input');
    $sk_lh = $('.sk-letter-height');
    $sk_red = $('.sk-red');
    $sk_green = $('.sk-green');
    $sk_blue = $('.sk-blue');

    //Call function with bindings
    bindings();
  });

})(jQuery);
