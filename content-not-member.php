
<div class="not_member full_width">
	<div class="container">
		<h2> You Must Be A Member To View This Page...</h2>
		<h3>Start your Free Trial to Bass Nation Today!</h3>
		<div class="button_wrap">
			<a class="button red" href="/membership-account/membership-levels/">Start My Free Trial!</a>
		</div>
		<p>Or</p>
		<div class="button_wrap">
			<a class="button black" href="/login">Login Now!</a>
		</div>
	</div>
</div>

<script>

	let redirectURL = window.location.href;

	//console.log(redirectURL);

	createCookie("login_redirect", redirectURL, 5);

	setcookie("postedArticle", true, time() + (60 * 20)); // 60 seconds ( 1 minute) * 20 = 20 minutes

	function createCookie(name, value, minutes) {

		var expires;

		if (minutes) {
			var date = new Date();
			date.setTime(date.getTime() + (minutes * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		}
		else {
			expires = "";
		}
		document.cookie = name + "=" + value + expires + "; path=/";
	}
</script>