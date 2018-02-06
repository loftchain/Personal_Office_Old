$('.register-from').hide();
var form = $('form');
var rootPath = 'http://ico.qykbar.io';
var src = $('.integration-script').attr('src');
$('<section class="integration col-xl-2 col-md-6 col-sm-8 col-xs-12">\n' +
  '\t\t<link rel="stylesheet" href="http://ico.qykbar.io/css/integrations.css">\n' +
  '\t\t<div class="personal-area-container">\n' +
  '\t\t\t<form method="post" class="personal-area-form" action="http://ico.qykbar.io/register" novalidate>\n' +
  '\t\t\t\t<div class="form-group">\n' +
  '\t\t\t\t\t<h4 class="header">Sign Up</h4>\n' +
  '\t\t\t\t\t<input type="email" name="email" id="email" class="my-input form-control" placeholder="Email">\n' +
  '\t\t\t\t\t<div class="error-message error-message0 email user_not_found"></div>\n' +
  '\t\t\t\t\t<input style="display:none;" type="password" name="password" class="my-input form-control" id="password" placeholder="Password">\n' +
  '\t\t\t\t\t<div class="error-message error-message1 password"></div>\n' +
  '\t\t\t\t\t<div class="g-recaptcha" data-sitekey="6LfffT4UAAAAANi_97FuZ53gSxtT3ct-bYvfQ7A_"></div>\n' +
  '\t\t\t\t\t<div class="error-message error-message1 g-recaptcha-response"></div>\n' +
  '\t\t\t\t\t<button type="submit" class="btn btn-primary sbmt-button">Sign up</button>\n' +
  '\t\t\t\t\t<div class="btn-container">\n' +
  '\t\t\t\t\t\t<a href="" class="switch-method-link switch0 login-register-btn">Sign in</a>\n' +
  '\t\t\t\t\t\t<a href="" class="switch-method-link switch1 forgot-btn">Forgot password?</a>\n' +
  '\t\t\t\t\t\t<a href="" class="switch-method-link switch1 back-btn">Back</a>\n' +
  '\t\t\t\t\t</div>\n' +
  '\t\t\t\t</div>\n' +
  '\t\t\t</form>\n' +
  '\t\t</div>\n' +
  '\t\t<form action="" method="post" id="token"></form>\n' +
  '\t</section>').appendTo( ".register-section" );


$('.back-btn').hide();
$('#password').show();
if (/sub/i.test(src)){
	$('#password').hide();
	$('.personal-area-form').attr('action', rootPath + '/register?subscription');
}
var subOrReg = (/sub/i.test(src)) ? 'subscription' : 'registration';

$('.switch0').click(function(e){
  e.preventDefault();
  $('.form-title, .personal-area-form, .sbmt-button, .header').removeClass('forgot');
  $('.form-title, .personal-area-form, .sbmt-button, .switch0, .header, .my-input, .g-recaptcha, .login-redirect, #password').toggleClass('login');
  $('.sbmt-button').text('Sign up');
  $('.switch0').text('Sign in');
  $('.switch0.login').text('Sign up');
  $('.header').text('Sign Up');
  $('.header.login').text('Sign In');
	$('.sbmt-button.login').text('Sign In');
  $('.sbmt-button').show();
  $('.my-input').show();
  $('.g-recaptcha').show();
  $('.error-message').text('');
  $('.error-message').prev().css({'border': '1px solid transparent'});
	$('.personal-area-form').attr('action',rootPath + '/register');
	if (/sub/i.test(src)){
		$('#password').hide();
		$('#password.login').show();
		$('.personal-area-form').attr('action', rootPath + '/register?subscription');
	}
	$('.personal-area-form.login').attr('action', rootPath + '/login?token');

});




