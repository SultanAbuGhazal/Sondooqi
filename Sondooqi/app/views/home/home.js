function register(){    
    $.post(webhost+"/user/register", $("form.user-register").serialize())
    .done(function(d){
        //window.loaction = webhost+"/home/about";
            $("div.errors-box").append("<span style='color: green'>Success!</span>");
    })
    .fail(function(d){
        $("div.errors-box").empty();
        var errors_json = JSON.parse(d.responseText);
        $.each(errors_json, function(i, v){
            if(i) $("div.errors-box").append("<br/>");
            $("div.errors-box").append(v);
        });        
    });
};