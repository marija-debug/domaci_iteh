$('.checked-rezervacija').click(function () {
    var $datum = $(this).closest("tr")
        .find(".datum")
        .text();
    var $sala = $(this).closest("tr")
        .find(".sala")
        .text();
    var $sediste = $(this).closest("tr")
        .find(".sediste")
        .text();
    var $predstava = $(this).closest("tr")
        .find(".predstava")
        .text();
    var $cena = $(this).closest("tr")
        .find(".cena")
        .text();
    console.log("Cena " + $cena)
    request = $.ajax({

        // http://localhost/domaci_iteh/index.php?msg=Uspešno ste se registrovali. Možete se prijaviti."
        url: './ticketsDownload/download.php/?predstava=' + $predstava + '&datum=' + $datum + '&sala=' + $sala + '&sediste=' + $sediste + '&cena=' + $cena,
        type: 'get',
    });

    request.done(function (response, textStatus, jqXHR) {
        // if (response.poruka === 'Predstava je uspešno izbrisana') {
        //     alert('Predstava je obrisana');
        //     console.log('Obrisan');
        // }
        // else {
        //     console.log('Predstava nije obrisana');
        //     alert('Film nije obrisan');
        // }
        console.log(response);
        window.open("ticketsDownload/" + response);

    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
        alert("Trenutno nije moguće odštampati kartu, pokušajte kasnije");
    });
});


// function openPdf($fileName) {
//     var a = document.createElement('a');
//     a.href = "data:application/octet-stream;base64," + response;
//     a.target = '_blank';
//     a.download = 'filename.pdf';
//     a.click();
// }