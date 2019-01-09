/**
 * @function      Include
 * @description   Includes an external scripts to the page
 * @param         {string} scriptUrl
 */
function include(scriptUrl) {
    document.write('<script src="' + scriptUrl + '"></script>');
}


/**
 * @function      isIE
 * @description   checks if browser is an IE
 * @returns       {number} IE Version
 */
function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
};


/**
 * @module       Copyright
 * @description  Evaluates the copyright year
 */
;
(function ($) {
    $(document).ready(function () {
        $("#copyright-year").text((new Date).getFullYear());
    });
})(jQuery);


/**
 * @module       IE Fall&Polyfill
 * @description  Adds some loosing functionality to old IE browsers
 */
;
(function ($) {
    if (isIE() && isIE() < 11) {
        $('html').addClass('lt-ie11');
        $(document).ready(function () {
            PointerEventsPolyfill.initialize({});
        });
    }

    if (isIE() && isIE() < 10) {
        $('html').addClass('lt-ie10');
    }
})(jQuery);


/**
 * @module       WOW Animation
 * @description  Enables scroll animation on the page
 */
;
(function ($) {
    var o = $('html');
    if (o.hasClass('desktop') && o.hasClass("wow-animation") && $(".wow").length) {
        $(document).ready(function () {
            new WOW({
                    mobile: false
                }
            ).init();
        });
    }
})(jQuery);


/**
 * @module       ToTop
 * @description  Enables ToTop Plugin
 */
;
(function ($) {
    var o = $('html');
    if (o.hasClass('desktop')) {

        $(document).ready(function () {
            $().UItoTop({
                easingType: 'easeOutQuart',
                containerClass: 'ui-to-top fa fa-angle-up'
            });
        });
    }
})(jQuery);

/**
 * @module       Responsive Tabs
 * @description  Enables Easy Responsive Tabs Plugin
 */
;
(function ($) {
    var o = $('.responsive-tabs');
    if (o.length > 0) {
        $(document).ready(function () {
            o.each(function () {
                var $this = $(this);
                $this.easyResponsiveTabs({
                    type: $this.attr("data-type") === "accordion" ? "accordion" : "default"
                });
            })
        });
    }
})(jQuery);

/**
 * @module       RD Mailform
 * @description  Enables RD Mailform Plugin
 */
;
(function ($) {
    var o = $('.rd-mailform');
    if (o.length > 0) {
        $(document).ready(function () {
            var o = $('.rd-mailform');

            if (o.length) {
                o.rdMailForm({
                    validator: {
                        'constraints': {
                            '@LettersOnly': {
                                message: 'Please use letters only!'
                            },
                            '@NumbersOnly': {
                                message: 'Please use numbers only!'
                            },
                            '@NotEmpty': {
                                message: 'Field should not be empty!'
                            },
                            '@Email': {
                                message: 'Enter valid e-mail address!'
                            },
                            '@Phone': {
                                message: 'Enter valid phone number!'
                            },
                            '@Date': {
                                message: 'Use MM/DD/YYYY format!'
                            },
                            '@SelectRequired': {
                                message: 'Please choose an option!'
                            }
                        }
                    }
                }, {
                    'MF000': 'Sent',
                    'MF001': 'Recipients are not set!',
                    'MF002': 'Form will not work locally!',
                    'MF003': 'Please, define email field in your form!',
                    'MF004': 'Please, define type of your form!',
                    'MF254': 'Something went wrong with PHPMailer!',
                    'MF255': 'There was an error submitting the form!'
                });
            }
        });
    }
})(jQuery);

/**
 * @module       RD Google Map
 * @description  Enables RD Google Map Plugin
 */
;
(function ($) {
    var o = document.getElementById("google-map");
    if (o) {
        include('//maps.google.com/maps/api/js?sensor=false');

        $(document).ready(function () {
            var o = $('#google-map');
            if (o.length > 0) {
                o.googleMap({
                    styles: []
                });
            }
        });
    }
})
(jQuery);

/**
 * @module       RD Navbar
 * @description  Enables RD Navbar Plugin
 */
