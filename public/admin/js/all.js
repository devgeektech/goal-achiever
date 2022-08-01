//Change goal satus
$("#change_status").on('click',() => {        
    $.ajax({
        type: "post",
        url: change_goal_status,
        data:{workbooks:value},
        success: function (data) { 
                if(data && data.status =='Success'){
                    
                }else{
                    window.swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                        });
                }                  
        },
        error: function(xhr){
            console.error('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    });
});
