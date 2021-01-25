request = $.ajax({
    url: 'http://worldclockapi.com/api/jsonp/cet/now?callback=mycallback=?',
    type: 'GET',
    dataType: 'jsonp'       
});
    request.done(function(res) {
        console.log(res);
        // var data = JSON.parse(res);
        var day = res.dayOfTheWeek
        var date = res.currentDateTime
        var dateSplited = date.split("T");
        var time = dateSplited[1].split("+")
        $('#day').text(day);
        $('#time').text(time[0]);
        $('#date').text(dateSplited[0]);
    });