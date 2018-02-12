var App = function() {
    var v = function() {
        $("#container").on('click', ".navbar li.nav-toggle", function() {
            $("body").toggleClass("nav-open");
        });
        $("body").on('click', ".toggle-sidebar", function(B) {
            B.preventDefault();
            $("#sidebar").css("width", "");
            $("#sidebar > #divider").css("margin-left", "");
            $("#content").css("margin-left", "");
            $("#container").toggleClass("sidebar-closed");
        });
        $("#container").on('click', ".toggle-top-left-menu", function(B) {
            B.preventDefault();
            $(".navbar-left.navbar-left-responsive").slideToggle(200);
        });
        /* var A = function() {
         $(".crumbs .crumb-buttons > li").removeClass("first");
         $(".crumbs .crumb-buttons > li:visible:first").addClass("first");
         if ($("body").hasClass("nav-open")) {
         $("body").toggleClass("nav-open");
         }
         $(".navbar-left.navbar-left-responsive").removeAttr("style");
         h();
         c();
         };  
         */
    };
    var q = function() {
        $("body").height("100%");
        var A = $(".header");
        var C = A.outerHeight();
        var x = $(document).height();
        var z = $(window).height();
        var y = x - z;
        if (y <= C) {
            var B = x - y;
        } else {
            var B = x;
        }
        B = B - C;
        var x = $(document).height();
        $("body").height(B);
    };
    var t = function() {
        q();
        if ($(".header").hasClass("navbar-fixed-top")) {
            $("#container").addClass("fixed-header");
        }
    };

    var f = function() {
        /* if ($(window).width() <= 767) {
         $("body").on("movestart", function(y) {
         if ((y.distX > y.distY && y.distX < -y.distY) || (y.distX < y.distY && y.distX > -y.distY)) {
         y.preventDefault();
         }
         var x = $(y.target).parents("#project-switcher");
         if (x.length) {
         y.preventDefault();
         }
         }).on("swipeleft", function(x) {
         $("body").toggleClass("nav-open");
         }).on("swiperight", function(x) {
         $("body").toggleClass("nav-open");
         });
         }*/
    };
    var d = function() {
        var z = "icon-angle-down", y = "icon-angle-left";
        $("li:has(ul)", "#sidebar-content ul").each(function() {
            if ($(this).hasClass("current") || $(this).hasClass("open-default")) {
                $(">a", this).append("<i class='arrow " + z + "'></i>");
            } else {
                $(">a", this).append("<i class='arrow " + y + "'></i>");
            }
        });
        if ($("#sidebar").hasClass("sidebar-fixed")) {
            $("#sidebar-content").append('<div class="fill-nav-space"></div>');
        }
        $("#sidebar-content ul > li > a").on("click", function(C) {
            if ($(this).next().hasClass("sub-menu") === false) {
                return;
            }
           /* if ($(window).width() > 767) {
                var B = $(this).parent().parent();
                B.children("li.open").children("a").children("i.arrow").removeClass(z).addClass(y);
                B.children("li.open").children(".sub-menu").slideUp(200);
                B.children("li.open-default").children(".sub-menu").slideUp(200);
                B.children("li.open").removeClass("open").removeClass("open-default");
            }*/
            var A = $(this).next();
            if (A.is(":visible")) {
                $("i.arrow", $(this)).removeClass(z).addClass(y);
                $(this).parent().removeClass("open");
                A.slideUp(200, function() {
                    $(this).parent().removeClass("open-fixed").removeClass("open-default");
                    q();
                });
            } else {
                $("i.arrow", $(this)).removeClass(y).addClass(z);
                $(this).parent().addClass("open");
                A.slideDown(200, function() {
                    q();
                });
            }
            C.preventDefault();
        });
        var x = function() {
            $("#divider.resizeable").mousedown(function(B) {
                B.preventDefault();
                var A = $("#divider").width();
                $(document).mousemove(function(D) {
                    var C = D.pageX + A;
                    if (C <= 300 && C >= (A * 2 - 3)) {
                        if (C >= 240 && C <= 260) {
                            $("#sidebar").css("width", 250);
                            $("#sidebar-content").css("width", 250);
                            $("#content").css("margin-left", 250);
                            $("#divider").css("margin-left", 250);
                        } else {
                            $("#sidebar").css("width", C);
                            $("#sidebar-content").css("width", C);
                            $("#content").css("margin-left", C);
                            $("#divider").css("margin-left", C);
                        }
                    }
                });
            });
            $(document).mouseup(function(A) {
                $(document).unbind("mousemove");
            });
        };
        x();
    };
    /* var s = function() {
     $("#sidebar").css("width", "");
     $("#sidebar-content").css("width", "");
     $("#content").css("margin-left", "");
     $("#divider").css("margin-left", "");
     };
     
     */
    var i = function() {
        $("#container").on('click', ".widget .toolbar .widget-collapse", function() {
            var A = $(this).parents(".widget");
            var x = A.children(".widget-content");
            var z = A.children(".widget-chart");
            var y = A.children(".divider");
            if (A.hasClass("widget-closed")) {
                $(this).children("i").removeClass("icon-angle-up").addClass("icon-angle-down");
                x.slideDown(200, function() {
                    A.removeClass("widget-closed");
                });
                z.slideDown(200);
                y.slideDown(200);
            } else {
                $(this).children("i").removeClass("icon-angle-down").addClass("icon-angle-up");
                x.slideUp(200, function() {
                    A.addClass("widget-closed");
                });
                z.slideUp(200);
                y.slideUp(200);
            }
        });
    };
    var j = function() {
        var y = function(z) {
            $(z).each(function() {
                var B = $($($(this).attr("href")));
                var A = $(this).parent().parent();
                if (A.height() > B.height()) {
                    B.css("min-height", A.height());
                }
            });
        };
        $("body").on("click", '.nav.nav-tabs.tabs-left a[data-toggle="tab"], .nav.nav-tabs.tabs-right a[data-toggle="tab"]', function() {
            y($(this));
        });
        y('.nav.nav-tabs.tabs-left > li.active > a[data-toggle="tab"], .nav.nav-tabs.tabs-right > li.active > a[data-toggle="tab"]');
        if (location.hash) {
            var x = location.hash.substr(1);
            $('a[href="#' + x + '"]').click();
        }
    };
    return{init: function() {
            v();
            t();
            f();
            d();
            i();
            j();

        }};
}();