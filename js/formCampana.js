$("#formCampana").submit( function (e) {
    // console.log("Prueba 123");
    console.log($(this).serializeArray());
    e.preventDefault();
    var txt1 = "Se agrego la campaña correctamente. :)";
    document.getElementById("txt").innerHTML = txt1;
    document.getElementById("btn-regresar").style.visibility = "hidden";

    var arrayFormCampana = $(this).serializeArray();
    console.log(arrayFormCampana);
    var codeCampana = new Date().getTime();
    let nombreCampana = arrayFormCampana[5]["value"];
    let colaCampana = arrayFormCampana[6]["value"];
    let estadoCampana = arrayFormCampana[7]["value"];
    let origenCampana = arrayFormCampana[8]["value"];
    let entidadCampana = "lead";
    let intentosMaxCampana = arrayFormCampana[9]["value"];
    let intervaloLlamadasCampana = arrayFormCampana[10]["value"];
    let agentesCampana = arrayFormCampana[11]["value"];
    let numTelfCampana = arrayFormCampana[12]["value"];
    let tipoCampana = arrayFormCampana[13]["value"];
    let arrCampana = {};
    let entidad = 286;
    // let entidadCampana = "lead";

    // if (entidadCampana == "lead") {
    // } else {
    //   var entidad = 287;
    // }

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

        // console.log(arrCampana);

         $.ajax({
            type: "POST",
            url: "./database/db.php",
            cache: false,
            data: {
                arrCampana,
            },
            success:  function (res) {
                // var jsonData = JSON.parse(res);

                console.log(res);

                let start = 0

                var campana = {
                    url: "https://rinconviajero.bitrix24.es/rest/33/and34fxv1a6k3zdh/crm." + entidadCampana + ".list.json?filter[HAS_PHONE]=Y&filter[SOURCE_ID]=" + origenCampana + "&filter[STATUS_ID]=" + estadoCampana + "&start=" + start,
                    method: "GET",
                    timeout: 0,
                    headers: {
                        Cookie: "qmb=.; BITRIX_SM_SALE_UID=268",
                    },
                };

                 $.ajax(campana).done( function (response) {
                    // console.log(response);

                    let total = response["total"];

                    for(let i = 0; i < Math.ceil(total/50); i++){
                        var campanaI = {
                            url: "https://rinconviajero.bitrix24.es/rest/33/and34fxv1a6k3zdh/crm." + entidadCampana + ".list.json?filter[HAS_PHONE]=Y&filter[SOURCE_ID]=" + origenCampana + "&filter[STATUS_ID]=" + estadoCampana + "&start=" + start,
                            method: "GET",
                            timeout: 0,
                            headers: {
                                Cookie: "qmb=.; BITRIX_SM_SALE_UID=268",
                            },
                        };

                         $.ajax(campanaI).done( function (response) {
                            console.log(response);
                            for (var keyC in response["result"]) {
                                let id = response["result"][keyC]["ID"];

                                BX24.callMethod(
                                    "crm.lead.get", 
                                    { id: id }, 
                                    function(result) {
                                        if(result.error()){
                                            console.error(result.error());
                                        }else{
                                            console.dir(result.data());

                                            let arrLeads = {};
        
                                            let nombre = result.data().NAME;
                                            let id = result.data().ID;
                                            let telefono = result.data().PHONE[0].VALUE;
                
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
                                );	
        
                                // var settingsC = {
                                //     url: "https://alige.bitrix24.es/rest/6/cuphan5bz4983ln3/crm.lead.get.json?id=" + id,
                                //     method: "GET",
                                //     timeout: 0,
                                //     headers: {
                                //         Cookie: "qmb=.; BITRIX_SM_SALE_UID=268",
                                //     },
                                // };
        
                                //  $.ajax(settingsC).done( function (responseC) {
        
                                //     let arrLeads = {};
        
                                //     let nombre = responseC["result"]["NAME"] + " " + responseC["result"]["LAST_NAME"];
                                //     let id = responseC["result"]["ID"];
                                //     let telefono = responseC["result"]["PHONE"][0]["VALUE"];
        
                                //     arrLeads["id"] = id;
                                //     arrLeads["nombre"] = nombre;
                                //     arrLeads["telefono"] = telefono;
                                //     arrLeads["idCampana"] = arrCampana["id"];
        
                                //      $.ajax({
                                //         type: "POST",
                                //         url: "./database/leads.php",
                                //         cache: false,
                                //         data: {
                                //             arrLeads,
                                //         },
                                //         success:  function (res) {
                                //             setTimeout(console.log(res), 3000);
                                //         },
                                //     });
                                // });
                            }
                        })
                        start = start + 50;
                    }

                });

                // Acá es el filtro
            },
        });
    });

    console.log('Se acabo la carga.')
});
