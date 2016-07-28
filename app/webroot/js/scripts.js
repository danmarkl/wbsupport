$.fn.getReply = function(url, body) {
	var $body = $('#'+body);

	$.ajax({
		url: url,
		type: 'get',
		beforeSend: function() {
			$body.html('fetching reply...');
		},
		success: function(response) {
			$body.html(response);
		},
		error: function(err) {
			console.log(err);
		}
	});
}