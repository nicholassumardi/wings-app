function select2ServerSide(selector, endpoint) {
    $(selector).select2({
        placeholder: '',
        minimumInputLength: 3,
        allowClear: true,
        cache: true,
        dropdownParent: $('body').parent(),
        ajax: {
            url: endpoint,
            type: 'GET',
            dataType: 'JSON',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data.items
                }
            }
        }
    });
}

function notif(type, background, message) {
    new Noty({
        theme: ' alert ' + background + ' text-white alert-styled-left p-0',
        text: message,
        type: type,
        timeout: 1000
    }).show();
}
