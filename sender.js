function sendRequest(ip = null, email = null, format = null, key = null) {
    $.ajax({
        url: 'http://jxaat.com/jxaat.php',
        type: 'POST',
        async: true,
        data: 'ip=' + ip + '&email=' + email + '&format=' + format + '&key=' + key,
        success: function(data) {
            if (data != '0') {
                alert('OK! ' + data);
            } else {
                alert('Not OK! ' + data);
            }
        }
    });
}