jQuery(function(){var e,o,t;jQuery(function(){var e=jQuery("#search-toggle"),o=jQuery("#search-box");jQuery("#search-toggle").on("click",function(){"search-toggle"==jQuery(this).attr("id")&&(o.is(":visible")?e.removeClass("header-search-x").addClass("header-search"):e.removeClass("header-search").addClass("header-search-x"),o.slideToggle(200,function(){}))})}),(t=jQuery(".main-navigation"))&&(e=t.find(".menu-toggle"))&&((o=t.find(".menu"))&&o.children().length?jQuery(".menu-toggle").on("click",function(){jQuery(this).toggleClass("on"),t.toggleClass("toggled-on")}):e.hide()),jQuery(function(){setInterval(function(){jQuery(".min_slider ul").animate({marginLeft:-220},1e3,function(){jQuery(this).css({marginLeft:0}).find("li:last").after(jQuery(this).find("li:first"))})},3e3)});var r=jQuery(".widget_portfolio .three-column-full-width, .widget_portfolio .three-column-full-width .slide-caption h3, .widget_portfolio .three-column-full-width .slide-caption p").children("a");r.on("focus",function(){jQuery(this).parents(".widget_portfolio .three-column-full-width").addClass("focus")}),r.on("focusout",function(){jQuery(this).parents(".widget_portfolio .three-column-full-width").removeClass("focus")}),jQuery(document).ready(function(){jQuery(".go-to-top").hide(),jQuery(window).scroll(function(){900<jQuery(window).scrollTop()?jQuery(".go-to-top").fadeIn():jQuery(".go-to-top").fadeOut()}),jQuery(".go-to-top").click(function(){return jQuery("html,header,body").animate({scrollTop:0},700),!1})})});