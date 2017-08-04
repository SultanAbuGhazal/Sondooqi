function resetPassword(){
	var formSelector = "form.password-reset-form";
    $.post(webhost+"/user/resetPassword", $(formSelector).serialize())
    .done(function(d){
		$(formSelector+" .errors-box").empty();
        $("div.success-reset-msg").css('display', 'block');
        setTimeout(function(){ 
			var response_json = d;
			if(response_json['goto'] != "");
				window.location = response_json['goto'];
        }, 3000);
    })
    .fail(function(d){
		$(formSelector+" .errors-box").empty();
		var response_json = JSON.parse(d.responseText);
        $.each(response_json['errors'], function(i, v){
			if(i) $(formSelector+" .errors-box").append("<br/>");
            $(formSelector+" .errors-box").append(v);
		});   
	});
}