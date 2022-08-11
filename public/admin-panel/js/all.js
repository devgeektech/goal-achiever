//Change goal satus
jQuery("#change_status").on('click',function() {        
    jQuery.ajax({
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

/**
 * Update Goal Documents,Videos,Exam Documents
 */
jQuery(".document_edit").on('click',function() { 
    jQuery("#doc_type").val($(this).attr('data-type'));
    jQuery("#doc_id").val($(this).attr('data-id'));
    jQuery('#add_doc').modal('show');
});

/**
 * Get Units and Topics dropdown
 */

$(document).ready(function () {
    
    var is_plan = $('#is_plan').val();
    var is_plan_expire = $('#plan_expire').val();
    if((is_plan == 2) || (is_plan_expire == 1)){
        $('#myModal').modal('show');
    }
    $("#subject_id").val($('#subject').val());
   
    $('#subject').on('change', function () {
        var subject_id = $(this).val();
        $("#subject_id").val(subject_id);
        $('#unit').html('');
        
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
            url: get_units,
            data:{ subject_id:subject_id},
            type: "POST",
            success: function (res) {
                $.each(res, function (key, value) {
                    $('#unit').append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
                $('#topic').html('<option value="">Select Topic</option>');
            }
        });
    });

/**
 * Get Topics on unit change
 */
    $('#unit').on('change', function () {
        var unit_id = $(this).val();
        var subject_id = $("#subject_id").val();
        $('#topic').html('');
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
            url: get_topics,
            data:{ subject_id:subject_id,unit_id:unit_id},
            type: "POST",
            success: function (res) {
                $.each(res, function (key, value) {
                    $('#topic').append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
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
                    $('.subscription-type').append('<div class="btn-wrapper"><input type="radio" name="subscription_type" id="option-1" value="manual" checked><input type="radio" name="subscription_type" id="option-2" value="auto"><label for="option-1" class="option option-1"><span>Manual</span></label><label for="option-2" class="option option-2"><span>Auto</span></label></div>');
                }
            });
        }
        $("#plan_months").val(get_months);
        $("#plan_name").val(get_plan_name);
        $("#plan_price").val(get_plan_price);
        $("#total_amount").text('$'+get_plan_price);

        

    });
/**
 * Steps functionality
 */
 // ------------step-wizard-------------
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
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }
    $('.nav-tabs').on('click', 'li', function () {
        $('.nav-tabs li.active').removeClass('active');
        $(this).addClass('active');
    });

    jQuery("#plan_form").validate({
          submitHandler: function(form) {
            form.submit();
          }
     });
     
});
