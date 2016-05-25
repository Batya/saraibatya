var __El = (function($) {
    var getUrl = location.href;
    var urlArr = getUrl.split('.com/');
    var returnUrl = urlArr[0] + '.com/';
    var urlParams = getUrl[1];
    var el = {
        //URL PARAMETERS
        url: returnUrl,
        urlParams: urlArr[1].split('/'),
        api: returnUrl + 'api/',

        modal: function(opt, callback) {
            var m = '',
                modal = '',
                form = (opt.action !== undefined) ? true : false,
                submit = (form) ? '" type="submit' : ' modal-close" id="modal-true',
                submitBtn = (opt.submit !== undefined)?opt.submit:'Ok',
                header = (opt.header !== undefined) ? '<h4>' + opt.header + '</h4>' : '',
                enctype = (opt.enctype !== undefined) ? ' enctype="' + opt.enctype + '"' : '',
                footerFixed = (opt.footerFixed !== undefined && opt.footerFixed == true) ? ' modal-fixed-footer' : '';
            if (form) {
                if (opt.type == undefined) {
                    alert('You must define a "type" for the form.');
                }
            }
            // MODAL WRAPPER
            modal += '<div id="modal-popup" class="modal' + footerFixed + '">';
            modal += '</div>';

            // MODAL CONTENTS
            m += (form) ? '<form id="modalForm" action="' + opt.action + '" method="' + opt.type + '"' + enctype + '>' : '';
            m += '<div class="modal-content">';
            m += header;
            m += opt.content;
            m += '</div>';
            m += '<div class="modal-footer">';
            m += '<a href="#" id="modal-false" class="modal-action modal-close waves-effect waves-red btn-flat">Close</a>';
            if(opt.submit !== undefined)
                if(form)
                    m+='<button type="sumbit" class="btn btn-flat white waves-green modal-action modal-close">'+submitBtn+'</button>';
                else m += '<a href="#" class="modal-action waves-effect waves-green btn-flat modal-close" id="modal-true">'+submitBtn+'</a>';
            m += '</div>';
            m += (form) ? '</form>' : '';

            if ($("#modal-popup").length > 0) {
                $("#modal-popup").html(m);
            } else {
                $('body').append(modal);
                $("#modal-popup").html(m);
            }
            $("#modal-popup").openModal();
            $('#modal-true').on('click', function(ev) {
                ev.preventDefault();
                callback(true);
            });
            $('#modal-false').on('click', function(ev) {
                ev.preventDefault();
                callback(false);
            });
            if (form)
                $("#modalForm").submit(function(ev) {
                    ev.preventDefault();
                    $("#modal").closeModal();
                    callback($(this));
                });
        },

        bottomSheet: function(opt, callback) {
            var m = '',
                modal = '',
                form = (opt.action !== undefined) ? true : false,
                submit = (form) ? '" type="submit' : ' modal-close" id="modal-true',
                header = (opt.header !== undefined) ? '<h4>' + opt.header + '</h4>' : '',
                enctype = (opt.enctype !== undefined) ? ' enctype="' + opt.enctype + '"' : '',
                footerFix = (opt.footerFix !== undefined) ? ' modal-fixed-footer' : '';
            if (form) {
                if (opt.type == undefined) {
                    alert('You must define and "type" for the form.');
                }
            }
            // MODAL WRAPPER
            modal += '<div id="modal-bottom-sheet" class="modal bottom-sheet">';
            modal += '</div>';

            // MODAL CONTENTS
            m += (form) ? '<form id="modalForm" action="' + opt.action + '" method="' + opt.type + '"' + enctype + '>' : '';
            m += '<div class="modal-content">';
            m += header;
            m += opt.content;
            m += '</div>';
            m += '<div class="modal-footer">';
            m += '<a href="#" id="modal-false" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>';
            m += '<a href="#" class=" modal-action modal-close waves-effect waves-green btn-flat' + submit + '">Agree</a>';
            m += '</div>';
            m += (form) ? '</form>' : '';

            if ($("#modal-bottom-sheet").length > 0) {
                $("#modal-bottom-sheet").html(m);
            } else {
                $('body').append(modal);
                $("#modal-bottom-sheet").html(m);
            }
            $("#modal-bottom-sheet").openModal();
            $('#modal-true').on('click', function(ev) {
                ev.preventDefault();
                callback(true);
            });
            $('#modal-false').on('click', function(ev) {
                ev.preventDefault();
                callback(false);
            });
            if (form)
                $("#modalForm").submit(function(ev) {
                    ev.preventDefault();
                    $("#modal").closeModal();
                    callback($(this));
                });
        },

        spinner: function(size) {
            var s = '';
            size = (size === undefined) ? '' : size;
            s += '<div style="margin: 0 auto;">';
            s += '<div class="preloader-wrapper ' + size + ' active">';
            s += '<div class="spinner-layer spinner-red-only">';
            s += '<div class="circle-clipper left">';
            s += '<div class="circle"></div>';
            s += '</div><div class="gap-patch">';
            s += '<div class="circle"></div>';
            s += '</div><div class="circle-clipper right">';
            s += '<div class="circle"></div></div></div></div></div>';
            return s;
        },
        determinate: function(percent) {
            var s = '';
            percent = (percent === undefined) ? 0 : percent;
            s += '<div class="progress">';
            s += '<div class="determinate" style="width: ' + percent + '%"></div>';
            s += '</div>';
            return s;
        },
        indeterminate: function() {
            var s = '';
            s += '<div class="progress">';
            s += '<div class="indeterminate"></div>';
            s += '</div>';
            return s;
        },
        nl2br: function(str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }
    };

    return el;

})(jQuery);