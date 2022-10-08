(function($) {
    "use strict";

    /*-----------------------------------------------------
       Slider
    -------------------------------------------------------*/
    var SliderHandler = function() {
        var slider_elem = $('.slider');
        if (slider_elem.length > 0) {
            var settings = slider_elem.data('settings');
            var arrows = settings['arrows'];
            var dots = settings['dots'];
            var autoplay = settings['autoplay'];
            var in_animation = settings['in_animation'];
            var out_animation = settings['out_animation'];
            var centermode = settings['center_mode'];
            var autoplay_speed = parseInt(settings['autoplay_speed']) || 3000;
            var animation_speed = parseInt(settings['animation_speed']) || 3000;
            var pause_on_hover = settings['pause_on_hover'];
            var display_items = parseInt(settings['display_items']) || 3;
            var tablet_display_items = parseInt(settings['tablet_display_items']) || 2;
            var mobile_display_items = parseInt(settings['mobile_display_items']) || 1;
            slider_elem.owlCarousel({
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
                dots: dots,
                loop: true,
                nav: arrows,
                autoplay: autoplay,
                center: centermode,
                autoplayHoverPause: pause_on_hover,
                autoplaySpeed: autoplay_speed,
                smartSpeed:  animation_speed,
                margin: 30,
                animateOut: out_animation,
                animateIn: in_animation,
                responsive: {
                    0: {
                        items: mobile_display_items
                    },
                    768: {
                        items: tablet_display_items
                    },
                    991: {
                        items: display_items
                    },
                    1200: {
                        items: display_items
                    },
                    1920: {
                        items: display_items
                    }
                }
            });
        }
    }

    /*-----------------------------------------------------
       Course Carousel
    -------------------------------------------------------*/
    var CourseCarouselHandler = function() {
        var carousel_elem = $('.course-carousel');
        if (carousel_elem.length > 0) {
            var settings = carousel_elem.data('settings');
            var arrows = settings['arrows'];
            var dots = settings['dots'];
            var autoplay = settings['autoplay'];
            var centermode = settings['center_mode'];
            var autoplay_speed = parseInt(settings['autoplay_speed']) || 3000;
            var animation_speed = parseInt(settings['animation_speed']) || 3000;
            var pause_on_hover = settings['pause_on_hover'];
            var display_items = parseInt(settings['display_items']) || 3;
            var tablet_display_items = parseInt(settings['tablet_display_items']) || 2;
            var mobile_display_items = parseInt(settings['mobile_display_items']) || 1;
            carousel_elem.owlCarousel({
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
                dots: dots,
                loop: true,
                nav: arrows,
                autoplay: autoplay,
                center: centermode,
                autoplayHoverPause: pause_on_hover,
                autoplaySpeed: autoplay_speed,
                smartSpeed:  animation_speed,
                margin: 30,
                responsive: {
                    0: {
                        items: mobile_display_items
                    },
                    768: {
                        items: tablet_display_items
                    },
                    991: {
                        items: display_items
                    },
                    1200: {
                        items: display_items
                    },
                    1920: {
                        items: display_items
                    }
                }
            });
        }
    }

    /*-----------------------------------------------------
        Testimonial Carousel
    -------------------------------------------------------*/
    var TestimonialHandler = function() {
        var carousel_elem = $('.testi-carousel');
        if (carousel_elem.length > 0) {
            var settings = carousel_elem.data('settings');
            var arrows = settings['arrows'];
            var dots = settings['dots'];
            var autoplay = settings['autoplay'];
            var centermode = settings['center_mode'];
            var autoplay_speed = parseInt(settings['autoplay_speed']) || 3000;
            var animation_speed = parseInt(settings['animation_speed']) || 3000;
            var pause_on_hover = settings['pause_on_hover'];
            var display_items = parseInt(settings['display_items']) || 3;
            var tablet_display_items = parseInt(settings['tablet_display_items']) || 2;
            var mobile_display_items = parseInt(settings['mobile_display_items']) || 1;
            carousel_elem.owlCarousel({
                navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
                dots: dots,
                loop: true,
                nav: arrows,
                autoplay: autoplay,
                center: centermode,
                autoplayHoverPause: pause_on_hover,
                autoplaySpeed: autoplay_speed,
                smartSpeed:  animation_speed,
                margin: 30,
                responsive: {
                    0: {
                        items: mobile_display_items
                    },
                    768: {
                        items: tablet_display_items
                    },
                    991: {
                        items: display_items
                    },
                    1200: {
                        items: display_items
                    },
                    1920: {
                        items: display_items
                    }
                }
            });
        }
    }

    /*-----------------------------------------------------
        Video PopUp
    -------------------------------------------------------*/
    var VideoPopupHandler = function( $scope, $ ) {
        $scope.find('.video-popup').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            disableOn: 300
        });
    };

    /*-----------------------------------------------------
       CountDown
    -------------------------------------------------------*/
    // Set user time in cookie
    var OnworkLocalTimeZone = new Date().toString().match(/([A-Z]+[\+-][0-9]+.*)/)[1];
    var onwork_secure = (document.location.protocol === 'https:') ? 'secure' : '';
    document.cookie = "OnworkLocalTimeZone="+OnworkLocalTimeZone+";SameSite=Strict;"+onwork_secure;

    var CountDown = function ($scope) {
        var $item = $scope.find('.countdown');
        var $countdown_item = $item.find('.countdown-item');
        var $end_action = $item.data('end-action');
        var $redirect_link = $item.data('redirect-link');
        var $end_action_div = $item.find('.countdown-end-action');
        var $editor_mode_on = $scope.hasClass('elementor-element-edit-mode');
        $item.countdown({
            end: function () {
                if (('message' === $end_action || 'img' === $end_action) && $end_action_div !== undefined) {
                    $countdown_item.css("display", "none");
                    $end_action_div.css("display", "block");
                } else if ('url' === $end_action && $redirect_link !== undefined && $editor_mode_on !== true) {
                    window.location.replace($redirect_link)
                }
            }
        });
    };

    /*-----------------------------------------------------
       Skill Bar
    -------------------------------------------------------*/
    var SkillHandler = function($scope) {
        elementorFrontend.waypoint($scope, function () {
            $scope.find('.skill-level').each(function() {
                var $current = $(this),
                    $lt = $current.find('.skill-level-text'),
                    lv = $current.data('level');

                $current.animate({
                    width: lv+'%'
                }, 500);
                $lt.numerator({
                    toValue: lv + '%',
                    duration: 1300,
                    onStep: function() {
                        $lt.append('%');
                    }
                });
            });
        });
    };

    /*-----------------------------------------------------
       Accordian
    -------------------------------------------------------*/
    var AccordionHandler = function () {
        //Accordion Box
        if ($(".accordion-list").length) {
            var accrodionList = $(".accordion-list");
            accrodionList.each(function () {
                var accrodionName = $(this).attr("id");
                var Self = $(this);
                var accordion = Self.find(".accordion-single");
                Self.addClass(accrodionName);
                Self.find(".accordion-single .accordion-content").hide();
                Self.find(".accordion-single.active").find(".accordion-content").show();
                accordion.each(function () {
                    $(this)
                        .find(".accordion-title")
                        .on("click", function () {
                            if ($(this).parent().hasClass("active") === false) {
                                $(".accordion-list." + accrodionName)
                                    .find(".accordion-single")
                                    .removeClass("active");
                                $(".accordion-list." + accrodionName)
                                    .find(".accordion-single")
                                    .find(".accordion-content")
                                    .slideUp();
                                $(this).parent().addClass("active");
                                $(this)
                                    .parent()
                                    .find(".accordion-content")
                                    .slideDown();
                            }
                        });
                });
            });
        }

    }
    
    // Run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/onwork-slider.default', SliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/onwork-countdown.default', CountDown);
        elementorFrontend.hooks.addAction('frontend/element_ready/onwork-course-carousel.default', CourseCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/onwork-testimonial-carousel.default', TestimonialHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/onwork-skill-bar.default', SkillHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/onwork-accordian.default', AccordionHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/onwork-video-popup.default', VideoPopupHandler);   
    });
})(jQuery);