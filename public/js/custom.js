//Change goal satus
jQuery(".registerBtn").on('click',function() {

    var name = jQuery('#m_name').val() != "" ? jQuery('#m_name').val() : jQuery('#name').val();
    var email = jQuery('#m_email').val() != "" ? jQuery('#m_email').val() : jQuery('#email').val();
    var password = jQuery('#m_pwd').val() != "" ? jQuery('#m_pwd').val() : jQuery('#password').val();
    var password_confirmation = jQuery('#m_confirm-pwd').val() != "" ? jQuery('#m_confirm-pwd').val() : jQuery('#confirm-pwd').val();
    var country = jQuery('#m_country').val() != "" ? jQuery('#m_country').val() : jQuery('#country').val();
    var age = jQuery('#m_age').val() != "" ? jQuery('#m_age').val() : jQuery('#age').val();
    var register_from = 'plan';

    var username_error = email_error = password_error = con_password_error = password_match_error = age_error = false;
    if(name == "" || typeof name === "undefined"){
        jQuery(".username_error").html('Please enter name.');
         username_error = false;
    }else{
        jQuery(".username_error").html('');
         username_error = true;
    }
    if(email == "" || typeof email === "undefined"){
        jQuery(".email_error").html('Please enter email.');
         email_error = false;
    }else{
        jQuery(".email_error").html('');
        email_error = true;
    }
    if (password == "" || typeof password === "undefined") {
        $(".password_error").html('Please enter a password.');
         password_error = false;
    }else{
        $(".password_error").html('');
        password_error = true;
    }
    if (password_confirmation == '' || typeof password_confirmation === "undefined") {
        $(".confirm-pwd_error").html('Please re-enter your password.');
         con_password_error = false;
    }else if(password != password_confirmation) {
        $(".confirm-pwd_error").html('Passwords do not match.');
        password_match_error = false;
    }else{
        $(".confirm-pwd_error").html('');
        password_match_error = con_password_error = true;
    }
    if(age == "" || typeof age === "undefined"){
        $(".age_error").html('Please enter age.');
         age_error = false;
    }else{
        $(".age_error").html('');
        age_error = true;
    }

    if((username_error == true) && (email_error == true) && (password_error == true) && (con_password_error == true) && (password_match_error == true) && (age_error == true)){
        jQuery("#membershipModal").modal('show');
        jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        jQuery.ajax({
            type: "post",
            url: register_route,
            data:{
                name:name,
                email:email,
                password:password,
                password_confirmation:password_confirmation,
                country:country,
                age:age,
                register_from:register_from
            },
            beforeSend: function(){
                jQuery('#registerBtn').html("Please wait....");
            },
            success: function (response) {
                if (response.status == 'Success') {
                    jQuery("#get_user_id,#user_id").val(response.user_id);
                    jQuery('#registerBtn').html("Register Now");
                    jQuery('#registerBtn').addClass("btn btn-primary register d-block mx-auto");
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
    }else{
        return false;
    }


});


/**
 * Multistep register form functionality
 */
$(document).ready(function () {

    $('.nav-tabs > li a[title]').tooltip();
    //Wizard
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target);
        if (target.parent().hasClass('disabled')) {
            return false;
        }
    });
    $(".next-step").click(function (e) {
        if($(this).hasClass('subject_button')){
            if( $("input[name='plan_subject']").is(':checked') ){
                var active = $('.wizard .nav-tabs li.active');
                active.next().removeClass('disabled');
                nextTab(active);
                $('.plan_subject_error').text("");
            }
            else{
                $('.plan_subject_error').css('color','red').text("Please choose atleast one subject :)");
                return false;
            }
        }
        if( $("input[name='plan']").is(':checked') ){
            var active = $('.wizard .nav-tabs li.active');
            active.next().removeClass('disabled');
            nextTab(active);
            $('.plan_error').text("");
        }
        else{
            $('.plan_error').css('color','red').text("Please choose atleast one plan :)");
            return false;
        }

    });
    $(".prev-step").click(function (e) {
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



/**
 * Get months of selected plan in register modal
 */
 $('.selct-plan').on('change', function (){
    var get_months = $(this).find(':input').data('months');
    var get_plan_name = $(this).find(':input').data('name');
    var get_plan_price = $(this).find(':input').data('price');
    if(get_plan_price == '1 MONTH OF ACCESS'){
        get_plan_price = 0;
        $.ajax({
            success: function () {
                $('.subscription-type').html("");
                $('.subscription-type').append('<div class="btn-wrapper"><input type="radio" name="subscription_type" id="option-1" value="manual" checked><label for="option-1" class="option option-1"><span>Manual</span></label></div>');
            }
        });
    }else{
        $.ajax({
            success: function () {
                $('.subscription-type').html("");
                $('.subscription-type').append('<div class="btn-wrapper"><input type="radio" name="subscription_type" id="option-1" value="manual" checked><label for="option-1" class="option option-1"><span>Manual</span></label></div>');
            }
        });
    }
    $("#plan_months").val(get_months);
    $("#plan_name").val(get_plan_name);
    $("#plan_price").val(get_plan_price);
    $("#plan_id").val($(this).find(':input').val());
    $("#total_amount").text('$'+get_plan_price);
});

/**
 * Functionality for purchase plan after register process
 */
jQuery('#purchase_plan').on('click', function(){
    var plan_months = jQuery('#plan_months').val();
    var plan_name = jQuery('#plan_name').val();
    var plan_price = jQuery('#plan_price').val();
    var name_on_card = jQuery('#name_on_card').val();
    var cr_no = jQuery('#cr_no').val();
    var cvc_number = jQuery('#cvc_number').val();
    var expiration_month = jQuery('#expiration_month').val();
    var expiration_year = jQuery('#expiration_year').val();
    var subscription_type = jQuery('#option-1').val();
    var plan_id = jQuery('#plan_id').val();
    var goal_id = jQuery('#goal_id').val();
    var subject_id = jQuery('#subject_id').val();
    var unit_id = jQuery('#unit_id').val();
    var topic_id = jQuery('#topic_id').val();
    var user_id = jQuery('#get_user_id').val();
    var end_date = jQuery('#end_date').val();
   
    var card_name_error = card_number_error = cvc_error = exp_month_error = exp_year_error = false;
    if(name_on_card == ""){
        jQuery(".card_name_error").html("Please enter card holder name.");
        card_name_error = false;
    }else{
        jQuery(".card_name_error").html("");
        card_name_error = true;
    }
    if(cr_no == ""){
        jQuery(".card_number_error").html("Please enter card number.");
        card_number_error = false;
    }else{
        jQuery(".card_number_error").html("");
        card_number_error = true;
    }
    if(cvc_number == ""){
        jQuery(".cvc_error").html("Please enter cvc number.");
        cvc_error = false;
    }else{
        jQuery(".cvc_error").html("");
        cvc_error = true;
    }
    if(expiration_month == ""){
        jQuery(".exp_month_error").html("Please enter card expiration month.");
        exp_month_error = false;
    }else{
        jQuery(".exp_month_error").html("");
        exp_month_error = true;
    }
    if(expiration_year == ""){
        jQuery(".exp_year_error").html("Please enter card expiration year.");
        exp_year_error = false;
    }else{
        jQuery(".exp_year_error").html("");
        exp_year_error = true;
    }

    if((card_name_error == true) && (card_number_error == true) && (cvc_error == true) && (exp_month_error == true) &&  (exp_year_error == true)){
        jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        jQuery.ajax({
            type: "post",
            url: purchase_plan_route,
            data:{
                    plan_months:plan_months,
                    plan_name:plan_name,
                    plan_price:plan_price,
                    name_on_card:name_on_card,
                    card_number:cr_no,
                    cvc_number:cvc_number,
                    expiration_month:expiration_month,
                    expiration_year:expiration_year,
                    subscription_type:subscription_type,
                    plan_id:plan_id,
                    user_id:user_id,
                    goal_id:goal_id,
                    subject_id:subject_id,
                    unit_id:unit_id,
                    topic_id:topic_id,
                    end_date:end_date,
                },
           
            beforeSend: function(msg){
                jQuery('#purchase_plan').html("Processing....");
            },
            success: function (response) {
                if(response.status == 'already'){
                    swal("Ooh!", "You have already taken this goal", "warning");
                }
                if (response.status == 'Success') {
                    jQuery("#membershipModal").hide();
                    swal("Good!", "You have successfully purchased '" +plan_name+ "' plan!Now you are redirecting to Student Dashboard!", "success");
                    setTimeout(() => {
                        window.location.href = "/student/dashboard";
                    }, 5000);

                }
                if(response.status == 'failed'){
                    swal("Ooh!", "Something went wrong", "warning");
                }
            },
            error: function(xhr){
                console.error('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }


});


/**
 * Achieve Goal From Frontend Gaols Details Page
 */

jQuery(".achieve_goal").on('click', function(){

    swal("","Please wait......","warning");
    var goal_id = jQuery(this).data('id');
    var subject_id = jQuery(this).data('subject-id');
    var unit_id = jQuery(this).data('unit-id');
    var topic_id = jQuery(this).data('topic-id');
    var end_date = jQuery(this).data('end-date');
    jQuery("#subject_id").val(subject_id);
    jQuery("#unit_id").val(unit_id);
    jQuery("#topic_id").val(topic_id);
    jQuery("#end_date").val(end_date);

    setTimeout(() => {
        jQuery.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            type: "post",
            url: check_auth,
            data:{
                goal_id:goal_id,
                taken_from:'front'
            },

            success: function (response) {
                if(response.status == 'unauthenticated'){
                    jQuery("#goal_id").val(goal_id);
                    jQuery("#membershipModal").modal('show');
                }else{
                    jQuery.ajax({
                        type: "post",
                        url: achieve_goal,
                        data:{
                            goal_id:goal_id,
                            subject_id:subject_id,
                            unit_id:unit_id,
                            topic_id:topic_id,
                            end_date:end_date,
                            taken_from:'front'
                        },
                        success: function (response) {

                            if (response.status == 'Success') {
                                swal("Yeah!", "Goal is taken successfully!", "success");
                            }
                            if (response.status == 'already') {
                                swal("ooh!", "Goal is already taken !", "warning");
                            }
                        },
                        error: function(xhr){
                            console.error('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                        }
                    });
                }
            },
            error: function(xhr){
                console.error('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }, 2000);

});


 /*  submit paper modal */
  $(document).bind('dragover', function (e) {
    var dropZone = $('.zone'),
        timeout = window.dropZoneTimeout;
    if (!timeout) {
        dropZone.addClass('in');
    } else {
        clearTimeout(timeout);
    }
    var found = false,
        node = e.target;
    do {
        if (node === dropZone[0]) {
            found = true;
            break;
        }
        node = node.parentNode;
    } while (node != null);
    if (found) {
        dropZone.addClass('hover');
    } else {
        dropZone.removeClass('hover');
    }
    window.dropZoneTimeout = setTimeout(function () {
        window.dropZoneTimeout = null;
        dropZone.removeClass('in hover');
    }, 100);
});