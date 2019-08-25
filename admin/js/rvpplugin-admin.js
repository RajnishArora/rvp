window.$ = window.jQuery = $ = jQuery  ;

class Disabler{
  constructor() {
      this.whole_doc = $('.document');
      this.check_slider = $('#rvpplugin_slider_checkbox');
      this.events();

  }
  events(){
    document.addEventListener("click",function(e){

      if (e.target.type  ==  'checkbox' ){
        //alert("click evet")
        if( $('#rvpplugin_slider_checkbox').prop('checked') ){
            $("#rvpplugin_customtext").prop('disabled', true);
            $("#rvpplugin_slides_to_show").prop('disabled', false);
            $("#rvpplugin_slidertext").prop('disabled', false);

        } else {
            $("#rvpplugin_customtext").prop('disabled', false);
            $("#rvpplugin_slides_to_show").prop('disabled', true);
            $("#rvpplugin_slidertext").prop('disabled', true);
        }
    }
    });
  }

}

var dis = new Disabler();
