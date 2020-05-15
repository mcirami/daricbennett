/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-fontface-backgroundsize-borderimage-borderradius-boxshadow-flexbox-hsla-multiplebgs-opacity-rgba-textshadow-cssanimations-csscolumns-generatedcontent-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-applicationcache-canvas-canvastext-draganddrop-hashchange-history-audio-video-indexeddb-input-inputtypes-localstorage-postmessage-sessionstorage-websockets-websqldatabase-webworkers-geolocation-inlinesvg-smil-svg-svgclippaths-touch-webgl-shiv-mq-cssclasses-addtest-prefixed-teststyles-testprop-testallprops-hasevent-prefixes-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function D(a){j.cssText=a}function E(a,b){return D(n.join(a+";")+(b||""))}function F(a,b){return typeof a===b}function G(a,b){return!!~(""+a).indexOf(b)}function H(a,b){for(var d in a){var e=a[d];if(!G(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function I(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:F(f,"function")?f.bind(d||b):f}return!1}function J(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+p.join(d+" ")+d).split(" ");return F(b,"string")||F(b,"undefined")?H(e,b):(e=(a+" "+q.join(d+" ")+d).split(" "),I(e,b,c))}function K(){e.input=function(c){for(var d=0,e=c.length;d<e;d++)u[c[d]]=c[d]in k;return u.list&&(u.list=!!b.createElement("datalist")&&!!a.HTMLDataListElement),u}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),e.inputtypes=function(a){for(var d=0,e,f,h,i=a.length;d<i;d++)k.setAttribute("type",f=a[d]),e=k.type!=="text",e&&(k.value=l,k.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(f)&&k.style.WebkitAppearance!==c?(g.appendChild(k),h=b.defaultView,e=h.getComputedStyle&&h.getComputedStyle(k,null).WebkitAppearance!=="textfield"&&k.offsetHeight!==0,g.removeChild(k)):/^(search|tel)$/.test(f)||(/^(url|email)$/.test(f)?e=k.checkValidity&&k.checkValidity()===!1:e=k.value!=l)),t[a[d]]=!!e;return t}("search tel url email datetime date month week time datetime-local number range color".split(" "))}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k=b.createElement("input"),l=":)",m={}.toString,n=" -webkit- -moz- -o- -ms- ".split(" "),o="Webkit Moz O ms",p=o.split(" "),q=o.toLowerCase().split(" "),r={svg:"http://www.w3.org/2000/svg"},s={},t={},u={},v=[],w=v.slice,x,y=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},z=function(b){var c=a.matchMedia||a.msMatchMedia;if(c)return c(b).matches;var d;return y("@media "+b+" { #"+h+" { position: absolute; } }",function(b){d=(a.getComputedStyle?getComputedStyle(b,null):b.currentStyle)["position"]=="absolute"}),d},A=function(){function d(d,e){e=e||b.createElement(a[d]||"div"),d="on"+d;var f=d in e;return f||(e.setAttribute||(e=b.createElement("div")),e.setAttribute&&e.removeAttribute&&(e.setAttribute(d,""),f=F(e[d],"function"),F(e[d],"undefined")||(e[d]=c),e.removeAttribute(d))),e=null,f}var a={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return d}(),B={}.hasOwnProperty,C;!F(B,"undefined")&&!F(B.call,"undefined")?C=function(a,b){return B.call(a,b)}:C=function(a,b){return b in a&&F(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=w.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(w.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(w.call(arguments)))};return e}),s.flexbox=function(){return J("flexWrap")},s.canvas=function(){var a=b.createElement("canvas");return!!a.getContext&&!!a.getContext("2d")},s.canvastext=function(){return!!e.canvas&&!!F(b.createElement("canvas").getContext("2d").fillText,"function")},s.webgl=function(){return!!a.WebGLRenderingContext},s.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:y(["@media (",n.join("touch-enabled),("),h,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c},s.geolocation=function(){return"geolocation"in navigator},s.postmessage=function(){return!!a.postMessage},s.websqldatabase=function(){return!!a.openDatabase},s.indexedDB=function(){return!!J("indexedDB",a)},s.hashchange=function(){return A("hashchange",a)&&(b.documentMode===c||b.documentMode>7)},s.history=function(){return!!a.history&&!!history.pushState},s.draganddrop=function(){var a=b.createElement("div");return"draggable"in a||"ondragstart"in a&&"ondrop"in a},s.websockets=function(){return"WebSocket"in a||"MozWebSocket"in a},s.rgba=function(){return D("background-color:rgba(150,255,150,.5)"),G(j.backgroundColor,"rgba")},s.hsla=function(){return D("background-color:hsla(120,40%,100%,.5)"),G(j.backgroundColor,"rgba")||G(j.backgroundColor,"hsla")},s.multiplebgs=function(){return D("background:url(https://),url(https://),red url(https://)"),/(url\s*\(.*?){3}/.test(j.background)},s.backgroundsize=function(){return J("backgroundSize")},s.borderimage=function(){return J("borderImage")},s.borderradius=function(){return J("borderRadius")},s.boxshadow=function(){return J("boxShadow")},s.textshadow=function(){return b.createElement("div").style.textShadow===""},s.opacity=function(){return E("opacity:.55"),/^0.55$/.test(j.opacity)},s.cssanimations=function(){return J("animationName")},s.csscolumns=function(){return J("columnCount")},s.cssgradients=function(){var a="background-image:",b="gradient(linear,left top,right bottom,from(#9f9),to(white));",c="linear-gradient(left top,#9f9, white);";return D((a+"-webkit- ".split(" ").join(b+a)+n.join(c+a)).slice(0,-a.length)),G(j.backgroundImage,"gradient")},s.cssreflections=function(){return J("boxReflect")},s.csstransforms=function(){return!!J("transform")},s.csstransforms3d=function(){var a=!!J("perspective");return a&&"webkitPerspective"in g.style&&y("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(b,c){a=b.offsetLeft===9&&b.offsetHeight===3}),a},s.csstransitions=function(){return J("transition")},s.fontface=function(){var a;return y('@font-face {font-family:"font";src:url("https://")}',function(c,d){var e=b.getElementById("smodernizr"),f=e.sheet||e.styleSheet,g=f?f.cssRules&&f.cssRules[0]?f.cssRules[0].cssText:f.cssText||"":"";a=/src/i.test(g)&&g.indexOf(d.split(" ")[0])===0}),a},s.generatedcontent=function(){var a;return y(["#",h,"{font:0/0 a}#",h,':after{content:"',l,'";visibility:hidden;font:3px/1 a}'].join(""),function(b){a=b.offsetHeight>=3}),a},s.video=function(){var a=b.createElement("video"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),c.h264=a.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),c.webm=a.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,"")}catch(d){}return c},s.audio=function(){var a=b.createElement("audio"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),c.mp3=a.canPlayType("audio/mpeg;").replace(/^no$/,""),c.wav=a.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),c.m4a=(a.canPlayType("audio/x-m4a;")||a.canPlayType("audio/aac;")).replace(/^no$/,"")}catch(d){}return c},s.localstorage=function(){try{return localStorage.setItem(h,h),localStorage.removeItem(h),!0}catch(a){return!1}},s.sessionstorage=function(){try{return sessionStorage.setItem(h,h),sessionStorage.removeItem(h),!0}catch(a){return!1}},s.webworkers=function(){return!!a.Worker},s.applicationcache=function(){return!!a.applicationCache},s.svg=function(){return!!b.createElementNS&&!!b.createElementNS(r.svg,"svg").createSVGRect},s.inlinesvg=function(){var a=b.createElement("div");return a.innerHTML="<svg/>",(a.firstChild&&a.firstChild.namespaceURI)==r.svg},s.smil=function(){return!!b.createElementNS&&/SVGAnimate/.test(m.call(b.createElementNS(r.svg,"animate")))},s.svgclippaths=function(){return!!b.createElementNS&&/SVGClipPath/.test(m.call(b.createElementNS(r.svg,"clipPath")))};for(var L in s)C(s,L)&&(x=L.toLowerCase(),e[x]=s[L](),v.push((e[x]?"":"no-")+x));return e.input||K(),e.addTest=function(a,b){if(typeof a=="object")for(var d in a)C(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},D(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,e._prefixes=n,e._domPrefixes=q,e._cssomPrefixes=p,e.mq=z,e.hasEvent=A,e.testProp=function(a){return H([a])},e.testAllProps=J,e.testStyles=y,e.prefixed=function(a,b,c){return b?J(a,b,c):J(a,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+v.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
;// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// loads up livereload for dev
var loadReload = function() {

    var lr = document.createElement("script");
        lr.type = "text/javascript";
        lr.src = "//localhost:35729/livereload.js";

    if (jQuery('#global_footer')) {
        jQuery('#global_footer').append(lr);
        console.log('livereload is locked and loaded!!');
    }
}
;jQuery(document).ready(function($) {

    var navIcon = $('.user_mobile_nav p span');

    $('.bbp-topic-freshness-author').each(function () {
        var $this = $(this);
        $this.html($this.html().replace(/&nbsp;/g, ''));
    });

    fancyboxInit();

    function fancyboxInit() {
        var fancybox = $(".fancybox");

        if(fancybox.length) {
            fancybox.click(function(e) {
                e.preventDefault();
                $('#email_join').addClass('active');
            });

            fancybox.fancybox({
                arrows: false,
                autoSize: false,
                width: '750',
                height: '410',
                closeBtn: true,
                scrolling: 'hidden',
                beforeShow: function() {
                    $("body").css({'overflow-y': 'hidden !important'});
                },
                afterClose: function() {
                    $("body").css({'overflow-y': 'visible'});
                },
                helpers: {
                    overlay: {
                        locked: true
                    }
                }
            });
        }

        var fancybox2 = $(".fancybox2");

        if(fancybox2.length) {

            fancybox2.click(function(e) {
                e.preventDefault();
            });

            fancybox2.fancybox({
                arrows: false,
                autoSize: false,
                width: '750',
                height: '750',
                closeBtn: true,
                //scrolling: 'hidden',
                beforeShow: function() {
                    $("body").css({'overflow-y': 'hidden'});
                },
                afterClose: function() {
                    $("body").css({'overflow-y': 'visible'});
                },
                helpers: {
                    overlay: {
                        locked: true
                    }
                }
            });
        }
    }

    $('.members_only_video_pop').fancybox({
        arrows: false,
        autoSize: false,
        width: '700',
        height: '300',
        closeBtn: true,
        //scrolling: 'hidden',
        beforeShow: function () {
            $("body").css({'overflow-y': 'hidden'});
        },
        afterClose: function () {
            $("body").css({'overflow-y': 'visible'});
        },
        helpers: {
            overlay: {
                locked: true
            }
        }
    });

    if ($(window).width() > 768) {

        subMenuHover();

    } else if ($(window).width() < 769) {

        mobileSubMenu();
    }

    $(window).on('resize', function () {

        if ($(window).width() > 768) {

            $('.sub-menu').clearQueue();

            subMenuHover();

            if ($('.menu-item-has-children .sub-menu').hasClass('open')) {
                $('.menu-item-has-children .sub-menu').slideUp(100);
                $('.menu-item-has-children .sub-menu').removeClass('open');
            }

            if ($('.menu-item-has-children > a').hasClass('open')) {
                $('.menu-item-has-children > a').removeClass('open');
            }

            if ($('.wrapper').hasClass('slide')) {
                $('.mobile_menu_icon').removeClass('open');
                $('.wrapper').removeClass('slide');
            }

            //$('.nav_wrap').unbind('slideDown');
            $('.nav_wrap ul').removeClass('open');
            $('.user_mobile_nav').removeClass('open');
            $('.user_mobile_nav p span').removeClass('open');
            $('.nav_wrap ul').css('display', 'block');
            navIcon.html("+");


        } else {
            $('.menu-item-has-children').unbind('mouseenter');
            $('.menu-item-has-children').unbind('mouseleave');

            mobileSubMenu();

        }
    });

    function subMenuHover() {
        $('.menu-item-has-children').mouseenter(function () {
                $(this).children('.sub-menu').slideDown(100);
            }
        );

        $('.menu-item-has-children').mouseleave(function () {
                $(this).children('.sub-menu').slideUp(100);
            }
        );
    }

    function mobileSubMenu() {
        $('.menu-item-has-children > a').click(function (e) {

            if (!$(this).hasClass('open')) {
                e.preventDefault();
                $(this).next('.sub-menu').not(":animated").slideDown(400);
                $(this).addClass('open');
                $(this).parent('li').addClass('open');

            } else {
                e.preventDefault();
                $(this).next('.sub-menu').not(":animated").slideUp(400);
                $(this).removeClass('open');
                $(this).parent('li').removeClass('open');
            }
        });
    }


    $('.mobile_menu_icon').on('touchstart click', function (e) {
        e.preventDefault();

        $(this).toggleClass('open');
        $('.wrapper').toggleClass('slide');
        $('#global_header').toggleClass('slide');
        if ($('.mobile_menu_icon').hasClass('open')) {
            $('body, html').css('overflow-y', 'hidden');
        } else {
            $('body, html').css('overflow-y', 'auto');
        }

    });

    $('.wrapper.slide').click(function () {
        $('.mobile_menu_icon').toggleClass('open');
        $('.wrapper').toggleClass('slide');
    });

    ajaxMailChimpForm($("#subscribe-form"), $("#subscribe-result"));

    function ajaxMailChimpForm($form, $resultElement) {
        // Hijack the submission. We'll submit the form manually.
        $form.submit(function (e) {
            e.preventDefault();
            if (!isValidEmail($form)) {
                var error = "A valid email address must be provided.";
                $resultElement.html(error);
                $resultElement.css("color", "red");
            } else {
                $resultElement.css("color", "white");
                $resultElement.html("Subscribing...");
                submitSubscribeForm($form, $resultElement);
            }
        });
    }

    // Validate the email address in the form
    function isValidEmail($form) {
        // If email is empty, show error message.
        // contains just one @
        var email = $form.find("input[type='email']").val();
        if (!email || !email.length) {
            return false;
        } else if (email.indexOf("@") === -1) {
            return false;
        }
        return true;
    }


    // Submit the form with an ajax/jsonp request.
    // Based on http://stackoverflow.com/a/15120409/215821
    function submitSubscribeForm($form, $resultElement) {
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr("action"),
            data: $form.serialize(),
            cache: false,
            dataType: "jsonp",
            jsonp: "c", // trigger MailChimp to return a JSONP response
            contentType: "application/json; charset=utf-8",
            error: function (error) {
                // According to jquery docs, this is never called for cross-domain JSONP requests
            },
            success: function (data) {
                if (data.result !== "success") {
                    var message = data.msg || "Sorry. Unable to subscribe. Please try again later.";
                    $resultElement.css("color", "red");
                    if (data.msg && data.msg.indexOf("already subscribed") >= 0) {
                        message = "You're already on the list!<br>If you aren't getting messages, check your inbox and verify you confirmed your email!";
                        $resultElement.css("color", "white");
                    }
                    $resultElement.html(message);
                } else {
                    createCookie("subscribed", "success", 5000);

                    window.location.href = "https://www.daricbennett.com/thank-you/";

                }
            }
        });
    }


    if ($('.mc4wp-response').find('.mc4wp-success').length > 0) {

        createCookie("subscribed_form", "success", 5000);

    }

    function createCookie(name, value, days) {
        var expires;
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    $('.accordion').on('click', function () {

        var headerHeight = $('#global_header').height();
        var accordion = $(this);
        var arrow = $(this).children('.arrow');
        var panel = $(this).next('.panel');
        var hash = $(this).children("a").attr("href");

        $('.accordion').not(this).removeClass('active');
        $('.arrow').removeClass('active');
        $('.panel').removeClass('show');

        if (accordion.hasClass('active')) {
            accordion.removeClass('active');
            arrow.removeClass('active');
            panel.removeClass('show');
        } else {
            accordion.addClass('active');
            arrow.addClass('active');
            panel.addClass('show');
        }

	    setTimeout(function () {
		    $('html,body').animate({scrollTop: $(hash).offset().top - headerHeight}, 500);
	    }, 1000);

    });


    $('.share_button').on('click', function () {
        this.nextElementSibling.classList.toggle("show");
    });

    if (window.location.hash) {
        var id = '';

        var hashTitle = window.location.hash;

        if (hashTitle.indexOf('&') !== -1) {
            id = hashTitle.replace(/&/g, 'and');
            $(id).click();
        } else if (hashTitle === "#update-password") {
            //hashID = hashTitle.replace('#','');
            $('html,body').animate({scrollTop: $(hashTitle).offset().top - headerHeight}, 1000);
        } else if (hashTitle.indexOf('/') !== -1) {
            id = hashTitle.replace(/\//g, "-");
            $(id).click();
        } else {
            setTimeout(function () {
                $(window.location.hash).click();
            }, 10);
        }
    }

    $(window).on('scroll', function (event) {
        if ($(window).scrollTop() > 40) {
            $('.header_top,.menu,#global_header .logo,.mobile_menu_icon,ul.member_menu > li').addClass('scroll');
            $('.header_bottom').addClass('home_background');
        } else {
            $('.header_top,.menu,#global_header .logo,.mobile_menu_icon,ul.member_menu > li').removeClass('scroll');
            $('.header_bottom').removeClass('home_background');
        }
    });

    $('.user_mobile_nav').click(function () {

        if (!$('.nav_wrap ul').hasClass('open')) {

            //$('.nav_wrap ul').slideDown(400);
            $('.nav_wrap ul').addClass('open');
            $('.user_mobile_nav').addClass('open');
            $('.user_mobile_nav p span').addClass('open');
            navIcon.html("-");

        } else {
            //$('.nav_wrap ul').slideUp(400);
            $('.nav_wrap ul').removeClass('open');
            $('.user_mobile_nav p span').removeClass('open');
            setTimeout(function () {
                $('.user_mobile_nav').removeClass('open');
            }, 450);
            navIcon.html("+");
        }

    });


    $("#bbp_reply_submit, #bbp_topic_submit").click(function () {

        if ($('#rtmedia_uploader_filelist').is(':visible')) {

            $(".rtmedia-uploader-div .rtmedia-simple-file-upload").append("Media Uploading....");

            if (".rtmedia-container:contains('Media Uploading')") {

                $('#media_upload_wait').addClass('show');
                $("body, html").css('overflow-y', 'hidden');
            }

        }
    });

    if ($('.mejs-overlay').length) {

        $('.mejs-overlay').html('<p>Your file is converting, please be patient!<p>');
    }

    if ($.browser.msie && $.browser.version === 10) {
        $('.home_section .hero input[type=submit]').addClass('ie10');
    }

    if ($('.rtm-bbp-container').length) {
        $('.rtm-bbp-container').parentsUntil('.odd').addClass('attach');
        $('.rtm-bbp-container').parentsUntil('.even').addClass('attach');
    }

    var youtube = document.querySelectorAll(".youtube_video");

    if (youtube.length) {

        for (var a = 0; a < youtube.length; a++) {

            youtube[a].addEventListener("click", function () {

                var iframe = document.createElement("iframe");

                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("allowfullscreen", "");
                iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");

                this.innerHTML = "";
                this.appendChild(iframe);
            });

        }
    }

    var vimeo = document.querySelectorAll(".vimeo_video");

    if (vimeo.length) {

        for (var b = 0; b < vimeo.length; b++) {

            vimeo[b].addEventListener("click", function () {

                var iframe = document.createElement("iframe");

                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("allowfullscreen", "");
                iframe.setAttribute("src", "https://player.vimeo.com/video/" + this.dataset.embed + "?autoplay=1");

                this.innerHTML = "";
                this.appendChild(iframe);
            });
        }
    }

    var soundslice = document.querySelectorAll(".soundslice_video");

    if (soundslice.length) {

        for (var c = 0; c < soundslice.length; c++) {

            soundslice[c].addEventListener("click", function () {

                var iframe = document.createElement("iframe");

                iframe.setAttribute("id", "ssembed");
                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("allowfullscreen", "");
                iframe.setAttribute("src", "https://www.soundslice.com/scores/" + this.dataset.embed);

                this.innerHTML = "";
                this.appendChild(iframe);
            });
        }
    }

    $('.keyboard_link').click(function (e) {
        e.preventDefault();

        $('.keyboard_popup').css('display', 'block');

        $('.keyboard_popup iframe').attr('src', 'https://www.soundslice.com/scores/' + this.dataset.embed);

        $("body, html").css('overflow-y', 'hidden');
    });

    $('.keyboard_popup .close_button').click(function (e) {
        $('.keyboard_popup').css('display', 'none');
        $('.keyboard_popup iframe').attr('src', '');
        $("body, html").css('overflow-y', 'scroll');
    });

    var pageURL = currentPage.postSlug;

    if ((currentPage.postType === "videos") || (currentPage.postType === "live-streams") || (pageURL.includes("free-bass-lessons")) ) {
        commentVideoEmbed();
    }

    function commentVideoEmbed() {

        if ($('.comment-content > p a').length ) {

            var links = document.querySelectorAll(".comment-content > p a");

            for (x = 0; x < links.length; x++) {

                var videoLink = $(links[x]).attr('href');
                var embedLink;
                var str;

                if (videoLink.includes("embed")) {
                    embedLink = videoLink + "/?rel=0&showinfo=0";
                } else if (videoLink.includes("v=")) {
                    str = videoLink.split("v=");
                    embedLink = "https://www.youtube.com/embed/" + str[1] + "/?rel=0&showinfo=0";
                } else if (videoLink.includes("youtu.be")) {
                    str = videoLink.split(".be/");
                    embedLink = "https://www.youtube.com/embed/" + str[1] + "/?rel=0&showinfo=0";
                } else if(videoLink.includes("vimeo")) {
                    str = videoLink.split("video/");
                    embedLink = "https://player.vimeo.com/video/" + str[1];
                } else {
                    embedLink = "";
                }

                if(embedLink !== "") {

                    $("<div class='video_embed'><div class='video_wrapper'><iframe frameborder='0' allowfullscreen src='" +
                        embedLink +
                        "'></iframe></div></div>").
                        insertAfter($(links[x]).parent());

                    links[x].replaceWith("");
                }

            }
        }

        if ($('.comment-content > p').length) {
            var commentContent = document.querySelectorAll(".comment-content > p");

            for (y = 0; y < commentContent.length; y++) {

                var commentText = commentContent[y].innerHTML;

                if (commentText.includes("http")) {
                    var string = commentText.split("http");
                    string = string[1].replace(/\s/g,'');

                    var newVideoLink = "http"+string;

                    if (newVideoLink.includes("embed")) {
                        newEmbedLink = newVideoLink;
                    } else if (newVideoLink.includes("v=")) {
                        str = newVideoLink.split("v=");
                        newEmbedLink = "https://www.youtube.com/embed/" + str[1];
                    } else if (newVideoLink.includes("youtu.be")) {
                        str = newVideoLink.split(".be/");
                        newEmbedLink = "https://www.youtube.com/embed/" + str[1];
                    } else {
                        newEmbedLink = "";
                    }

                    if(newEmbedLink !== "") {

                        $("<div class='video_embed'><div class='video_wrapper'><iframe frameborder='0' allowfullscreen src='" +
                            newEmbedLink +
                            "/?rel=0&showinfo=0'></iframe></div></div>").
                            insertAfter($(commentContent[y]));
                    }
                }

            }

        }
    }

    //var ajaxComments = null;
    var commentReply = $('a.comment-reply-link');
    var commentParent = 0;
    var replyToUser = null;
    var commentReplyURL = null;

    if (commentReply.length) {
        replyToComment(commentReply);
    }

    function replyToComment(commentReply) {
        commentReply.prop('onclick', null).off('click');

        commentReply.click(function (e) {

            e.preventDefault();

            if ($('.comment_reply_wrap').hasClass('open')) {
                $('.comment_reply_wrap').removeClass('open').slideUp(600);
                $('.reply_button').css('display', 'inline-block');

                if(currentPage.pageName === "Lessons" || currentPage.postType === "courses") {
                    $('#respond').remove();
                }
            }

            $(this).parent().css('display', 'none');
            $(this).parent().next('.comment_reply_wrap').addClass('open').slideDown(600);

            replyToUser = $(this).attr('aria-label').split("to");
            replyToUser = replyToUser[1].trim();

            commentReplyURL = window.location.href;

            commentParent = parseInt($(this).closest('li.comment').attr('id').replace(/[^\d]/g, ''),10);

            if(currentPage.pageName === "Lessons" || currentPage.postType === "courses") {

	            var postID = $(this).closest('.video_content_wrap').prev('.video_iframe_wrap').children('button').data('postid');

	            var ajaxURL = myAjaxurl.ajaxurl;
	            var commentForm = $.ajax({
		            type: "post",
		            dataType: 'html',
		            data: {action: 'get_comment_form', id: postID},
		            url: ajaxURL,
		            global: false,
		            async:false,
		            success: function (response) {
			            //alert ("Email Sent");
			            return response;
		            },
		            error: function (xhRequest, errorThrown, resp) {
			            console.log(errorThrown);
			            console.log(JSON.stringify(resp));
		            }

	            }).responseText;

                $(commentForm).insertBefore($(this).parent().next('.comment_reply_wrap').children('.cancel_comment'));

            }

            $(this).closest('.reply').find('#comment_parent').val(commentParent);

        });
    }

    if ($('.cancel_comment').length) {
        commentCancel();
    }

    function commentCancel() {

        $('.cancel_comment a').bind('click', function (e) {
            e.preventDefault();
            if ($('.comment_reply_wrap').hasClass('open')) {
                $('.comment_reply_wrap').removeClass('open').slideUp(600);
                commentParent = 0;
                commentReplyURL = null;
                replyToUser = null;
                //commentSubmitButton.next('.loading_gif').html('');
                var link = $(this).closest('.reply').children('.reply_button').css('display', 'block');

                if(currentPage.pageName === "Lessons" || currentPage.postType === "courses") {
                    $(this).parent().parent().children('#respond').remove();
                }

            }
        });
    }


    if (currentPage.pageName === 'Lessons') {
        var filterizr = $('.filtr-container');

        filterizr.filterizr('setOptions', {
            layout: 'sameSize',
        });
    }

    $('.filter_list li').click(function () {
        if (!$(this).hasClass('all')) {
            $(this).toggleClass('active');
            $('.filter_list li.all').removeClass('active');

            var allFilters = document.querySelectorAll(".filter_list li");

            var active = false;
            for (var i = 0; i < allFilters.length; i++) {
                if (allFilters[i].classList.contains('active')) {
                    active = true;
                }
            }

            if (active === false) {
                $('.filter_list li.all').addClass('active');
            }

        } else {
            $('.filter_list li').removeClass('active');
            $(this).addClass('active');
        }
    });

    $('.play_video').on('click', function () {

	    var videoPlayer = '';
	    var htmlBody = $("html, body");
        var clickHash = $(this).attr("href");

        createCookie("clickHash", clickHash, 5);

	    if (currentPage.postType !== "courses") {
		    htmlBody.animate({scrollTop: $('#video_player').offset().top - $('#global_header').height()}, 1000);
	    } else {
		    var hash = clickHash + "-video";
		    videoPlayer = $(this).closest('.row').children('.course_video_player');
	    }

	    var videoSrc = $(this).data('src');
	    var videoType = $(this).data('type');
	    var replaceVideoLink = $(this).data('replace');
	    var videoTitle = $(this).data('title');
	    var notation = $(this).data('notation');
	    var postID = $(this).data('postid');
	    var favoriteButton = '';
	    var ajaxURL = myAjaxurl.ajaxurl;

	    if (currentPage.postType !== "courses") {
		    videoPlayer = $('#video_player').empty();
	    } else {
		    $('.course_video_player').empty().removeClass('open');
		    $('.lessons_page.courses .row').removeClass('open_player');
		    $(this).closest('.row').addClass('open_player');
		    videoPlayer.addClass('open');
	    }

	    if (currentPage.postType !== "courses") {
		    favoriteButton = $(this).
			    parent().
			    children('.button_wrap').
			    html();
	    } else {
		    favoriteButton = $(this).
			    parent().
			    prev('.button_wrap').
			    html();
	    }

	    if ($(this).parent().parent().children('.video_files').length) {

		    var files = $(this).parent().parent().children('.video_files');

		    var fileElements = "";

		    for (var i = 0; i < files.length; i++) {
			    fileElements += '<a target="_blank" download href="' + files[i].dataset.file + '">' + files[i].dataset.text + '</a>';
		    }
	    } else {
		    fileElements = "";
	    }


        commentsAjaxCall(ajaxURL, postID).then(function(response){

		    var commentContent = response;

	        if (videoType === "soundslice_video") {

		        var replaceVideo =
			        '<p class="replace_link">Video trouble? <a class="replace_video" href="#" data-replace="' + replaceVideoLink + '">Use this LINK!</a></p>';

	        } else {
		        replaceVideo = "";
		        //keyboardLink = "";
	        }

	        var html = '<div class="full_width lesson_title">' +
		        '<h3>' + videoTitle + '</h3>' +
		        '</div>' +
		        '<div class="content_wrap full_width">' +
		        '<div class="video_iframe_wrap">' + favoriteButton + replaceVideo;

	        if (fileElements) {
		        html +=  '<div class="links_wrap">' +
			        fileElements +
			        '</div>';
	        }

	        if (notation === 'yes') {
		        html += '<div class="video_wrapper video_notation">';
	        } else {
		        html += '<div class="video_wrapper">';
	        }

	        html += '<iframe frameborder="0" allowfullscreen src="' + videoSrc + '"></iframe>' +
		        '</div>' +
		        '</div>' +
		        '<div class="video_content_wrap">' +
		        '<div id="comments" class="comments-area">' +
		        '<ol class="comment-list">' +
		        commentContent +
		        '</ol>' +
		        '</div>' +
		        '</div>' +
		        '</div>';

	        $(html).hide().appendTo(videoPlayer).slideDown(1000, function(){
		        if (currentPage.postType === "courses") {
			        htmlBody.animate({
				        scrollTop: $(hash).offset().top -
				        $('#global_header').height()
			        }, 500);
		        }
	        });

	        $('.replace_video').bind("click", function (e) {
		        e.preventDefault();
		        $('.video_wrapper').removeClass('video_notation');
		        var vimeoLink = $(this).data('replace');
		        $(this).parent().nextAll('.video_wrapper').find('iframe').attr('src', vimeoLink);
	        });

	        replyToComment($('a.comment-reply-link'));
	        commentCancel();

		    }, function(reason){
		        console.log("error", reason);
	    });

        setTimeout(function () {
            commentVideoEmbed();
        }, 3000);
    });

    function commentsAjaxCall(url, postid) {

    	return $.ajax({
		    method: 'post',
		    dataType: 'html',
		    data: {action: 'get_lesson_comments', id: postid},
		    url: url
	    })
    }

    var fullURL = window.location.href;

    if (fullURL.includes("filter=inbox")) {
        $('#fep-menu-message_box').addClass('fep-button-active');
    } else {
        $('#fep-menu-message_box').removeClass('fep-button-active');
    }

    var postVideoBtn = document.getElementById("post_video_btn");
    var cancelPost = $('.cancel_post');

    if (postVideoBtn) {

        $('#post_video_btn').click(function (e) {
            e.preventDefault();
            var headerHeight = $('#global_header').height();

            $('#post_submit_form').addClass('show');
            $('html,body').animate({scrollTop: $(this).offset().top - headerHeight}, 1000);

            $('#post_video_btn').css('opacity', '0');

        });
    }

    if (cancelPost) {

        cancelPost.click(function (e) {
            e.preventDefault();
            $('#post_submit_form').removeClass('show');
            $("html, body").animate({scrollTop: 100}, "slow");

            setTimeout(function () {
                $('#post_video_btn').css('opacity', '1');
            }, 800);
        })
    }
});


