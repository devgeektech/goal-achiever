

/**
 * Update Goal Documents,Videos,Exam Documents
 */
jQuery(".document_edit").on('click',function() {
    jQuery("#doc_type").val($(this).attr('data-type'));
    jQuery("#doc_id").val($(this).attr('data-id'));
    jQuery('#add_doc').modal('show');
});

/**
 * Update Goal Image
 */
 jQuery(".goal_image_edit").on('click',function() {
    jQuery("#goal_id").val($(this).attr('data-id'));
    jQuery('#edit_goal_image').modal('show');
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

                var unit_id = $("#unit").val();
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
  
            }
        });
    });


});
/**
 * Get Topics on unit change
 */
 $(document).ready(function () {
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

$(document).ready(function () {
    /*disable non active tabs*/
    $('.nav-tabs li').not('.active').addClass('disabled');
    /*to actually disable clicking the bootstrap tab, as noticed in comments by user3067524*/
    $('.nav-tabs li').not('.active').find('a').removeAttr("data-toggle");

    $('button').click(function () {

        /*enable next tab*/
        $('.nav-tabs li.active').next('li').removeClass('disabled');
        $('.nav-tabs li.active').next('li').find('a').attr("data-toggle", "tab")
    });
});

/**
 * Chart display in student dashboard
 */
$(document).ready(function(){
    var students = [$('#students').val()];
    var xValues = students.toString().split(', ');
    var yValues = [40, 50, 100, 30, 20];
    var barColors = ["red", "green", "blue", "orange", "brown"];
      new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: ""
        }
      }
    });
  });

/**
 * Uplad Assignments functionality
 */
$(document).ready(function(){
    $('#submit_papers').on('click', function(){
        var get_goal_id = $('#goal_id').val();
        $('#assign_goal_id').val(get_goal_id);
        $('#uploadAssignmentsModal').modal('show');
    });
});

/**
 * Download Document
 */
 $("#goal_document").on('click', function(){
    console.log('clicked');
    return false;
});



/*progress-circle*/

function progressBar(progressVal, totalPercentageVal = 100,progress_text,progress_circle_prog) {
    var strokeVal = (3 * 100) / totalPercentageVal;
    var x = document.querySelector("."+progress_circle_prog);
    x.style.strokeDasharray = progressVal * strokeVal + " 999";
    var el = document.querySelector("."+progress_text);
    var from = $("."+progress_text).data("progress");
    $("."+progress_text).data("progress", progressVal);
    var start = new Date().getTime();

    setTimeout(function () {
        var now = new Date().getTime() - start;
        var progress = now / 700;
        el.innerHTML = (progressVal / totalPercentageVal) * 100 + "%";
        if (progress < 1) setTimeout(arguments.callee, 10);
    }, 10);
    }

    //

    $('.total_percentage').each(function(index, obj)
    {
        let percentage_id = $(this).data('percentage_id');
        progressBar($(this).text(), 100,"progress_text_"+percentage_id,"progress_circle_prog_"+percentage_id);
    });


