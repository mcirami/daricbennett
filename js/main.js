jQuery(document).ready(function($) {

    var navIcon = $('.user_mobile_nav p span');


    $('.bbp-topic-freshness-author').each(function () {
        var $this = $(this);
        $this.html($this.html().replace(/&nbsp;/g, ''));
    });

    $(".fancybox").click(function (e) {
        e.preventDefault();
        $('#email_join').addClass('active');
    });

    $(".fancybox").fancybox({
        arrows: false,
        autoSize: false,
        width: '750',
        height: '410',
        closeBtn: true,
        scrolling: 'hidden',
        beforeShow: function () {
            $("body").css({'overflow-y': 'hidden !important'});
            //$(".wrapper").css({'position':'fixed'});
        },
        afterClose: function () {
            $("body").css({'overflow-y': 'visible'});
            //$(".wrapper").css({'position':'relative'});
        },
        helpers: {
            overlay: {
                locked: true
            }
        }
    });

    $(".fancybox2").click(function (e) {
        e.preventDefault();
    });

    $(".fancybox2").fancybox({
        arrows: false,
        autoSize: false,
        width: '750',
        height: '750',
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
        if ($('.mobile_menu').hasClass('cover')) {
            $('.mobile_menu').removeClass('cover');
            $('body, html').css('overflow-y', 'hidden');
        } else {
            window.setTimeout(function () {
                $('.mobile_menu').addClass("cover");
            }, 800);
            $('body, html').css('overflow-y', 'auto');
        }

    });

    $('.wrapper.slide').click(function () {
        $('.mobile_menu_icon').toggleClass('open');
        $('.wrapper').toggleClass('slide');
        window.setTimeout(function () {
            $('.mobile_menu').addClass("cover");
        }, 800);
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
                    /*$resultElement.css("color", "white");
                    $resultElement.html("Thanks for subscribing to DaricBennett.com!<br>Check your inbox to confirm your email ~ Daric");*/

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

        //var panelHeight = 0;
       // var rowHeight = 60;
        var headerHeight = $('#global_header').height();
        var accordion = $(this);
        var arrow = $(this).children('.arrow');
        var panel = $(this).next('.panel');
        //var previousPanel = $(this).parent().prevAll('.row').has('.show');
        var hash = $(this).children("a").attr("href");

        /*if (previousPanel.length > 0) {
            panelHeight = $('.panel.show').height();
            rowHeight = $('.lessons_page .video_list .row').height();
        }*/

        $('.accordion').not(this).removeClass('active');
        $('.arrow').removeClass('active');
        $('.panel').removeClass('show');

        if (accordion.hasClass('active')) {
            accordion.removeClass('active');
            arrow.removeClass('active');
            panel.removeClass('show');
            //$('html,body').animate({scrollTop: $(hash).offset().top - headerHeight}, 1000);
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
                //if(".bbp-attachments-form:contains('Media Uploading')") {

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

        for (var i = 0; i < youtube.length; i++) {
            /*
            var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed + "/mqdefault.jpg";

            var image = new Image();
            image.src = source;
            image.addEventListener( "load", function() {
                youtube[ i ].appendChild( image );
            }( i ) );
            */

            youtube[i].addEventListener("click", function () {

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

        for (var i = 0; i < vimeo.length; i++) {

            vimeo[i].addEventListener("click", function () {

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

        for (var i = 0; i < soundslice.length; i++) {

            soundslice[i].addEventListener("click", function () {

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

    /*$('.soundslice_video img').on('click', function(){

        window.setTimeout(function(){
            var ssiframe = document.getElementById('ssembed').contentWindow;
            ssiframe.postMessage('{"method": "setFullscreen", "arg": true}', 'https://www.soundslice.com');
        }, 1000);

    });*/

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

    var postCommentURL = window.location.href;


    if (((currentPage.pageName !== "Video Q & A")  && (currentPage.postType === "videos")) || (currentPage.postType === "live-streams")) {

        if ($('.comment-content > p a').length ) {

            var links = document.querySelectorAll(".comment-content > p a");

            for (x = 0; x < links.length; x++) {

                var videoLink = $(links[x]).attr('href');

                if (videoLink.includes("embed")) {
                    embedLink = videoLink;
                } else if (videoLink.includes("v=")) {
                    str = videoLink.split("v=");
                    embedLink = "https://www.youtube.com/embed/" + str[1];
                } else if (videoLink.includes("youtu.be")) {
                    str = videoLink.split(".be/");
                    embedLink = "https://www.youtube.com/embed/" + str[1];
                }

                $("<div class='video_embed'><div class='video_wrapper'><iframe frameborder='0' allowfullscreen src='" + embedLink + "/?rel=0&showinfo=0'></iframe></div></div>").insertAfter($(links[x]).parent());

                links[x].replaceWith("");

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
                    }

                    $("<div class='video_embed'><div class='video_wrapper'><iframe frameborder='0' allowfullscreen src='" + newEmbedLink + "/?rel=0&showinfo=0'></iframe></div></div>").insertAfter($(commentContent[y]));
                }

            }

        }
    }


    var ajaxComments = null;
    var commentReply = $('a.comment-reply-link');
    var parent = 0;
    var replyToUser = null;
    var commentReplyURL = null;

    if (commentReply.length) {
        replyToComment(commentReply);
    }

    function replyToComment(commentReply) {
        commentReply.prop('onclick', null).off('click');

        commentReply.click(function (e) {

            e.preventDefault();

            replyToUser = $(this).attr('aria-label').split("to");
            replyToUser = replyToUser[1].trim();

            commentReplyURL = window.location.href;

            var buttonUrl = $(this).attr('href').split("=");
            var value = buttonUrl[1].split("#");
            parent = value[0];

            if (!$(this).parent().next('.comment_reply_wrap').hasClass('open')) {
                $('.comment_reply_wrap').removeClass('open').slideUp(600);
            }

            $(this).parent().next('.comment_reply_wrap').addClass('open').slideDown(600);

        });
    }

    var commentSubmitButton = $('.comment_submit .submit');

    var protocol = window.location.protocol;
    var domain = window.location.hostname;

    //var emoji = new EmojiConvertor();

    if (commentSubmitButton.length) {
        submitComment(commentSubmitButton);
    }

    function submitComment(commentSubmitButton) {
        commentSubmitButton.click(function (e) {

            if((currentPage.postType === "videos" || currentPage.postType === "live-streams") && replyToUser == null) {
                console.log('videos');
            } else {
                e.preventDefault();

                $(this).next('.loading_gif').html('<img src ="https://www.daricbennett.com/images/loading-gif.gif"/>');

                var today = new Date();
                //var ajaxURL = currentUser.ajaxurl;
                var ajaxURL = myAjaxurl.ajaxurl;
                var postID = $(this).parent().next('input#comment_post_ID').attr('value');
                var commentContent = $(this).parent().prevAll('p.comment-form-comment:first').children();
                var comment = commentContent[1].value;

                //var commentContent = $(this).parent().prevAll('#wp-comment-wrap:first').children();
                //var comment = commentContent[1]['lastChild'].value;

                //var comment = $(this).parent().prevAll('#wp-comment-wrap').next('iframe #tinymce p');

                var userLogin = currentUser.userLogin;
                var userID = currentUser.userID;
                var userEmail = currentUser.userEmail;
                var userRole = currentUser.userRole;

                var JSONObj = {
                    "post": postID,
                    "content": comment,
                    "author": userID,
                    "author_name": userLogin,
                    "author_email": userEmail,
                    "date": today,
                    "parent": parent
                };

                var data = JSON.stringify(JSONObj);

                //var url = "http://darben.dev/wp-json/wp/v2/comments/?post=" + postID + "&content=" + comment + "&author=" + userID + "&author_name=" + userLogin + "&author_email=" + userEmail + "&parent=" + parent;

                //var url = "https://www.daricbennett.com/wp-json/wp/v2/comments/?post=" + postID + "&content=" + comment + "&author=" + userID + "&author_name=" + userLogin + "&author_email=" + userEmail + "&parent=" + parent;

                //var url = "https://staging.daricbennett.com/wp-json/wp/v2/comments/?post=" + postID + "&content=" + comment + "&author=" + userID + "&author_name=" + userLogin + "&author_email=" + userEmail + "&parent=" + parent;

                //var url = "http://staging-daric.mscwebservices.net/wp-json/wp/v2/comments/?post=" + postID + "&content=" + comment + "&author=" + userID + "&author_name=" + userLogin + "&author_email=" + userEmail + "&parent=" + parent;

                var url = protocol + "//" + domain + "/wp-json/wp/v2/comments/?post=" + postID + "&content=" + comment + "&author=" + userID + "&author_name=" + userLogin + "&author_email=" + userEmail + "&parent=" + parent;

                ajaxComments = $.ajax({
                    url: url,
                    type: "POST",
                    async: true,
                    dataType: 'json',
                    data: data,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("X-WP-Nonce", currentUser.nonce);
                        xhr.setRequestHeader("authorization", "OAuth oauth_consumer_key='IWmItGndx8oY',oauth_token='x3pmlsoef6ayQEdkasPgG01h',oauth_signature_method='HMAC-SHA1',oauth_timestamp='1497396491',oauth_nonce='Lqz1LK',oauth_version='1.0',oauth_signature='EnWnLRtpkruPc1bTtKVhMgECFWg%253D'");
                        xhr.setRequestHeader("cache-control", "no-cache");
                        xhr.setRequestHeader("postman-token", "25dc514c-3ad3-0c17-95e8-9dcc960c9ca0");
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    },
                    success: function (data, xhr) {

                        if (userRole[0] !== 'administrator') {
                            commentsEmail = $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: ajaxURL,
                                data: {action: 'send_comment_notify_email'},
                                success: function (data) {
                                    //alert ("Email Sent");
                                    console.log("Comment Posted, Email Sent");
                                },
                                error: function (xhRequest, errorThrown, resp) {
                                    console.log(errorThrown);
                                    console.log(JSON.stringify(resp));
                                }
                            });

                        } else {

                            commentsEmailAdmin = $.ajax({
                                type: "post",
                                async: true,
                                //dataType: "json",
                                url: ajaxURL,
                                data: {action: 'rv_admin_comments_to_author_comments'},
                                success: function (data) {
                                    //alert ("Email Sent");
                                    console.log("Comment Posted, Email Sent");
                                },
                                error: function (xhRequest, errorThrown, resp) {
                                    console.log(errorThrown);
                                    console.log(JSON.stringify(xhRequest));
                                }
                            });
                        }

                        commentContent[1].value = "";
                        location.reload();
                    },
                    failure: function (xhr) {
                        //alert(xhr.send(data));
                        xhr.send(data);
                        console.log(JSON.stringify(resp));
                    }
                });

                if (replyToUser !== null && commentReplyURL !== null) {

                    commentsReplyEmail = $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: ajaxURL,
                        data: {action: 'send_reply_to_user_email', user: replyToUser, url: commentReplyURL},
                        success: function (data) {
                            //alert ("Email Sent");
                            console.log(data);
                        },
                        error: function (xhRequest, errorThrown, resp) {
                            //alert("Error sending email");
                            console.log(errorThrown);
                            console.log(JSON.stringify(resp));
                        }
                    });
                }
            }

        });
    }


    if ($('.cancel_comment').length) {
        commentCancel();
    }

    function commentCancel() {

        $('.cancel_comment a').click(function (e) {
            e.preventDefault();
            if ($('.comment_reply_wrap').hasClass('open')) {
                $('.comment_reply_wrap').removeClass('open').slideUp(600);
                parent = 0;
                commentReplyURL = null;
                replyToUser = null;
                commentSubmitButton.next('.loading_gif').html('');
            }

        });
    }

    if (currentPage.pageName === 'Lessons') {
        var filterizr = $('.filtr-container');

        filterizr.filterizr({
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

        var videoSrc = $(this).data('src');
        var videoType = $(this).data('type');
        var replaceVideoLink = $(this).data('replace');
        var videoTitle = $(this).data('title');
        var notation = $(this).data('notation');
        var postID = $(this).data('postid');
	    var favoriteButton = '';
	    var videoPlayer = '';
	    var htmlBody = $("html, body");

	    if (currentPage.postType !== "courses") {
		    htmlBody.animate({scrollTop: $('#video_player').offset().top - $('#global_header').height()}, 1000);
	    } else {
		    var hash = $(this).attr("href") + "-video";
		    videoPlayer = $(this).closest('.row').children('.course_video_player');
	    }

        //var keyboardVideo = $('.keyboard_embed').data('embed');
        var commentContent = $(this).parent().nextAll('.comment_wrap').html();
	    ///var ajaxURL = protocol + "//" + domain + "/wp-json/wp/v2/posts"; //myAjaxurl.ajaxurl;

	    /*commentContent = $.ajax({
		    type: "POST",
		    dataType: "json",
		    url: ajaxURL,
		    data: {action: 'get_lesson_comments', id: postID},
		    success: function (data) {
			    //alert ("Email Sent");
			    console.log("Data Got");
		    },
		    error: function (xhRequest, errorThrown, resp) {
			    console.log(errorThrown);
			    console.log(JSON.stringify(resp));
		    }
	    });

	    console.log(commentContent);*/

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

        if (videoType === "soundslice_video") {

            var replaceVideo =
                '<p class="replace_link">Video trouble? <a class="replace_video" href="#" data-replace="' + replaceVideoLink + '">Use this LINK!</a></p>';

            /*if (keyboardVideo !== "undefined") {
                var keyboardLink =
                    '<div class="links_wrap"><a class="keyboard_link" href="#" data-embed="' + keyboardVideo + '">Want to watch this bass line played on a keyboard?</a></div>';
            } else {
                keyboardLink = "";
            }*/

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
            commentContent +
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
        submitComment($('.comment_submit .submit'));
        commentCancel();
    });

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