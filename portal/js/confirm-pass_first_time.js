
$( document ).ready(function() {
    $('#confirm_password').on('keyup', function () {
	    if ($('#password').val() == $('#confirm_password').val()) {
	        $('#pass_message').html('Correct matching password').css('color', 'green');
	    } else $('#pass_message').html('Incorrect password match. Please edit').css('color', 'red');
	});

	$('input[type=submit]').click(function(e){
		if ($('#password').val() == "") {
			$('#pass_message').html('Password cannot be empty').css('color', 'red');
			return false;
		} else if ($('#password').val() != $('#confirm_password').val())
			{
			return false;
			}
		});
});
