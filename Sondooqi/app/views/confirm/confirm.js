function confirm(){
    var formSelector = "form#user-confirm";
    $.post(webhost+"/user/confirmUser", $(formSelector).serialize())
    .done(function(d){
        console.log(d);
		$(formSelector+" .errors-box").empty();
		var response_json = d;
        //if(response_json['goto'] != "");
			//window.location = response_json['goto'];
    })
    .fail(function(d){
		$(formSelector+" .errors-box").empty();
		var response_json = JSON.parse(d.responseText);
        $.each(response_json['errors'], function(i, v){
			if(i) $(formSelector+" .errors-box").append("<br/>");
            $(formSelector+" .errors-box").append(v);
		});    
    });
    return false;
};