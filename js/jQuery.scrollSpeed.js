(function($) {
    jQuery.scrollSpeed = function(step, speed, easing) {
        var $d = $(document),
            $w = $(window),
            $body = $('html, body')
            root = 0;
        if (window.navigator.msPointerEnabled) { return false }

        $w.on('mousewheel DOMMouseScroll', function(e) {
            var maxY = $d.height() - $w.height(),
                animation = {};
            animation[maxY > 0 ? 'scrollTop' : 'scrollLeft'] = root = 
                Math.min(maxY > 0 ? maxY : Math.max(0, $d.width() - $w.width()),
                    Math.max(0,
                        ($body.is(':animated') ? root : maxY > 0 ? $d.scrollTop() : $d.scrollLeft()) 
                        + Math.sign(-e.originalEvent.wheelDeltaY || e.originalEvent.detail) * step));
            $body.stop().animate(animation, speed, easing || 'default');
            return false;
        });
    };

    jQuery.easing.default = function (x,t,b,c,d) {
        return -c * ((t=t/d-1)*t*t*t - 1) + b;
    };
})(jQuery);