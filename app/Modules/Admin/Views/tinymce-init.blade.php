<?php
if(!isset($watermark)) {
	$watermark = 1;
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        // Wysiwig Editor - TinyMCE
        if($(".editor").length > 0){
            tinymce.init({
                language: 'ru',
                selector: "textarea.editor",
                theme: "modern",
                height:300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                toolbar2: "print preview media | forecolor backcolor emoticons",
//                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ],
                image_advtab: true,
                image_title: true,
                imagetools_toolbar: 'imageoptions',
                relative_urls: false,
                remove_script_host : true,
                convert_urls : false,
                paste_text_sticky: true,
                paste_text_sticky_default: true,
                valid_styles: {
                    '*': 'float,text-align,border,margin,margin-left,margin-right,margin-top,margin-bottom,padding,padding-right,padding-top,padding-bottom,width,height,background-color,color'
                },
//                valid_elements : 'h2,h3,h4,h5,h6,em,a[href|target=_blank],strong/b,br,p,ul,ol,li,img[src|width],blockquote,iframe[width|height|src|frameborder|allowfullscreen]',
                file_browser_callback : function (field_name, url, type, win) {
                    if (type == 'file' || type == 'media') {
                        return false;
                    }

                    $("input[name='editorImage']").trigger('click');

                    $('#editorImage').change(function () {
                        var fileData = new FormData();
                        fileData.append('image', $('#editorImage')[0].files[0]);
                        fileData.append('tempPath', $('#tempPath').val());

                        $.ajax({
                            type: 'POST',
                            url: '<?php echo URL::route('uploadIntoTemp', ['watermark' => $watermark]) ?>',
                            data: fileData,
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            beforeSend: function(request) {
                                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                            },
                            success: function(response) {
                                if(response.success) {
                                    win.document.getElementById(field_name).value = response.imageUrl;
                                    $('#tempPath').val(request.tempPath);
                                }
                            }
                        });
                    });
                },
                setup: function (editor) {
                    editor.on('init', function(args) {
                        editor.getDoc().body.style.fontSize = '14px';
                        editor.getDoc().body.style.fontFamily = '"Open Sans", sans-serif';
                        editor.getDoc().body.style.lineHeight = '1.42857';

                        editor = args.target;

                        editor.on('NodeChange', function(e) {
                            if (e && e.element.nodeName.toLowerCase() == 'img') {
                                width = e.element.width;
                                height = e.element.height;
                                tinyMCE.DOM.setAttribs(e.element, {'width': null, 'height': null});
                                tinyMCE.DOM.setAttribs(e.element,
                                    {'style': 'width:' + width + 'px; height:' + height + 'px;'});
                            }
                        });
                    });
                    editor.on('focus', function(e) {
                        $('.editor').parent().find('.error').text('');
                        $('.editor').parent().removeClass('has-error');
                    });
                }
            });

//            window.onload = function() {
//                $('[aria-label="Insert/edit image"]').addClass('tinymce-insert-image');
//                $('[aria-label="Insert/edit video"]').addClass('tinymce-insert-video');
//                $('[aria-label="Insert/edit link"]').addClass('tinymce-insert-link');
//            };
        }

        /*
        tinymce.init({
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern imagetools"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons",
            image_advtab: true,
            image_title: true,
            imagetools_toolbar: 'imageoptions',
            relative_urls: false,
            remove_script_host : true,
            convert_urls : false,
            paste_text_sticky: true,
            paste_text_sticky_default: true,
            file_browser_callback : function (field_name, url, type, win) {
                if (type == 'file' || type == 'media') {
                    return false;
                }

                $("input[name='editor_image']").trigger('click');

                $('#editor_image').change(function () {
                    var fileData = new FormData();
                    fileData.append('image', $('#editor_image')[0].files[0]);
                    fileData.append('tempPath', $('#tempPath').val());

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo URL::route('uploadIntoTemp', ['watermark' => $watermark]) ?>',
                        data: fileData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        beforeSend: function(request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function(response) {
                            if(response.success) {
                                win.document.getElementById(field_name).value = response.imageUrl;
                                $('#tempPath').val(request.tempPath);
                            }
                        }
                    });
                });
            },
            setup: function (editor) {
                editor.on('init', function(args) {
                    editor.getDoc().body.style.fontSize = '14px';
                    editor.getDoc().body.style.fontFamily = '"Open Sans", sans-serif';
                    editor.getDoc().body.style.lineHeight = '1.42857';

                    editor = args.target;

                    editor.on('NodeChange', function(e) {
                        if (e && e.element.nodeName.toLowerCase() == 'img') {
                            width = e.element.width;
                            height = e.element.height;
                            tinyMCE.DOM.setAttribs(e.element, {'width': null, 'height': null});
                            tinyMCE.DOM.setAttribs(e.element,
                                {'style': 'width:' + width + 'px; height:' + height + 'px;'});
                        }
                    });
                });
                editor.on('focus', function(e) {
                    $('.editor').parent().find('.error').text('');
                    $('.editor').parent().removeClass('has-error');
                });
            }
        });

        window.onload = function() {
            $('[aria-label="Insert/edit image"]').addClass('tinymce-insert-image');
            $('[aria-label="Insert/edit video"]').addClass('tinymce-insert-video');
            $('[aria-label="Insert/edit link"]').addClass('tinymce-insert-link');
        };
        */
    });
</script>