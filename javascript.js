$(document).ready(function() {

	$('body').css('display','block')
	let widthOfBody = $("body").outerWidth();
	if(widthOfBody < 350)
	{
		$(".mailing__group").css({'display':'flex', 'align-items':'start','flex-direction':'column','height':'auto'});
	}


	window.onresize = (event) => {
		widthOfBody = $("body").outerWidth();
	
		if( widthOfBody<=350)
		{
			$(".mailing__group").css({'display':'flex', 'align-items':'start','flex-direction':'column','height':'auto'});
			console.log(widthOfBody);

		}
		else
		{
			$(".mailing__group").css({'display':'flex', 'align-items':'start','flex-direction':'row','height':'auto'});

		}

		if(widthOfBody > 767)
		{
			$("body").css('overflow','auto')
		}
		else
		{
			$("body").css('overflow','hidden')
		}
	}

	$('.submit-form').click(function(){
		  //add the value to be sent to the input in the form
		  $('#link-extra-info input').val( $(this).data('submit') );
		  
		  //the href in the link becomes the action of the form
		  $('#link-extra-info').attr('action', $(this).attr('href'));
		  
		  //submit the form
		  $('#link-extra-info').submit();
		  
		  //return false to cancel the normal action for the click event
		  return false;
	});

	let reg = document.createElement('div');

	$(".header__burger").on('click', function() {
		$(".header__burger,.nav").toggleClass("active")
		$("body").toggleClass('lock')
	});





	//search
	let search__button = $('.search__button');

	search__button.click(function(){
		$(".search__text").toggleClass("search__text-none");

		if($(".search__text").value != null)
		{
			setTimeout(() => {
			$(".search__text").after(search__button)
				if(!search__button.attr('type'))
				{
					search__button.attr({"type":"submit","name":"submit"})
				}
				else
				{
					search__button.removeAttr("type","name")
				}
			},1)
			
			
		}
		else
		{
			setTimeout(() => {
			$(".search__text").parentElement.after(search__button)
				if(!search__button.attr('type'))
				{
					search__button.attr({"type":"submit","name":"submit"})
				}
				else
				{
					search__button.removeAttr("type","name")
				}

			},
			1)
			
		}
	})








})