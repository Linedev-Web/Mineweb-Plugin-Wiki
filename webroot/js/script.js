$(document).ready(function () {
    let kvp = document.location['pathname'];
    let data = kvp.split('&')
    url = {}
    url['element'] = data[0].split('/')[2]
    url['id'] = data[2]
    $button = $('.click-element')
    $button.each(function () {
        if ($(this).data('action') == url.element && $(this).data('id') == url.id) {
            $(this).addClass('active')
            if ($(this).data('action') == 'item') {
                $(this).closest('.collapse').addClass('show').prev().attr('aria-expanded', true)
            }
        }
    })
})

function string_to_slug(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to = "aaaaeeeeiiiioooouuuunc------";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
}