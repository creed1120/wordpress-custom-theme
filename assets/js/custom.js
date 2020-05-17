"use strict";

/****************************************
 *  GSAP Animations
 ****************************************/
// wait until DOM is ready
document.addEventListener("DOMContentLoaded", function (event) {
  console.log("DOM loaded");
  var tl = gsap.timeline(); //create the timeline
  // wait until images, links, fonts, stylesheets, and js is loaded

  window.addEventListener("load", function (e) {
    // Front-Page header Title
    gsap.fromTo(".header-image-wrapper h1", {
      opacity: 0,
      x: -50
    }, {
      opacity: 1,
      x: 0,
      duration: 0.80,
      delay: 0.5
    }); // Front-Page header Title Span

    tl.fromTo(".header-image-wrapper-title .after-span", {
      width: 0
    }, {
      width: 650,
      duration: 0.8,
      delay: 0.5
    }).to(".header-image-wrapper-title .after-span", {
      height: 100
    }).to(".header-image-wrapper-title .after-span", {
      backgroundColor: 'red'
    }); // Front-Page header CTA blocks

    tl.fromTo(".header-cta-blocks div[class*='h-32']:first-child", {
      y: 50,
      opacity: 0
    }, {
      y: 0,
      opacity: 1,
      duration: 0.4
    });
    tl.fromTo(".header-cta-blocks div[class*='h-32']:nth-child(2)", {
      y: 50,
      opacity: 0
    }, {
      y: 0,
      opacity: 1,
      duration: 0.4
    });
    tl.fromTo(".header-cta-blocks div[class*='h-32']:last-child", {
      y: 50,
      opacity: 0
    }, {
      y: 0,
      opacity: 1,
      duration: 0.4
    });
  }, false);
});
/****************************************
 *  jQuery UI Components
 ****************************************/

jQuery(document).ready(function () {
  jQuery("#accordion").accordion();
  jQuery("#datepicker").datepicker();
  jQuery("#dialog").dialog({
    autoOpen: false,
    show: {
      effect: "blind",
      duration: 1000
    },
    hide: {
      effect: "explode",
      duration: 1000
    }
  });
  jQuery("#opener").on("click", function () {
    jQuery("#dialog").dialog("open");
  });
});
/****************************************************************
 *  AJAX call to get 'Categories' and load to DIV on front page
 ****************************************************************/

jQuery(document).ready(function () {
  jQuery(document).on('click', '.js-filter-item a', function (e) {
    e.preventDefault();
    var category = jQuery(this).data('category');
    jQuery.ajax({
      url: wp_ajax.ajax_url,
      data: {
        action: 'filter',
        category: category
      },
      type: 'post',
      success: function success(result) {
        jQuery('.js-filter').html(result);
      },
      error: function error(result) {
        console.warn(result);
      }
    });
  });
});
"use strict";