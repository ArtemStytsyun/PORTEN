$(document).ready(function() {
	let registrationButton = $('#registration');
	let loginButton = $('#login');
	let registrationForm = $('#form__registration');
	let loginForm = $('#form__login');

	registrationButton.on('click',function(){
		registrationForm.css({"display":"block", 'display':'flex'})
		loginForm.css("display","none")
		registrationButton.addClass('button__active')
		loginButton.removeClass('button__active')
		$('h1').html("Регистрация");
	})

	loginButton.on('click', function(){
		loginForm.css({"display":"block", 'display':'flex'})
		registrationForm.css("display","none")
		loginButton.addClass('button__active')
		registrationButton.removeClass('button__active')
		$('h1').html("Войти");
	})

});