
$( document ).ready(function() {
    $('#confirm_email').on('keyup', function () {
	    if ($('#email').val() != $('#confirm_email').val()) {
	       $('#pass_message').html('Incorrect email match. Please edit').css('color', 'red');
	    }
	});

	$('input[type=submit]').click(function(e){
		if($('#email').val() != $('#confirm_email').val())
			{
				$('#pass_message').html('Incorrect email match. Please edit').css('color', 'red');
				return false;
			}
		});
});
