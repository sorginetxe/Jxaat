function ValidateIPaddress(ipaddress) {
    if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ipaddress)) {
        return (true);
    }
    return (false);
}

var input = $('input[name*=ip]');
var error = $('p[class*=error]');
var container = $('p[class*=success]');
var spinner = $('img[class*=loaderGif]');

function sendRequest(ip = null, email = null, format = null, key = null) {
    error.css('display', 'none');
    $.ajax({
        url: 'jxaat.php',
        type: 'POST',
        async: true,
        data: 'ip=' + ip + '&email=' + email + '&format=' + format + '&key=' + key,
        success: function(data) {
            console.log(data);
            spinner.css('display', 'none');
            if (data == '0') {
                error.css('display', 'block');
                container.css('display', 'none');
            } else {
                container.css('display', 'block');
                $('#data').remove();
                container.append('<pre id="data"><b>Result:</b><br>' + data + '</pre>');
            }
        }
    });
}

function run() {
    var val = input.val();
    error.css('display', 'none');
    container.css('display', 'none');
    spinner.css('display', 'none');

    if (val.length) {
        spinner.css('display', 'inline-block');
        if (ValidateIPaddress(val)) {
            sendRequest(val, null, null, null);
        } else {
            spinner.css('display', 'none');
            error.css('display', 'block');
        }
    } else {
        spinner.css('display', 'none');
        error.css('display', 'none');
        container.css('display', 'none');
    }
}

input.on('input', function() {
    run();
});


input.on('keypress', function() {
    if (event.which == '13') {
        event.preventDefault();
    }
});


$('#doc').on('click', function() {
    tog($('div[class=doc]'));
    $('div[class=codes]').hide();
});


$('#codes').on('click', function() {
    tog($('div[class=codes]'));
    $('div[class=doc]').hide();
});

function tog(x) {
    x.toggle();
}

function myIp(ip) {
    $('input[name="ip"]').val(ip);
    run();
}

$(function() {
    url = location.href.toLowerCase();
    if (url.indexOf('me') != -1) {
        alert(url);
    }
});

function reset()
{
    $('input[name="ip"]').val('');
    spinner.css('display', 'none');
    error.css('display', 'none');
    container.css('display', 'none');
}