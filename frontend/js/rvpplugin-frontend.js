//import $ from 'jquery' ;
//window.$ = $;
//import jQuery from "jquery";
window.$ = window.jQuery = $ = jQuery  ;
class Scarousel{

  constructor() {
      this.els = $('.rvpscarousel');
      this.slidesToShow = rvpplugin_data.slides_to_show;
      this.initSlider();
  }

  initSlider() {
  //  alert("initSlider");
    this.els.slick({
      autoplay: true,
      autoplaySpeed:4000,
      dots: false,
      infinite: true,
      slidesToShow: this.slidesToShow ,
      slidesToScroll: 1,
      arrows:true,
      responsive:[
        {
            breakpoint: 1200,
            settings: {
               slidesToShow: 3,
            }
        },


        {
            breakpoint: 900,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                 arrows:false

            }
        }
      ]
    });
  }

}
var sc = new Scarousel();