;
(function ($) {
    var o = $('.rd-navbar');
    if (o.length > 0) {
        $(document).ready(function () {
            o.RDNavbar({
                stuckWidth: 768,
                stuckMorph: true,
                stuckLayout: "rd-navbar-static",
                responsive: {
                    0: {
                        layout: 'rd-navbar-fixed',
                        focusOnHover: false
                    },
                    768: {
                        layout: 'rd-navbar-fullwidth'
                    },
                    1200: {
                        layout: o.attr("data-rd-navbar-lg").split(" ")[0]
                    }
                },
                onepage: {
                    enable: false,
                    offset: 0,
                    speed: 400
                }
            });
        });
    }
})(jQuery);

/**
 * @module       RD Parallax 3
 * @description  Enables RD Parallax 3 Plugin
 */
;
(function ($) {
     var o = $('.rd-parallax');
    if (o.length) {
        $(document).ready(function () {
            o.each(function () {
                var p = $(this);
                if (!p.parents(".swiper-slider").length) {
                    p.RDParallax({
                        direction: ($('html').hasClass("smoothscroll") || $('html').hasClass("smoothscroll-all")) && !isIE() ? "normal" : "inverse"
                    });
                }
            });
        });
    }
})(jQuery);

/**
 * @module       Progress Bar
 * @description  Enables Progress Bar Plugin
 */
;
(function ($) {
    var o = $(".progress-bar");
    if (o.length) {
        function isScrolledIntoView(elem) {
            var $window = $(window), $elem = $(elem);
            return $elem.offset().top + $elem.height() >= $window.scrollTop() && $elem.offset().top <= $window.scrollTop() + $window.height();
        }

        $(document).ready(function () {
            o.each(function () {
                var bar, type;

                if (
                    this.className.indexOf("progress-bar-horizontal") > -1
                ) {
                    type = 'Line';
                }

                if (
                    this.className.indexOf("progress-bar-radial") > -1
                ) {
                    type = 'Circle';
                }

                if (this.getAttribute("data-stroke") && this.getAttribute("data-value") && type) {
                    bar = new ProgressBar[type](this, {
                        strokeWidth: Math.round(parseFloat(this.getAttribute("data-stroke")) / this.offsetWidth * 100)
                        ,
                        trailWidth: this.getAttribute("data-trail") ? Math.round(parseFloat(this.getAttribute("data-trail")) / this.offsetWidth * 100) : 0
                        ,
                        text: {
                            value: this.getAttribute("data-counter") === "true" ? '0' : null
                            , className: 'progress-bar__body'
                            , style: null
                        }
                    });

                    bar.svg.setAttribute('preserveAspectRatio', "none meet");
                    if (type === 'Line') {
                        bar.svg.setAttributeNS(null, "height", this.getAttribute("data-stroke"));
                    }

                    bar.path.removeAttribute("stroke");
                    bar.path.className.baseVal = "progress-bar__stroke";
                    if (bar.trail) {
                        bar.trail.removeAttribute("stroke");
                        bar.trail.className.baseVal = "progress-bar__trail";
                    }

                    if (this.getAttribute("data-easing") && !isIE()) {
                        $(document)
                            .on("scroll", $.proxy(function () {
                                if (isScrolledIntoView(this) && this.className.indexOf("progress-bar--animated") === -1) {
                                    var _this = this;
                                    this.className += " progress-bar--animated";
                                    bar.animate(parseInt(this.getAttribute("data-value")) / 100.0, {
                                        easing: this.getAttribute("data-easing")
                                        ,
                                        duration: this.getAttribute("data-duration") ? parseInt(this.getAttribute("data-duration")) : 800
                                        ,
                                        step: function (state, b) {
                                            if (_this.getAttribute("data-counter") === "true") {
                                                if (b._container.className.indexOf("progress-bar-horizontal") > -1) {
                                                    b.text.style.width = Math.abs(b.value() * 100).toFixed(0) + "%"
                                                }
                                                b.setText(Math.abs(b.value() * 100).toFixed(0));
                                            }
                                        }
                                    });
                                }
                            }, this))
                            .trigger("scroll");
                    } else {
                        bar.set(parseInt(this.getAttribute("data-value")) / 100.0);
                        bar.setText(this.getAttribute("data-value"));
                        if (type === 'Line') {
                            bar.text.style.width = parseInt(this.getAttribute("data-value")) + "%";
                        }
                    }
                } else {
                    console.error(this.className + ": progress bar type is not defined");
                }
            });
        });
    }
})(jQuery);

