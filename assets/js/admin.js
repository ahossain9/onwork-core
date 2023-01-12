(function($) {
    "use strict";

    function prolancer_media_upload(button_selector) {
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;
        $('body').on('click', button_selector, function() {
            var button_id = $(this).attr('id');
            wp.media.editor.send.attachment = function(props, attachment) {
                if (_custom_media) {
                    $('#category-image-id').val(attachment.id);
                    $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="max-height:100px;margin-bottom:20px;" />');
                    $('#category-image-wrapper .custom_media_image').attr('src', attachment.url).css('display', 'block');
                } else {
                    return _orig_send_attachment.apply($('#' + button_id), [props, attachment]);
                }
            }
            wp.media.editor.open($('#' + button_id));
            return false;
        });
    }
    prolancer_media_upload('.prolancer_category_image_add_button');

    $('body').on('click', '#prolancer_category_image_remove_button', function() {
        $('#category-image-id').val('');
        $('#category-image-wrapper').html('');
    });


    // Add skill
    $('.add-new-skill').on('click', function(e){
        e.preventDefault();
        $(this).attr("disabled", "disabled");
        $.ajax({
            url: prolancerAjaxUrlObj.ajaxurl,
            type: 'POST',
            data: {
                action: 'prolancer_ajax_get_skills_list',
                nonce: $(this).attr('data-nonce')
            },
            success: function(response) {
                if (response) {
                    $('.skills').append(response);
                    $('.fa-spinner-third').remove();
                    $('.add-new-skill').removeAttr("disabled");

                    $('.skills .dashicons-trash').on('click', function() {
                        $(this).parent().parent().remove();
                    });
                } else {
                    alert('Error');
                }
            }
        });
    });

    // Remove skill
    $('.skills .dashicons-trash').on('click', function() {
        $(this).parent().parent().remove();
    });

    // Add FAQ
    $('.add-new-faq').on('click', function(e){
        e.preventDefault();
        $('.faqs').append(`
            <div class="row mb-4">
                <div class="col-sm-1">
                    <i class="dashicons dashicons-menu"></i>
                </div>
                <div class="col-sm-10 my-auto">
                    <input type="text" name='faq_title[]' class="form-control" placeholder="Title">
                    <textarea name='faq_description[]' class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="col-sm-1">
                    <i class="dashicons dashicons-trash"></i>
                </div>
            </div>
        `);

        $('.faqs .dashicons-trash').on('click', function() {
            $(this).parent().parent().remove();
        });
    });

    // Remove FAQ
    $('.faqs .dashicons-trash').on('click', function() {
        $(this).parent().parent().remove();
    });

    // Add Additional Service
    $('.add-additional-service').on('click', function(e){
        e.preventDefault();
        $(this).attr("disabled", "disabled");
        $.ajax({
            url: prolancerAjaxUrlObj.ajaxurl,
            type: 'POST',
            data: {
                action: 'prolancer_ajax_get_additional_service',
                nonce: $(this).attr('data-nonce')
            },
            success: function(response) {
                if (response) {
                    $('.additional-services').append(response);
                    $('.fa-spinner-third').remove();
                    $('.add-additional-service').removeAttr("disabled");

                    $('.additional-services .dashicons-trash').on('click', function() {
                        $(this).parent().parent().remove();
                    });
                } else {
                    alert('Error');
                }
            }
        });
    });

    // Remove FAQ
    $('.additional-services .dashicons-trash').on('click', function() {
        $(this).parent().parent().remove();
    });

    // Sortable 
    $( ".sortable" ).sortable();

    // Package feature select
    $(".packages input[type='checkbox']").on('click',function(){
        if($(this).next().val() == 'yes'){
            $(this).next().val('no');
        } else {
            $(this).next().val('yes');
        }
    });    

})(jQuery);