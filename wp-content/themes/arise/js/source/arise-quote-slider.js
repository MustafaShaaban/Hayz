//script to fade in and out the testimonials

jQuery(document).ready(function() {
    (function() {
        var infiniteLoop;
                var InfiniteRotator = {
            init: function(slide) {
                //initial fade-in time (in milliseconds)
                var initialFadeIn = 1000;
                //interval between items (in milliseconds)
                var itemInterval = 10000;
                //cross-fade time (in milliseconds)
                var fadeTime = 2500;
                //count number of items
                var numberOfItems = jQuery('.quotes').length;
                //set current item
                var currentItem = slide;

                if (slide === -1) {
                    createPagination(numberOfItems);
                    currentItem = 0;
                }

                //hide all items and then show first item
                jQuery('.quotes').animate({
                    opacity: 0
                }, 0).removeClass('showing');
                jQuery('.quotes').eq(currentItem).animate({
                    opacity: 1.0
                }, 1000).addClass('showing');
                jQuery('.next-prev li').eq(currentItem).addClass('active');
                //loop through the items
                infiniteLoop = setInterval(function() {
                    if (jQuery('.testimonials').hasClass('stop')) {
                        return
                    } //pause

                    jQuery('.quotes').eq(currentItem).animate({
                        opacity: 0.0
                    }, fadeTime).removeClass('showing');
                    if (currentItem == numberOfItems - 1) {
                        currentItem = 0;
                    } else {
                        currentItem++;
                    }
                    jQuery('.quotes').eq(currentItem).animate({
                        opacity: 1.0
                    }, fadeTime).addClass('showing');

                    jQuery('.next-prev li').removeClass('active');
                    jQuery('.next-prev li').eq(currentItem).addClass('active');

                }, itemInterval);

            }
        };
        InfiniteRotator.init(-1);
        // when pagination clicked  
        jQuery(".testimonials").on("click", ".next-prev li", function() {
            clearInterval(infiniteLoop);
            jQuery('.next-prev li').removeClass('active');
            InfiniteRotator.init(jQuery(this).index());
        });
        
                 jQuery(".quotes").on("mouseenter touchstart", function() {
                        jQuery('.testimonials').addClass('stop')
            });
                    jQuery(".quotes").on("mouseleave touchend", function() {
                        jQuery('.testimonials').removeClass('stop')
            });
                
        function createPagination(numberOfItems) {
            var lists = "";
            var pagination = "";
            for (i = 0; i < numberOfItems; i++) {
                lists = lists + ("<li title='next'>" + (i + 1) + "</li>")
            }
            pagination = "<ul class='next-prev'>" + lists + "</ul>";
            jQuery(".quote-wrapper").after(pagination);
        }
    }());
});