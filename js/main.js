// $('#btnChart').click(function () {
//     $('#chartModal').toggle();
//     return false;
// });

$('#btn').click(function () {
    $('#pregled').toggle();
});

$('#btn-obrisi').click(function () {
    const checked = $('input[name=checked-film]:checked');
    request = $.ajax({
        url: 'http://localhost/domaci3/predstave/'+checked.val(),
        type: 'delete',
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response.poruka === 'Predstava je uspešno izbrisana') {
            checked.closest('tr').remove();
            alert('Predstava je obrisana');
            console.log('Obrisan');
        }
        else {
            console.log('Predstava nije obrisana');
            alert('Film nije obrisan');
        }
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });

    
});

$('#btnDodaj').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});

$('#btnIzmeni').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});

$('#dodajForm').submit(function () {
    event.preventDefault();
    console.log("Ovde");
    const $form = $(this);

    var array = jQuery($form).serializeArray();
    var json = {};
    
    jQuery.each(array, function() {
        json[this.name] = this.value || '';
    });
    console.log(json);

    const $inputs = $form.find('input, select, button, textarea');
    // console.log($inputs);
    // const serializedData = $form.serialize();
    // console.log(serializedData);
    $inputs.prop('disabled', true);

    request = $.ajax({
        url: 'http://localhost/domaci3/predstave',
        type: 'post',
        data: JSON.stringify(json)
    });

    request.done(function (response, textStatus, jqXHR) {
        console.log("Response: "+response);
        console.log("poruka: "+response.poruka);
        if (response.poruka === 'Predstava je uspešno ubačena') {
            console.log('Predstava je dodata');
            console.log('EVO');
            location.reload(true);
        }
        else console.log('Predstava nije dodata ' + odgovor.poruka);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });
    
});

$('#btn-izmeni').click(function () {
    const checked = $('input[name=checked-film]:checked');

    request = $.ajax({
        url: 'http://localhost/domaci3/predstave/'+checked.val()+'.json',
        type: 'get',
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        var predstava = response[0];
        $('#filmIzmeni').val(predstava.naziv);
        console.log(predstava.naziv);

        $('#zanrIzmeni').val(predstava.zanr.trim());
        console.log(predstava.zanr.trim());
        $('#trajanjeIzmeni').val(predstava.trajanje.trim());
        console.log(predstava.trajanje.trim());
        $('#utisakIzmeni').val(predstava.opis.trim());
        console.log(predstava.opis.trim());
        $('#cenaIzmeni').val(predstava.cena.trim());
        console.log("Cena:"+predstava.cena.trim());
        $('#izmeniForm input[name=id]').val(checked.val());
      
        console.log("Podaci iz get by id "+response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });


});

$('#izmeniForm').submit(function () {
    event.preventDefault();
    console.log("Izmene");
    const checked = $('input[name=checked-film]:checked');
    const $form = $(this);

    var array = jQuery($form).serializeArray();
    var json = {};
    
    jQuery.each(array, function() {
        json[this.name] = this.value || '';
    });
    console.log("Podaci za put "+json);

    const $inputs = $form.find('input, select, button, textarea');
    // const serializedData = $form.serialize();
    // console.log(serializedData);
    $inputs.prop('disabled', true);

    request = $.ajax({
        url: 'http://localhost/domaci3/predstave/'+checked.val(),
        type: 'put',
        data: JSON.stringify(json)
    });

    request.done(function (response, textStatus, jqXHR) {

        console.log(response)
        if (response.poruka === 'Predstava je uspešno izmenjena') {
            console.log('Predstava je izmenjena');
            location.reload(true);
            
        }
        else console.log('Predstava nije izmenjena ' + response.odgovor);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });


    
});



$('#btn-pretraga').click(function () {

    var prikaz = document.querySelector('#myInput');
    console.log(prikaz);
    var style = window.getComputedStyle(prikaz);
    console.log(style);
    if (!(style.display === 'inline-block') || ($('#myInput').css("visibility") ==  "hidden")) {
        console.log('block');
        $('#myInput').show();
        document.querySelector("#myInput").style.visibility = "";
    } else {
       document.querySelector("#myInput").style.visibility = "hidden";
    }
});

