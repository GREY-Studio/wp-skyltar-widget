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
      $list,
      $bk_input,
      $bk_button,
      $sk_list,
      $sk_div,
      $sk_lh,
      $sk_vd,
      $sk_radio,
      $data,
      $selected_color,
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
      var $letter_height = $sk_lh.val(),
          $view_distance = $sk_vd.val();

      if($letter_height == "") {
        $letter_height = 0;
      }

      if($view_distance == "") {
        $view_distance = 0;
      }

      //Set color
      set_color();

      if($input.hasClass('sk-letter-height') && $.isNumeric($letter_height) && processed_input()) {
        equation('bok_h');
      } else if($input.hasClass('sk-view-distance') && $.isNumeric($view_distance) && processed_input()) {
        equation('vie_d');
      }

      /**
       * Function SetColor (inner function)
       *
       * @since 1.0
       */
      function set_color() {
        $sk_div.removeClass('same');
        if($letter_height == 0) {
          $sk_div.addClass('same');
        }
      }


      /**
       * Function Equation (inner function)
       *
       * @since 1.0
       * @param $type Type
       */
      function equation($type) {
        var $max,
            $color_per,
            $color_res,
            $temp,
            $res_array = [],
            $sk_array = [];

        //Add data tags to sk_array
        for(var l = 0; l < $list.length; l++) {
          $sk_array.push($list[l].data("percentage"));
        }

        //Build up res_array
        for(var k = 0; k < $sk_array.length; k++) {
          $res_array.push($letter_height*$sk_array[k]);
        }

        //The equation of letter height & the equation of view distance
        if($type == 'bok_h'){

          //Update the color divs
          for(var j = 0; j < $list.length; j++) {
            if(!$list[j].hasClass('deactivated')) {
              set_variables($list[j], $res_array[j]);
            }
          }

        } else if($type == 'vie_d' && $selected_color != null) {
          $color_per = $selected_color.data("percentage");
          $color_res = $sk_vd.val() / $color_per;

          if($view_distance == 0) {
            $letter_height = 0;
            $sk_lh.val(null)
          } else {
            $letter_height = Math.round($color_res);
            $sk_lh.val($letter_height);
          }

          //Update the color divs
          for(var u = 0; u < $list.length; u++) {
            if(!$list[u].hasClass('deactivated')) {
              set_variables($list[u], $color_res*$sk_array[u]);
            }
          }
        }

        //Create dynamic text with an addition of classes
        if($letter_height.toString().length == 3) {
          $sk_div.removeClass('sk-4 sk-5');
          $sk_div.addClass('sk-3');
        } else if($letter_height.toString().length == 4) {
          $sk_div.removeClass('sk-3 sk-5');
          $sk_div.addClass('sk-4');
        } else if($letter_height.toString().length == 5) {
          $sk_div.removeClass('sk-3 sk-4');
          $sk_div.addClass('sk-5');
        } else {
          $sk_div.removeClass('sk-3 sk-4 sk-5');
        };

        //Set width of color elements
        setTimeout(function() {
          set_width();
        }, 50);

        //Reset color
        set_color();

        /**
         * Function SetWidth (inner function)
         *
         * @since 1.0
         */
        function set_width() {
          //Get max value (the new 100%)
          $max = Math.max.apply(null, $sk_array);

          for(var i = 0; i < $sk_array.length; i++) {
            if($list[i].hasClass('same')) {
              $list[i].css('width', '76%');
            } else {
              $list[i].css('width', ($sk_array[i] / $max) * 76 + '%');
            }
          }

        }

        /**
         * Function SetVariables (inner function)
         *
         * @since 1.0
         * @param $bar Bar
         * @param $foo Foo
         */
        function set_variables($bar, $foo) {
          $bar.removeClass('deactivated');
          if($bar.data("percentage") != "") {
            $bar.children().html($foo.toFixed(2) + ' meter');
          } else {
            $bar.addClass('deactivated');
          }
        }
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
  * Function on_select
  * Set the variable selected_color to the clicked div
  *
  * @since 1.0
  * @param e Event
  */
  function on_select(e) {
    var $this = $(this),
        $bool = false;

    $selected_color = $this.parent();

    $selected_color.toggleClass('sk-select');
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
   $sk_radio.on('click', on_select);
  }

  $(function() {
    //The DOM is ready!
    //console.log('The DOM is ready!');

    //Define variables
    $input = $('.wp-skyltar-widget input');
    $bk_input = $('.widget-content input');
    $bk_button = $('#widget-o_skyltar_widget-2-savewidget');
    $sk_lh = $('.sk-letter-height');
    $sk_div = $('div[name="sk"]');
    $sk_vd = $('.sk-view-distance');
    $sk_radio = $('input[name="sk-color"]');
    $list = [
      $('.sk-red'),
      $('.sk-green'),
      $('.sk-blue'),
      $('.sk-yellow'),
      $('.sk-white')
    ];

    //Initiate on load
    $sk_list = [
      $('#widget-o_skyltar_widget-2-red'),
      $('#widget-o_skyltar_widget-2-green'),
      $('#widget-o_skyltar_widget-2-blue'),
      $('#widget-o_skyltar_widget-2-yellow'),
      $('#widget-o_skyltar_widget-2-white')
    ];

    //Initiate radio buttons
    var $init_radio = $('input[name="sk-color"]:checked');
    $selected_color = $init_radio.parent();
    $selected_color.addClass('sk-select');

    //Loop and check active
    for (var i = 0; i < $sk_list.length; i++) {
      check_active($sk_list[i]);
    }

    calculate($input);

    //Call function with bindings
    bindings();
  });

})(jQuery);
