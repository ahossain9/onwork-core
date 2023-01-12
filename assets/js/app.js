(function($) {
    "use strict";

    // select2
    $('.multiple-select').select2({
        tags: true
    });

    $('#create-project').on('click', function(event) {
        // $('#create-project-form').addClass('processing-loader');
        event.preventDefault();
        $.ajax({
            url: OnworkCore.ajaxurl,
            type: 'POST',
            data: {
                action: 'onwork_ajax_create_project',
                project_id: $(this).attr('data-project-id'),
                nonce: $(this).attr('data-nonce'),
                project_data: $("form#create-project-form").serialize()
            },
            success: function(response) {
                if (response.success == true) {
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message
                    });
                    // $('#create-project-form').removeClass('processing-loader');
                    window.location = response.data.projects_url;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response.data.message
                    });
                }
            }
        });
    });

    // Create Project
        // $('#create-project-form').on('submit', function(event) {
        //     event.preventDefault();

        //     var data = $(this).serialize();

        //     $.post(OnworkCore.ajaxurl, data, function(response){
        //         if(response.success){
        //             console.log(response.success);
        //         } else{
        //             alert(response.data.message);
        //         }
        //     })
        //     .fail(function(){
        //       alert('Something Went Wrong');
        //     })

            // $.ajax({
            //     url: prolancerAjaxUrlObj.ajaxurl,
            //     type: 'POST',
            //     data: {
            //         action: 'prolancer_ajax_create_project',
            //         project_id: $(this).attr('data-project-id'),
            //         nonce: $(this).attr('data-nonce'),
            //         project_data: $("form#create-project-form").serialize()
            //     },
            //     success: function(response) {
            //         if (response.success == true) {
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: response.data.message
            //             });
            //             $('#create-project-form').removeClass('processing-loader');
            //             window.location = response.data.projects_url;
            //         } else {
            //             Swal.fire({
            //                 icon: 'error',
            //                 title: response.data.message
            //             });
            //         }
            //     }
            // });
        // });
  })(jQuery);