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
      $path = object.templateUrl,
      $settings = {
        factor_red: '',
        factor_green: '',
        factor_blue: ''
      };

  //---------------------------------------------
  // Calculations
  //---------------------------------------------




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
    alert($this.val() + " " + $this.hasClass('sk-red'));
  }

  //Function bindings
  function bindings() {
    $input.on('change', on_change);
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
