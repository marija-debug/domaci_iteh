$('.btnReserve').click(function () {
    // var sessionid = $('html').attr('id');
    // alert (sessionid);
    const $btn = $(this);
    const id = $btn.val();

    ucitajPredstavu(id);

    ucitajDatumeIzvodjenja(id);

    $('#reservation').modal('toggle');
    return false;
});

$(document).ready(function () {
    $('#datumiIzvodjenja').change(function () {
        ucitajSedista();
    });
});

function ucitajSedista() {
    if ($('#datumiIzvodjenja').val() == 'testni') {
        console.log("testni izabran");
        $("#sediste").empty();
        return;
    }
    request = $.ajax({
        url: 'http://localhost/domaci3/predstave/' + $('#btnRezervisi').val() + '/' + $('#datumiIzvodjenja').val() + '.json',
        type: 'get',
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        $("#sediste").empty();
        response.forEach(function (value, index) {
            $('#sediste').append('<option value=' + value.salaId + '>' + value.id + '</option>');
        });

    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });

}

function ucitajDatumeIzvodjenja(id) {
    request = $.ajax({
        url: 'http://localhost/domaci3/izvodjenja/' + id + '.json',
        type: 'get',
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        $("#datumiIzvodjenja").empty();
        $('#datumiIzvodjenja').append('<option value="testni"> Izberite datum </option>');
        response.forEach(function (value, index) {
            $('#datumiIzvodjenja').append('<option value=' + value.datum + '>' + value.formDatum + '</option>');
        });

    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });

}

function ucitajPredstavu(id) {
    request = $.ajax({
        url: 'http://localhost/domaci3/predstave/' + id + '.json',
        type: 'get',
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        var predstava = response[0];
        $('#filmIzmeni').val(predstava.naziv);

        $('#trajanjeIzmeni').val(predstava.trajanje.trim());
        //ovde sacuvam id predstave
        $('#btnRezervisi').val(id);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });
}
$('#rezervacijaForm').submit(function () {
    event.preventDefault();
    const $form = $(this);

    if($("#sediste").val() == 0 || $('#datumiIzvodjenja').val() == 'testni'){
        alert('Morate izabrati datum i sedište');
        return;
    }

    console.log("Rezervacija");
    var json = {};
    json["korisnikId"] = $('html').attr('id');
    json["predstavaId"] = $('#btnRezervisi').val();
    json["salaId"] = $("#sediste").val();
    json["sediste"] = $("#sediste option:selected").text();
    json["datum"] = $("#datumiIzvodjenja").val();
    console.log(json);

    const $inputs = $form.find('input, select, button, textarea');
    // const serializedData = $form.serialize();
    // console.log(serializedData);
    $inputs.prop('disabled', true);

    request = $.ajax({
        url: 'http://localhost/domaci3/rezervacija',
        type: 'post',
        data: JSON.stringify(json)
    });

    request.done(function (response, textStatus, jqXHR) {

        console.log(response.poruka)
        if (response.poruka === 'Rezervacija je uspešno sačuvana') {
            alert('Rezervacija je uspešno sačuvana');
            console.log('Rezervacija je uspešno sačuvana');
            location.reload(true);
            
        }
        else {
            alert('Rezervacija nije sačuvana ' + response.poruka);
            console.log('Rezervacija nije sačuvana ' + response.poruka);
        }
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });
});
