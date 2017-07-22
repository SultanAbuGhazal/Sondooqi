$(document).ready(function(){

$("form#new-item-form").submit(function(e){
    $.ajax({
        url: webhost+"/admin/insertItem",
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (d) {
            $("span#success-insert-msg").css('display', 'inline');
            setTimeout(function(){ 
                $("span#success-insert-msg").css('display', 'none');
            }, 1000);
            $("form#new-item-form").trigger("reset");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown){
            $("span#fail-insert-msg").css('display', 'inline');
            setTimeout(function(){ 
                $("span#fail-insert-msg").css('display', 'none');
            }, 1500);
            var errors = JSON.parse(XMLHttpRequest.responseText).errors;
            console.log("Item Insertion Errors:");
            console.log(errors);
        }
    });
    return false;
});

});