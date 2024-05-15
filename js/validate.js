// Example starter JavaScript for disabling form submissions if there are invalid fields
async function validate() {
    console.log("Form Agregar Campaña");
    let nombre = document.getElementById("campanaNombre").value;
    let cola = document.getElementById("campanaCola2").value;
    let estado = document.getElementById("campanaEstadoLead").value;
    let origen = document.getElementById("campanaOrigen").value;
    let intentos = document.getElementById("campanaIntentosMax").value;
    let intervalo = document.getElementById("campanaIntervaloLlamadas").value;
    let agentes = document.getElementById("campanaAgentes").value;
    let telefeno = document.getElementById("campanaNumTelf").value;
    let tipo = document.getElementById("campanaTipo").value;

    if (nombre === null || nombre === "") {
        alert("Ingresa el nombre de la campaña");
        document.getElementById("campanaNombre").focus;
    } else if (cola === "" || cola === null) {
        alert("Ingresa el ID de la cola");
        document.getElementById("campanaCola2").focus;
    } else if (estado === 0 || estado === null) {
        alert("Seleccione un estado");
        document.getElementById("campanaEstadoLead").focus;
    } else if (origen === 0 || origen === null) {
        alert("Seleccione un origen");
        document.getElementById("campanaOrigen").focus;
    } else if (intentos === "" || intentos === null) {
        alert("Ingresa los números de intentos.");
        document.getElementById("campanaIntentosMax").focus;
    } else if (intervalo === "" || intervalo === null) {
        alert("Ingresa el intervalo");
        document.getElementById("campanaIntervaloLlamadas").focus;
    } else if (agentes === "" || agentes === null) {
        alert("Ingresa el número de agentes");
        document.getElementById("campanaAgentes").focus;
    } else if (telefeno === "" || telefeno === null) {
        alert("Ingresa el telefono");
        document.getElementById("campanaNumTelf").focus;
    } else if (tipo === "" || tipo === null) {
        alert("Ingresa el tipo de campaña");
        document.getElementById("campanaTipo").focus;
    } else {
        console.log("Formulario validado");
        document.getElementById("btn-guardar-campana").style.display = "none";
        document.getElementById("btn-cargando-campana").style.display = "block";
        await crearCampanas() 
    }
}

