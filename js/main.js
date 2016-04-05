$(document).ready(function() {
	$('#post_form').submit(function(){
		$.post("<?= _post.php ?>", $("#post_form").serialize(),  function(response) {
			$('#post_form').hide('slow');
			$('#post_form_success').html(response);
		});
		return false;
	});
});