// console.log("TEST")
$("#formAgente").submit(function (e) {
    e.preventDefault();
    var arrayFormAgente = $(this).serializeArray();
    console.log("formAgente: ", arrayFormAgente);

    $.ajax({
        type: "POST",
        url: "./database/agente.php",
        cache: false,
        data: {
            arrayFormAgente,
        },
        success: function (res) {
            // var jsonData = JSON.parse(res);
            console.log(res);
        },
    });
});

var statusLead = {
    url: "https://rinconviajero.bitrix24.es/rest/33/and34fxv1a6k3zdh/crm.status.entity.items.json?entityId=STATUS",
    method: "GET",
    timeout: 0,
    headers: {
        Cookie: "BITRIX_SM_DEMO_SALE_UID=4",
    },
};

$.ajax(statusLead).done(function (response) {
    console.log("statusLead: ", response);
    htmlEstadoLead = "";
    obj = response.result;
    for (var key in obj) {
        htmlEstadoLead += "<option value=" + obj[key]["STATUS_ID"] + ">" + obj[key]["NAME"] + "</option>";
    }
    document.getElementById("campanaEstadoLead").innerHTML = htmlEstadoLead;
});

var source = {
    url: "https://rinconviajero.bitrix24.es/rest/33/and34fxv1a6k3zdh/crm.status.entity.items.json?entityId=SOURCE",
    method: "GET",
    timeout: 0,
    headers: {
        Cookie: "BITRIX_SM_DEMO_SALE_UID=4",
    },
};

$.ajax(source).done(function (response) {
    console.log("source: ", response);
    let htmlSource = "";
    obj = response.result;
    for (var key in obj) {
        htmlSource += "<option value=" + obj[key]["STATUS_ID"] + ">" + obj[key]["NAME"] + "</option>";
    }
    document.getElementById("campanaOrigen").innerHTML = htmlSource;
});