async function crearCampanas() {

    let nombre = document.getElementById("campanaNombre").value;
    let cola = document.getElementById("campanaCola2").value;
    let estado = document.getElementById("campanaEstadoLead").value;
    let origen = document.getElementById("campanaOrigen").value;
    let intentos = document.getElementById("campanaIntentosMax").value;
    let intervalo = document.getElementById("campanaIntervaloLlamadas").value;
    let agentes = document.getElementById("campanaAgentes").value;
    let telefeno = document.getElementById("campanaNumTelf").value;
    let tipo = document.getElementById("campanaTipo").value;

    var codeCampana = new Date().getTime();
    let nombreCampana = nombre;
    let colaCampana = cola;
    let estadoCampana = estado;
    let origenCampana = origen;
    let entidadCampana = "lead";
    let intentosMaxCampana = intentos;
    let intervaloLlamadasCampana = intervalo;
    let agentesCampana = agentes;
    let numTelfCampana = telefeno;
    let tipoCampana = tipo;
    let arrCampana = {};
    let entidad = 286;

    var settingsCampana = {
        url: "https://demo.asesores-e.com/rest/1/nij52v7bj73pzb30/lists.element.add.json?IBLOCK_TYPE_ID=asesorest24&IBLOCK_ID=68&ELEMENT_CODE=" + codeCampana + "&FIELDS[NAME]=" + nombreCampana + "&FIELDS[PROPERTY_216]=" + colaCampana + "&FIELDS[PROPERTY_235]=" + estadoCampana + "&FIELDS[PROPERTY_234]=" + origenCampana + "&FIELDS[PROPERTY_240]=" + entidad + "&FIELDS[PROPERTY_242]=" + tipoCampana + "&FIELDS[PROPERTY_243]=" + intentosMaxCampana + "&FIELDS[PROPERTY_244]=" + intervaloLlamadasCampana + "&FIELDS[PROPERTY_245]=" + agentesCampana + "&FIELDS[PROPERTY_246]=" + numTelfCampana,
        method: "GET",
        timeout: 0,
        headers: {
            Cookie: "BITRIX_SM_DEMO_SALE_UID=4",
        },
    };

    $.ajax(settingsCampana).done(function (response) {
        arrCampana["id"] = response["result"];
        arrCampana["nombre"] = nombreCampana;
        arrCampana["idCola"] = colaCampana;
        arrCampana["entidad"] = entidadCampana;
        arrCampana["estado"] = estadoCampana;
        arrCampana["origen"] = origenCampana;
        arrCampana["tipo"] = tipoCampana;
        arrCampana["intentos"] = intentosMaxCampana;
        arrCampana["intervalo"] = intervaloLlamadasCampana;
        arrCampana["agentes"] = agentesCampana;
        arrCampana["numero"] = numTelfCampana;

        $.ajax({
            type: "POST",
            url: "./database/db.php",
            cache: false,
            data: {
                arrCampana,
            },
            success: function (res) {
                console.log(res);

                let start = 0;

                var campana = {
                    url: "https://rinconviajero.bitrix24.es/rest/33/and34fxv1a6k3zdh/crm." + entidadCampana + ".list.json?filter[HAS_PHONE]=Y&filter[SOURCE_ID]=" + origenCampana + "&filter[STATUS_ID]=" + estadoCampana + "&start=" + start,
                    method: "GET",
                    timeout: 0,
                    headers: {
                        Cookie: "qmb=.; BITRIX_SM_SALE_UID=268",
                    },
                };

                $.ajax(campana).done(function (response) {
                    // console.log(response);

                    let total = response["total"];

                    for (let i = 0; i < Math.ceil(total / 50); i++) {
                        var campanaI = {
                            url: "https://rinconviajero.bitrix24.es/rest/33/and34fxv1a6k3zdh/crm." + entidadCampana + ".list.json?filter[HAS_PHONE]=Y&filter[SOURCE_ID]=" + origenCampana + "&filter[STATUS_ID]=" + estadoCampana + "&start=" + start,
                            method: "GET",
                            timeout: 0,
                            headers: {
                                Cookie: "qmb=.; BITRIX_SM_SALE_UID=268",
                            },
                        };

                        $.ajax(campanaI).done(function (response) {
                            console.log(response);
                            for (var keyC in response["result"]) {
                                let id = response["result"][keyC]["ID"];

                                BX24.callMethod("crm.lead.get", { id: id }, function (result) {
                                    if (result.error()) {
                                        console.error(result.error());
                                    } else {
                                        console.dir(result.data());
                                        console.log('Números de telefonos: ', result.data().PHONE.length);

                                        // let arrLeads = {};

                                        // let nombre = result.data().NAME;
                                        // let id = result.data().ID;
                                        // let telefono = result.data().PHONE[0].VALUE;

                                        // arrLeads["id"] = id;
                                        // arrLeads["nombre"] = nombre;
                                        // arrLeads["telefono"] = telefono;
                                        // arrLeads["idCampana"] = arrCampana["id"];

                                        // $.ajax({
                                        //     type: "POST",
                                        //     url: "./database/leads.php",
                                        //     cache: false,
                                        //     data: {
                                        //         arrLeads,
                                        //     },
                                        //     success: function (res) {
                                        //         console.log(res);
                                        //     },
                                        // });

                                        for(const i = 0; i < 4; i++){
                                            let arrLeads = {};

                                            let nombre = result.data().NAME;
                                            let id = result.data().ID;
                                            let telefono = result.data().PHONE[i].VALUE;
                
                                            arrLeads["id"] = id;
                                            arrLeads["nombre"] = nombre;
                                            arrLeads["telefono"] = telefono;
                                            arrLeads["idCampana"] = arrCampana["id"];
                
                                            $.ajax({
                                                type: "POST",
                                                url: "./database/leads.php",
                                                cache: false,
                                                data: {
                                                    arrLeads,
                                                },
                                                success:  function (res) {
                                                    setTimeout(console.log(res), 3000);
                                                },
                                            });
                                        }
                                    }
                                });
                            }
                        });
                        start = start + 50;
                    }
                });
                // Acá es el filtro
            },
        });
    });
    setTimeout(() => {
        window.location.reload();
        console.log("Se acabo la carga 2")
    }, 2.5 * 60 * 1000);    
}