$('.switch1').click(function(e){
  e.preventDefault();
  $('#password').hide();
  $('#email').show();
  $('.sbmt-button').show();
  $('.g-recaptcha').show();

  $('.form-title, .personal-area-form, .sbmt-button, .header').addClass('forgot');
  $('.form-title.forgot').text('Forgot your password?');
  $('.personal-area-form.forgot').attr('action',rootPath + '/password/email');
  $('.sbmt-button.forgot').text('Send');
  $('.header.forgot').text('Enter email for password recovery');
  $('.error-message').text('');
  $('.error-message').prev().css({'border': '1px solid transparent'});

});



	$('.personal-area-form').on('submit', function (e) {
		e.preventDefault();

		$('.error-message').text('');
		$('.error-message').prev().css({'border': '1px solid transparent'});
		$.ajax({
			url: $(this).attr("action"),
			type: $(this).attr("method"),
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				switch (true) {
					case !$.isEmptyObject(data.validation_error):
						if (data.validation_error['g-recaptcha-response']) {
							data.validation_error['g-recaptcha-response'] = ['Captcha must be accepted.'];
						}
						$.each(data.validation_error, function (key, value) {
							if ($(".error-message." + key).prev().hasClass('my-input')) {
								$(".error-message." + key).prev().css({
									'border': '1px solid #ef4432'
								});
							}
							$(".error-message." + key).html('<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>&nbsp' + value[0]);
						});
						break;
					case !$.isEmptyObject(data.token) && data.token.length == 10 :
						var redirect_url = rootPath + '/login?token=' + data.token + '&email=' + encodeURIComponent($('#email').val());
						 $('#token').attr('action', redirect_url).submit();
						break;
					case !$.isEmptyObject(data.user_not_found):
						$(".error-message.user_not_found").prev().css({
							'border': '1px solid #ef4432'
						});
						$(".error-message.user_not_found").html('<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>&nbsp' + data.user_not_found);
						break;
					case !$.isEmptyObject(data.reset_pwd):
						$('.sbmt-button').hide();
						$('.my-input').hide();
						$('.g-recaptcha').hide();
						$('.forgot-btn').hide();
						$('.login-register-btn').hide();
						$('.back-btn').show();
						$('.header').text(data.reset_pwd);
						break;
					case !$.isEmptyObject(data.reset_limit_exceeded):
						$('.sbmt-button').hide();
						$('.my-input').hide();
						$('.g-recaptcha').hide();
						$('.forgot-btn').hide();
						$('.login-register-btn').hide();
						$('.back-btn').show();
						$('.header').text(data.reset_limit_exceeded);
						break;
					case !$.isEmptyObject(data.not_confirmed_resend):
						$('.sbmt-button').hide();
						$('.my-input').hide();
						$('.g-recaptcha').hide();
						$('.forgot-btn').hide();
						$('.login-register-btn').hide();
						$('.back-btn').show();
						$('.header').text(data.not_confirmed_resend);
						break;
					default:
						window.location.replace(rootPath + '/successRegister?type=' + subOrReg + '&email=' + encodeURIComponent($('#email').val()));
						clearforms();
						break;
				}
			}
		})
	});

$('.back-btn').click(function(){
	clearforms();
});

function clearforms() {
	$('.form-title, .personal-area-form, .sbmt-button, .header').removeClass('forgot');
	$('.form-title, .personal-area-form, .sbmt-button, .switch0, .header, .my-input, .g-recaptcha, .login-redirect, #password').removeClass('login');
	$('.error-message').text('');
	$('.error-message').prev().css({'border': '1px solid transparent'});
	$('.personal-area-form')[0].reset();
	grecaptcha.reset();
	$('.sbmt-button').fadeIn('fast');
	$('.my-input').fadeIn('fast');
	$('.g-recaptcha').fadeIn('fast');
	$('.forgot-btn').fadeIn('fast');
	$('.login-register-btn').fadeIn('fast');
	$('.back-btn').fadeOut('fast');
	$('.header').text('Sign Up');
	$('.sbmt-button').text('Sign Up');
	$('.switch0').text('Sign in');
	if (/sub/i.test(src)){
	  $('#password').hide();
	}
}