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
});
