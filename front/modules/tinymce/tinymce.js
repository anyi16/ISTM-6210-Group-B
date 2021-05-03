

layui.define(['jquery'],function (exports) {
    var $ = layui.$

    var modFile = layui.cache.modules['tinymce'];

    var modPath = modFile.substr(0, modFile.lastIndexOf('.'))

    var setter = layui.setter || {}

    var response = setter.response || {}

 

    var settings = {
        base_url: modPath
        , images_upload_url: '/rest/upload'
        , language: 'zh_CN'
        , response: {
            statusName: response.statusName || 'code'
            , msgName: response.msgName || 'msg'
            , dataName: response.dataName || 'data'
            , statusCode: response.statusCode || {
                ok: 0
            }
        }
        , success: function (res, succFun, failFun) {
            if (res[this.response.statusName] == this.response.statusCode.ok) {
                succFun(res[this.response.dataName]);
            } else {
                failFun(res[this.response.msgName]);
            }
        }
    };

    

    var t = {};

   
    t.render = function (option,callback) {

        var admin = layui.admin || {}

        option.base_url = option.base_url ? option.base_url : settings.base_url

        option.language = option.language ? option.language : settings.language

        option.selector = option.selector ? option.selector : option.elem

        option.quickbars_selection_toolbar = option.quickbars_selection_toolbar ? option.quickbars_selection_toolbar : 'cut copy | bold italic underline strikethrough '

        option.plugins = option.plugins ? option.plugins : 'quickbars print preview searchreplace autolink fullscreen image link media codesample table charmap hr advlist lists wordcount imagetools indent2em';

        option.toolbar = option.toolbar ? option.toolbar : 'undo redo | forecolor backcolor bold italic underline strikethrough | indent2em alignleft aligncenter alignright alignjustify outdent indent | link bullist numlist image table codesample | formatselect fontselect fontsizeselect';

        option.resize = false;

        option.elementpath = false

        option.branding = false;

        option.contextmenu_never_use_native = true;

        option.menubar = option.menubar ? option.menubar : 'file edit insert format table';

        option.images_upload_url = option.images_upload_url ? option.images_upload_url : settings.images_upload_url;

        option.images_upload_handler = option.images_upload_handler? option.images_upload_handler : function (blobInfo, succFun, failFun) {

            var formData = new FormData();

            formData.append('target', 'edit');

            formData.append('edit', blobInfo.blob());

            var ajaxOpt = {

                url: option.images_upload_url,

                dataType: 'json',

                type: 'POST',

                data: formData,

                processData: false,

                contentType: false,

                success: function (res) {

                    settings.success(res, succFun, failFun)

                },
                error: function (res) {

                    failFun("Network error:" + res.status);

                }
            };

            if (typeof admin.req == 'function') {

                admin.req(ajaxOpt);

            } else {

                $.ajax(ajaxOpt);

            }
        }

        option.menu = option.menu ? option.menu : {
            file: {title: 'file', items: 'newdocument | print preview fullscreen | wordcount'},
            edit: {title: 'edit', items: 'undo redo | cut copy paste pastetext selectall | searchreplace'},
            format: {
                title: 'format',
                items: 'bold italic underline strikethrough superscript subscript | formats | forecolor backcolor | removeformat'
            },
            table: {title: 'form', items: 'inserttable tableprops deletetable | cell row column'},
        };
        if(typeof tinymce == 'undefined'){

            $.ajax({
                url: option.base_url + '/tinymce.js',

                dataType: 'script',

                cache: true,

                async: false,
            });

        }

        layui.sessionData('layui-tinymce',{

            key:option.selector,

            value:option

        })

        tinymce.init(option);

        if(typeof callback == 'function'){

            callback.call(option)

        }

        return tinymce.activeEditor;
    };

    t.init = t.render

    
    t.get = (elem) => {

        if(elem && /^#|\./.test(elem)){

            var id = elem.substr(1)

            var edit = tinymce.editors[id];

            if(!edit){

                return console.error("Editor not loaded")

            }

            return edit

        } else {

            return console.error("elem error")

        }
    }

    
    t.reload = (option,callback) => {
        option = option || {}

        var edit = t.get(option.elem);

        var optionCache = layui.sessionData('layui-tinymce')[option.elem]

        edit.destroy()

        $.extend(optionCache,option)

        tinymce.init(optionCache)

        if(typeof callback == 'function'){

            callback.call(optionCache)

        }

        return tinymce.activeEditor;
    }


    exports('tinymce', t);
});
