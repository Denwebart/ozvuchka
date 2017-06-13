<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('admin::layout')

@section('content')
    @yield('settingsContent')
@endsection

@push('styles')
<!-- Switchery -->
<link rel="stylesheet" href="{{ asset('backend/plugins/switchery/switchery.min.css') }}">
<!-- X editable -->
<link href="{{ asset('backend/plugins/bootstrap-xeditable/css/bootstrap-editable.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- File Upload - Dropify -->
<link href="{{ asset('backend/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<!-- Switchery -->
<script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
<!-- Xeditable -->
<script src="{{ asset('backend/plugins/moment/moment.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/plugins/bootstrap-xeditable/js/bootstrap-editable.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/pages/jquery.xeditable.init.js') }}" type="text/javascript"></script>
<!-- File Upload - Dropify -->
<script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>
@endpush

@push('scriptsBottom')
<script type="text/javascript">
    // Xeditable
    //modify Xeditable style
    $.fn.editableform.buttons =
        '<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="zmdi zmdi-check"></i></button>' +
        '<button type="button" class="btn editable-cancel btn-sm waves-effect"><i class="zmdi zmdi-close"></i></button>';

    $.fn.editableform.template =
        '<form class="form-inline editableform"><div class="control-group"><div><div class="editable-input"></div><div class="editable-buttons"></div></div><span class="error help-block text-danger font-12"><strong class="editable-error-block"></strong></span></div></form>';

    $.fn.editableform.defaults.params = function (params) {
        params._token = $("meta[name='csrf-token']").attr('content');
        return params;
    };

    // Edit settings
    function getSettingsEditableOptions() {
        return {
            url: "{{ route('admin.settings.setValue') }}",
            mode: 'inline',
            prepend: false,
            emptytext: 'не задано',
            ajaxOptions: {
                dataType: 'json',
                sourceCache: 'false',
                type: 'POST'
            },
            success: function(response, newValue) {
                if(response.success) {
                    notification(response.message, 'success');
                    if(response.table == 'team_members' || response.table == 'partners') {
                        var socialLinkButton = $('.social-links-' + response.table + '-' + response.itemId)
                            .find('.button-' + response.fieldName);
                        socialLinkButton.attr('href', response.fieldValue);
                        if(response.fieldValue) { socialLinkButton.show() } else { socialLinkButton.hide()};
                    }
                    return true;
                } else {
                    notification(response.message, 'error');
                    return response.error;
                }
                return false;
            }
        }
    }
    $('.editable-text').editable(getSettingsEditableOptions());

    // Change active status or boolean value
    $(document).on('change', '.ajax-checkbox', function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var value = 0;
        if($(this).is(':checked')) {
            value = 1;
        }
        var url = $(this).data('url') ? $(this).data('url') : "{{ route('admin.settings.setIsActive') }}";
        $.ajax({
            url: url,
            dataType: "text json",
            type: "POST",
            data: {id: $(this).data('id'), value: value, name: $(this).attr('name')},
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response) {
                if(response.success){
                    notification(response.message, 'success');
                } else {
                    notification(response.message, 'error');
                }
            }
        });
    });

    // Image Uploader
    function initDropifyAjax() {
        var dropifyAjax = $('.dropify-ajax').dropify(dropifyOptions);

        // Uploading image
        dropifyAjax.on('dropify.fileReady', function(event, element) {
            var itemId = $(this).data('itemId');
            var url = $(this).data('uploadUrl') ? $(this).data('uploadUrl') : "{{ route('admin.settings.uploadImage') }}";
            var data = new FormData();
            data.append("id", itemId);
            data.append("image", $(this)[0].files[0]);
            $.ajax({
                url: url,
                dataType: "json",
                processData: false,
                contentType: false,
                type: "POST",
                data: data,
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
//                var $imageContainer = $('[data-image-item-id="' + itemId + '"]');
//                $imageContainer.removeClass('has-error');
//                $imageContainer.find('.error .text').text('');

                    if(response.success){
                        notification(response.message, 'success');
                    } else {
                        notification(response.message, 'error');

//                    $imageContainer.addClass('has-error');
//                    $imageContainer.find('.error .text').text(response.error);
                    }
                }
            });
        });

        // Deleting image
        dropifyAjax.on('dropify.beforeClear', function(event, element) {
            var itemId = $(this).data('itemId');
            var url = $(this).data('deleteUrl') ? $(this).data('deleteUrl') : "{{ route('admin.settings.deleteImage') }}";
            $.ajax({
                url: url,
                dataType: "text json",
                type: "POST",
                data: {id: itemId},
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success){
                        notification(response.message, 'success');

//                    var $imageContainer = $('[data-image-item-id="' + itemId + '"]');
//                    $imageContainer.removeClass('has-error');
//                    $imageContainer.find('.error .text').text('');
                    } else {
                        notification(response.message, 'error');
                    }
                }
            });
        });
    }

    // Init Ajax Image Uploader
    initDropifyAjax();

</script>
@endpush