jQuery(document).ready(function($){
	
	var navIcon = $('.user_mobile_nav p span');
	
	
	$('.bbp-topic-freshness-author').each(function() {
		var $this = $(this);
		$this.html($this.html().replace(/&nbsp;/g, ''));
	});	
	
	$(".fancybox").click(function(e){
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
		beforeShow  :function(){
            	$("body").css({'overflow-y':'hidden !important'});
            	//$(".wrapper").css({'position':'fixed'});
            },
        afterClose :function(){
            	$("body").css({'overflow-y':'visible'});
            	//$(".wrapper").css({'position':'relative'});
            },
        helpers: {
            overlay: {
                locked: true
            }
        }
	});
	
	$(".fancybox2").click(function(e){
		e.preventDefault();
	});
	
	$(".fancybox2").fancybox({
		arrows: false,
		autoSize: false,
		width: '750',
		height: '750',
		closeBtn: true,
		//scrolling: 'hidden',
		beforeShow  :function(){
            	$("body").css({'overflow-y':'hidden'});
            },
        afterClose :function(){
            	$("body").css({'overflow-y':'visible'});
            },
        helpers: {
            overlay: {
                locked: true
            }
        }
	});


    $('.fancybox3').fancybox({
        arrows: false,
        autoSize: false,
        width: '700',
        height: '300',
        closeBtn: true,
        //scrolling: 'hidden',
        beforeShow  :function(){
            $("body").css({'overflow-y':'hidden'});
        },
        afterClose :function(){
            $("body").css({'overflow-y':'visible'});
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
	
	$(window).on('resize', function() {
    	
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
			
			
        } else  {
			$('.menu-item-has-children').unbind('mouseenter');
			$('.menu-item-has-children').unbind('mouseleave');
			
			mobileSubMenu();
			
        }
    });
    
    function subMenuHover() {
	    $('.menu-item-has-children').mouseenter( function() {
				$(this).children('.sub-menu').slideDown(100);
			}
		);
		
		$('.menu-item-has-children').mouseleave( function() {
				$(this).children('.sub-menu').slideUp(100);
			}
		);
    }
    
    function mobileSubMenu() {
	    $('.menu-item-has-children > a').click(function(e) {
			
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
	
	$('.mobile_menu_icon').on('touchstart click', function(e) {
		e.preventDefault();

		$(this).toggleClass('open');
		$('.wrapper').toggleClass('slide');
		$('#global_header').toggleClass('slide');
		if ($('.mobile_menu').hasClass('cover')) {
			$('.mobile_menu').removeClass('cover');
			$('body, html').css('overflow-y', 'hidden');
		} else {
			window.setTimeout(function(){$('.mobile_menu').addClass("cover");}, 800);
			$('body, html').css('overflow-y', 'auto');
		}
		
	});
	
	$('.wrapper.slide').click(function() {
		$('.mobile_menu_icon').toggleClass('open');
		$('.wrapper').toggleClass('slide');
		window.setTimeout(function(){$('.mobile_menu').addClass("cover");}, 800);
	});
	
	ajaxMailChimpForm($("#subscribe-form"), $("#subscribe-result"));
	
	 function ajaxMailChimpForm($form, $resultElement){
        // Hijack the submission. We'll submit the form manually.
        $form.submit(function(e) {
            e.preventDefault();
            if (!isValidEmail($form)) {
                var error =  "A valid email address must be provided.";
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
        } else if (email.indexOf("@") == -1) {
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
            error: function(error){
                // According to jquery docs, this is never called for cross-domain JSONP requests
            },
            success: function(data){
                if (data.result != "success") {
                    var message = data.msg || "Sorry. Unable to subscribe. Please try again later.";
                    $resultElement.css("color", "red");
                    if (data.msg && data.msg.indexOf("already subscribed") >= 0) {
                        message = "You're already on the list!<br>If you aren't getting messages, check your inbox and verify you confirmed your email!";
                        $resultElement.css("color", "white");
                    }
                    $resultElement.html(message);
                } else {
                    $resultElement.css("color", "white");
                    $resultElement.html("Thanks for subscribing to DaricBennett.com!<br>Check your inbox to confirm your email ~ Daric");
                    
                    createCookie("subscribed", "success", 5000);
                    
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

	$('.accordion').on('click', function(){
		
		var panelHeight = 0;
		var rowHeight = 0;
		var headerHeight = $('#global_header').height();
		var accordion = $(this);
		var arrow = $(this).children('.arrow');
		var panel = $(this).next('.panel');
		var previousPanel = $(this).parent().prevAll('.row').has('.show');
		
		if (previousPanel.length > 0) {
			panelHeight = $('.panel.show').height();
			rowHeight = $('.free_lessons .video_list .row').height();
		}
		
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
			$('html,body').animate({scrollTop: $(this).offset().top - (headerHeight + panelHeight + rowHeight)},1000);
		}
	});

	
	$('.share_button').on('click',function(){
		this.nextElementSibling.classList.toggle("show");
	});

	if (window.location.hash) {
		var id = '';
		
		var hashTitle = window.location.hash;
		
		if (hashTitle.indexOf('&') !== -1) {
			id = hashTitle.replace(/&/g,'and');
			$(id).click();
		} else if (hashTitle == "#update-password") {
			//hashID = hashTitle.replace('#','');
			$('html,body').animate({scrollTop: $(hashTitle).offset().top - headerHeight},1000);
		} else if (hashTitle.indexOf('/') !== -1) {
			id = hashTitle.replace(/\//g, "-");
			$(id).click();
		} else {
			$(window.location.hash).click();
		}
	}
	
	$(window).on('scroll', function(event) {
		if ($(window).scrollTop() > 40) {
			$('.header_top,.menu,#global_header .logo,.mobile_menu_icon,ul.member_menu > li').addClass('scroll');
			$('.header_bottom').addClass('home_background');
	  	} else {
		  	$('.header_top,.menu,#global_header .logo,.mobile_menu_icon,ul.member_menu > li').removeClass('scroll');
		  	$('.header_bottom').removeClass('home_background');
	  	}
	 });
	 
	 $('.user_mobile_nav').click(function(){
		 
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
			setTimeout(function(){
				$('.user_mobile_nav').removeClass('open');
			}, 450);
			navIcon.html("+");
		}
		
	 });
	 
	 
	 $("#bbp_reply_submit, #bbp_topic_submit").click(function(){
		 
		if ($('#rtmedia_uploader_filelist').is(':visible')) {
		 
		 	$(".rtmedia-uploader-div .rtmedia-simple-file-upload").append("Media Uploading....");
		 
			 if (".rtmedia-container:contains('Media Uploading')") {
				//if(".bbp-attachments-form:contains('Media Uploading')") {
				
				 $('#media_upload_wait').addClass('show');
				 $("body, html").css('overflow-y','hidden');
			 }
		 
		 }
    });
    
    if ($('.mejs-overlay')) {
    
    	$('.mejs-overlay').html('<p>Your file is converting, please be patient!<p>');
    }

    if ($.browser.msie && $.browser.version == 10) {
	    $('.home_section .hero input[type=submit]').addClass('ie10');
    }

    if ($('.rtm-bbp-container')) {
	    $('.rtm-bbp-container').parentsUntil('.odd').addClass('attach');
	    $('.rtm-bbp-container').parentsUntil('.even').addClass('attach');
    }
    
    var youtube = document.querySelectorAll( ".youtube_video" );
    
    for (var i = 0; i < youtube.length; i++) {
	    /*
	    var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed + "/mqdefault.jpg";
	    
	    var image = new Image();
        image.src = source;
        image.addEventListener( "load", function() {
            youtube[ i ].appendChild( image );
        }( i ) );
        */
        youtube[i].addEventListener( "click", function() {
 
        var iframe = document.createElement( "iframe" );
 
            iframe.setAttribute( "frameborder", "0" );
            iframe.setAttribute( "allowfullscreen", "" );
            iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );
 
            this.innerHTML = "";
            this.appendChild( iframe );
    	} );
	    
	}
	
	var vimeo = document.querySelectorAll( ".vimeo_video" );
	 
	for (var i = 0; i < vimeo.length; i++) {

        vimeo[i].addEventListener( "click", function() {
		
        	var iframe = document.createElement( "iframe" );
 
            iframe.setAttribute( "frameborder", "0" );
            iframe.setAttribute( "allowfullscreen", "" );
            iframe.setAttribute( "src", "https://player.vimeo.com/video/"+ this.dataset.embed + "?autoplay=1" );
 
            this.innerHTML = "";
            this.appendChild( iframe );
    	} );
	}

	var soundslice = document.querySelectorAll(".soundslice_video");

    for (var i = 0; i < soundslice.length; i++) {

        soundslice[i].addEventListener( "click", function() {

            var iframe = document.createElement( "iframe" );

            iframe.setAttribute( "id", "ssembed" );
            iframe.setAttribute( "frameborder", "0" );
            iframe.setAttribute( "allowfullscreen", "" );
            iframe.setAttribute( "src", "https://www.soundslice.com/scores/"+ this.dataset.embed);

            this.innerHTML = "";
            this.appendChild( iframe );
        } );
    }

    /*$('.soundslice_video img').on('click', function(){

        window.setTimeout(function(){
            var ssiframe = document.getElementById('ssembed').contentWindow;
            ssiframe.postMessage('{"method": "setFullscreen", "arg": true}', 'https://www.soundslice.com');
        }, 1000);

    });*/

    $('.keyboard_link').click(function(e){
        e.preventDefault();

        $('.keyboard_popup').css('display', 'block');

        $('.keyboard_popup iframe').attr('src', 'https://www.soundslice.com/scores/' + this.dataset.embed);

        $("body, html").css('overflow-y','hidden');
    });

    $('.keyboard_popup .close_button').click(function(e){
        $('.keyboard_popup').css('display', 'none');
        $('.keyboard_popup iframe').attr('src', '');
        $("body, html").css('overflow-y','scroll');
    });


	var ajaxComments = null;
    var commentReply = $('a.comment-reply-link');
    var parent = 0;
    var replyToUser = null;
    var commentReplyURL = null;

    if (commentReply) {

        commentReply.prop('onclick', null).off('click');

        commentReply.click(function(e){
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


    if (commentSubmitButton) {

        commentSubmitButton.click(function (e){
            e.preventDefault();

            $(this).next('.loading_gif').html('<img src ="https://www.daricbennett.com/images/loading-gif.gif"/>');

            var today = new Date();

            var postID = $(this).parent().next('input#comment_post_ID').attr('value');
            var commentContent = $(this).parent().prevAll('p.comment-form-comment:first').children();
            var comment = commentContent[1].value;

            var userLogin = currentUser.userLogin;
            var userID = currentUser.userID;
            var userEmail = currentUser.userEmail;
            var userRole = currentUser.userRole;

            var JSONObj = {
                "post" : postID,
                "content" : comment,
                "author" : userID,
                "author_name" : userLogin,
                "author_email" : userEmail,
                "date" : today,
                "parent" : parent
            };

            var data  = JSON.stringify(JSONObj);

            //var url = "http://darben.dev/wp-json/wp/v2/comments/?post=" + postID + "&content=" + comment + "&author=" + userID + "&author_name=" + userLogin + "&author_email=" + userEmail + "&parent=" + parent;

            //var url = "https://www.daricbennett.com/wp-json/wp/v2/comments/?post=" + postID + "&content=" + comment + "&author=" + userID + "&author_name=" + userLogin + "&author_email=" + userEmail + "&parent=" + parent;

            //var url = "https://staging.daricbennett.com/wp-json/wp/v2/comments/?post=" + postID + "&content=" + comment + "&author=" + userID + "&author_name=" + userLogin + "&author_email=" + userEmail + "&parent=" + parent;

            //var url = "http://staging-daric.mscwebservices.net/wp-json/wp/v2/comments/?post=" + postID + "&content=" + comment + "&author=" + userID + "&author_name=" + userLogin + "&author_email=" + userEmail + "&parent=" + parent;

			var url = protocol + "//" + domain + "/wp-json/wp/v2/comments/?post=" + postID + "&content=" + comment + "&author=" + userID + "&author_name=" + userLogin + "&author_email=" + userEmail + "&parent=" + parent;

            ajaxComments = $.ajax ({
                type: "POST",
                url: url,
                dataType: 'json',
                data: data,
                beforeSend : function(xhr) {
                    xhr.setRequestHeader("X-WP-Nonce", currentUser.nonce);
                    xhr.setRequestHeader("authorization", "OAuth oauth_consumer_key='IWmItGndx8oY',oauth_token='x3pmlsoef6ayQEdkasPgG01h',oauth_signature_method='HMAC-SHA1',oauth_timestamp='1497396491',oauth_nonce='Lqz1LK',oauth_version='1.0',oauth_signature='EnWnLRtpkruPc1bTtKVhMgECFWg%253D'");
                    xhr.setRequestHeader("cache-control", "no-cache");
                    xhr.setRequestHeader("postman-token", "25dc514c-3ad3-0c17-95e8-9dcc960c9ca0");
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                },
                success: function(data, xhr) {

                    if (userRole[0] !== 'administrator') {
                        commentsEmail = $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: currentUser.ajaxurl,
                            data: {action: 'send_comment_notify_email'},
                            success: function (data) {
                                //alert ("Email Sent");
                                console.log("Comment Posted, Email Sent");
                            },
                            error: function (errorThrown) {
                                //alert("Error sending email");
                                console.log(errorThrown);
                            }
                        });
                    }

                    commentContent[1].value = "";
                    location.reload();
                },
                failure : function(xhr) {
                    //alert(xhr.send(data));
                    xhr.send(data);
                }
            });

            if (replyToUser !== null && commentReplyURL !== null) {

                commentsReplyEmail = $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: currentUser.ajaxurl,
                    data: {action: 'send_reply_to_user_email', user: replyToUser, url: commentReplyURL},
                    success: function (data) {
                        //alert ("Email Sent");
                        console.log(data);
                    },
                    error: function (errorThrown) {
                        //alert("Error sending email");
                        console.log(errorThrown);
                    }
                });
            }

        });
    }

    $('.cancel_comment').click(function(e){
        e.preventDefault();
        if($('.comment_reply_wrap').hasClass('open')) {
            $('.comment_reply_wrap').removeClass('open').slideUp(600);
            parent = 0;
            commentReplyURL = null;
            replyToUser = null;
            commentSubmitButton.next('.loading_gif').html('');
        }

    });

    $('.replace_video').click(function(e) {
        e.preventDefault();

        var vimeoLink = $(this).attr('data');

        $(this).parent().parent().next('.video_wrapper').find('iframe').attr('src', vimeoLink);

    });


/*    $('.subscribe_all').click(function(e){
        e.preventDefault();

        var userID = currentUser.userID;

        $.ajax({
            url:currentUser.ajaxurl, //the page containing php script
            type: "POST", //request type,
            data: {action: 'subscribe_all', user: userID},
            success:function(result){
                console.log("yes");
            }, failure:function(result) {
                console.log("no");
            }
        });
    });*/


/*

    function encode_utf8(s) {
        return unescape(encodeURIComponent(s));
    }

*/

/*
	$('.d4p-bbp-attachment a').removeAttr("download");
	//$('.bbp-atticon-video a:first-of-type').addClass("lightbox");
	
	$('.lightbox').click(function(e){
		e.preventDefault();
		var lightboxLink = $(this).attr('href');
		$('.lightbox_pop').addClass('show');
		$('.lightbox_img').attr('src', lightboxLink);
		$('body, html').css('overflow-y', 'hidden');
	});
	
	$('.close_button').click(function(e){
		$('.lightbox_pop').removeClass('show');
		$('body, html').css('overflow-y', 'auto');
	});
	
	if (!$('.d4p-bbp-attachment a').hasClass('lightbox')) {
		$('.d4p-bbp-attachment a').addClass('lightbox');
	}
*/	
	
});