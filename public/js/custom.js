//Change goal satus
jQuery("#registerBtn").on('click',function() {    
    var name = jQuery('#m_name').val();
    var email = jQuery('#m_email').val();
    var password = jQuery('#m_pwd').val();
    var password_confirmation = jQuery('#m_confirm-pwd').val();
    var country = jQuery('#m_country').val();
    var age = jQuery('#m_age').val();
    jQuery.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    jQuery.ajax({
        type: "post",
        url: register_route,
        data:{name:name,email:email,password:password,password_confirmation:password_confirmation,country:country,age:age},
        success: function (response) { 
           
            if (response.status == 'Success') {
                var active = $('.wizard .nav-tabs li.active');
                active.next().removeClass('disabled');
                nextTab(active);
            }else{
               
            }
        },
        error: function(xhr){
            console.error('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    });
});

jQuery(document).ready(function () {
           
    jQuery('.nav-tabs > li a[title]').tooltip();
    //Wizard
    jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target);
        if (target.parent().hasClass('disabled')) {
            return false;
        }
    });
    jQuery(".next-step").click(function (e) {
        var active = $('.wizard .nav-tabs li.active');
        active.next().removeClass('disabled');
        nextTab(active);
    });
    jQuery(".prev-step").click(function (e) {
        var active = $('.wizard .nav-tabs li.active');
        prevTab(active);
    });
});

function nextTab(elem) {
    jQuery(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    jQuery(elem).prev().find('a[data-toggle="tab"]').click();
}

$('.nav-tabs').on('click', 'li', function () {
    jQuery('.nav-tabs li.active').removeClass('active');
    jQuery(this).addClass('active');
});