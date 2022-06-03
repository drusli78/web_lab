$.ajax({
    url: 'check_log',
    dataType: 'json',
    success: function (data) {
        if (data['status']) {
            window.location.href = '/authorised';
        }
    }
})