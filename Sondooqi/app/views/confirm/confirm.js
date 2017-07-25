function confirm(){
    var formSelector = "form#user-confirm";
    $.post(webhost+"/user/confirmUser", $(formSelector).serialize())
    .done(function(d){
		$(formSelector+" .errors-box").empty();
		var response_json = d;
        $("div.success-msg").css('display', 'inline');
        setTimeout(function(){
        if(response_json['goto'] != "")
			window.location = response_json['goto'];
        }, 2000);
    })
    .fail(function(d){
		$(formSelector+" .errors-box").empty();
		var response_json = JSON.parse(d.responseText);
        $.each(response_json['errors'], function(i, v){
			if(i) $(formSelector+" .errors-box").append("<br/>");
            $(formSelector+" .errors-box").append(v);
		});    
    });
};

function resend(){
    var buttonContainer = $("#resend-btn-container");
    $.post(webhost+"/user/resendCode")
    .done(function(d){
        var msg = "<span style='color: green'>تمت إعادة الإرسال.</span>";
        buttonContainer.empty();
        buttonContainer.append(msg);
    })
    .fail(function(d){
        buttonContainer.empty();
		var response_json = JSON.parse(d.responseText);
        $.each(response_json['errors'], function(i, v){
			if(i) buttonContainer.append("<br/>");
            buttonContainer.append("<span style='color: red'>"+v+"</span>");
        }); 
        buttonContainer.append("<br/>");
        buttonContainer.append("<span style='color: red'>أعد تحميل الصفحة</span>");        
    });
};

function change(){
    var formSelector = "form#change-mobile-form";
    $.post(webhost+"/user/changeMobile", $(formSelector).serialize())
    .done(function(d){
		$(formSelector+" .errors-box").empty();
        var response_json = d;
        $("div.success-change-msg").css('display', 'block');
        window.location.reload();        
    })
    .fail(function(d){
		$(formSelector+" .errors-box").empty();
		var response_json = JSON.parse(d.responseText);
        $.each(response_json['errors'], function(i, v){
			if(i) $(formSelector+" .errors-box").append("<br/>");
            $(formSelector+" .errors-box").append(v);
		});    
    });
};