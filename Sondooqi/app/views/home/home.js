function register(){
    $.post(webhost+"/user/register", $("form.user-register").serialize())
    .done(function(d){
		$("form.user-register .errors-box").empty();
		var response_json = d;
		if(response_json['goto'] != "")
			window.location = response_json['goto'];
    })
    .fail(function(d){
        $("form.user-register .errors-box").empty();
        var response_json = JSON.parse(d.responseText);
        $.each(response_json['errors'], function(i, v){
			if(i) $("form.user-register .errors-box").append("<br/>");
            $("form.user-register .errors-box").append(v);
        });        
    });
};