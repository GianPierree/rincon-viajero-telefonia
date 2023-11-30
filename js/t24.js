BX24.init(function () {

  

  // BX24.callMethod(
  //   "crm.status.entity.items", {
  //     entityId: "STATUS"
  //   },
  //   function (result) {
  //     if (result.error()) {
  //       console.error(result.error());
  //     } else {
  //       console.dir("---REsult: ", result.data());
  //       htmlEstadoLead = "";
  //       obj = result.data();
  //       for (var key in obj) {
  //         htmlEstadoLead +=
  //         "<option value=" +
  //         obj[key]["STATUS_ID"] +
  //         ">" +
  //         obj[key]["NAME"] +
  //         "</option>";
  //       }
  //       document.getElementById("campanaEstadoLead").innerHTML = htmlEstadoLead;
  //     }
  //   }
  // );

  (function () {
    "use strict";

    var forms = document.querySelectorAll(".needs-validation");
    var txt = "";

    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      var modalTitle = exampleModal.querySelector('.modal-title')
      var modalBodyInput = exampleModal.querySelector('.modal-body #agente')
      var modalBodyInputCampana = exampleModal.querySelector('.modal-body #campana-id')

      modalTitle.textContent = 'Editar campaña:'
        
      console.log("ID de campaña: ", recipient)
      
      var CampanaId = {
        "url": "https://demo.asesores-e.com/rest/1/nij52v7bj73pzb30/lists.element.get.json?IBLOCK_TYPE_ID=asesorest24&IBLOCK_ID=68&ELEMENT_ID=" + recipient,
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Cookie": "BITRIX_SM_DEMO_SALE_UID=4"
        }
      };
      
      $.ajax(CampanaId).done(function (response) {
        let arrAgente = response.result[0].PROPERTY_245
        console.log(response.result[0].PROPERTY_245);
        
        for (var keyA in arrAgente) {
          var agente = arrAgente[keyA]
          console.log("Agente: ", agente);
          modalBodyInput.value = agente
          modalBodyInputCampana.value = recipient
        }
      })
    })


    Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener(
        "submit",
        function (event) {
          // console.log(!form.checkValidity());
          if (!form.checkValidity()) {
            if (!form.checkValidity() == true) {
              var txt0 = "Falta ingresar datos. :(";
              // var txt3 = "Falta ingresar datos. :(";
              document.getElementById("txt").innerHTML = txt0;
              // document.getElementById("txt-cola").innerHTML = txt3;
              // document.getElementById("btn-regresar-cola").style.visibility = "visible";
              document.getElementById("btn-regresar").style.visibility = "visible";
            }

            event.preventDefault();
            event.stopPropagation();

            console.log(form.id);

            if (form.id == "formCampana") {
              $("#formCampana0").submit(function (e) {
                // console.log("Prueba 123");
                console.log($(this).serializeArray());
                e.preventDefault();
                var txt1 = "Se agrego la campaña correctamente. :)";
                document.getElementById("txt").innerHTML = txt1;
                document.getElementById("btn-regresar").style.visibility =
                  "hidden";

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

                // var settingsCampana = {
                //   "url": "https://alige.bitrix24.es/rest/6/xuouwbcw9etye6sz/lists.element.add.json?IBLOCK_TYPE_ID=lists&IBLOCK_ID=41&ELEMENT_CODE=" + codeCampana + "&FIELDS[NAME]=" + nombreCampana,
                //   "method": "GET",
                //   "timeout": 0,
                //   "headers": {
                //     "Cookie": "BITRIX_SM_DEMO_SALE_UID=4"
                //   },
                // };

                var settingsCampana = {
                  "url": "https://demo.asesores-e.com/rest/1/nij52v7bj73pzb30/lists.element.add.json?IBLOCK_TYPE_ID=asesorest24&IBLOCK_ID=68&ELEMENT_CODE=" + codeCampana + "&FIELDS[NAME]=" + nombreCampana + "&FIELDS[PROPERTY_216]=" + colaCampana + "&FIELDS[PROPERTY_235]=" + estadoCampana + "&FIELDS[PROPERTY_234]=" + origenCampana + "&FIELDS[PROPERTY_240]=" + entidad + "&FIELDS[PROPERTY_242]=" + tipoCampana + "&FIELDS[PROPERTY_243]=" + intentosMaxCampana + "&FIELDS[PROPERTY_244]=" + intervaloLlamadasCampana + "&FIELDS[PROPERTY_245]=" + agentesCampana + "&FIELDS[PROPERTY_246]=" + numTelfCampana,
                  "method": "GET",
                  "timeout": 0,
                  "headers": {
                    "Cookie": "BITRIX_SM_DEMO_SALE_UID=4"
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
                      arrCampana
                    },
                    success: function (res) {
                      // var jsonData = JSON.parse(res);

                      console.log(res);

                      let start = 0

                      var campana = {
                        "url": "https://rinconviajero.bitrix24.es/rest/33/and34fxv1a6k3zdh/crm." + entidadCampana + ".list.json?filter[HAS_PHONE]=Y&filter[SOURCE_ID]=" + origenCampana + "&filter[STATUS_ID]=" + estadoCampana + "&start=" + start,
                        "method": "GET",
                        "timeout": 0,
                        "headers": {
                          "Cookie": "qmb=.; BITRIX_SM_SALE_UID=268"
                        },
                      };

                      $.ajax(campana).done(function (response) {
                        console.log(response);

                        // for (var keyC in response["result"]) {
                        //   let id = response["result"][keyC]["ID"];

                        //   var settingsC = {
                        //     "url": "https://alige.bitrix24.es/rest/6/cuphan5bz4983ln3/crm.lead.get.json?id=" + id,
                        //     "method": "GET",
                        //     "timeout": 0,
                        //     "headers": {
                        //       "Cookie": "qmb=.; BITRIX_SM_SALE_UID=268"
                        //     },
                        //   };

                        //   $.ajax(settingsC).done(function (responseC) {
                        //     let arrLeads = {};

                        //     let nombre = responseC["result"]["NAME"] + " " + responseC["result"]["LAST_NAME"];
                        //     let id = responseC["result"]["ID"];
                        //     let telefono = responseC["result"]["PHONE"][0]["VALUE"];

                        //     arrLeads["id"] = id;
                        //     arrLeads["nombre"] = nombre;
                        //     arrLeads["telefono"] = telefono;
                        //     arrLeads["idCampana"] = arrCampana["id"];

                        //     console.log(arrLeads);

                        //     $.ajax({
                        //       type: "POST",
                        //       url: "./database/leads.php",
                        //       cache: false,
                        //       data: {
                        //         arrLeads
                        //       },
                        //       success: function (res) {
                        //         console.log(res);
                        //       }
                        //     });
                        //   });
                        // }
                      });
                    }
                  });
                });

                $("#tbodyCampana").load(location.href + " #tbodyCampana");
              });
            } else if (form.id == "formCola") {
              $("#formCola").submit(function (e) {
                // console.log("Prueba 123");
                // console.log($(this).serializeArray());
                e.preventDefault();
                var txt2 = "Se agrego la cola correctamente. :)";
                document.getElementById("txt-cola").innerHTML = txt2;
                document.getElementById("btn-regresar-cola").style.visibility =
                  "hidden";

                var arrayFormCola = $(this).serializeArray();

                var code = new Date().getTime();
                let nombre = arrayFormCola[5]["value"];

                const arrUsuariosCola = [];
                // var usuarioNombreCompleto = "";

                for (let i = 6; i < arrayFormCola.length; i++) {
                  arrUsuariosCola.push(arrayFormCola[i]["value"]);
                }

                // console.log(arrUsuariosCola);

                let htmlUsuariosCola = "";
                for (let u = 0; u < arrUsuariosCola.length; u++) {
                  htmlUsuariosCola +=
                    "&FIELDS[PROPERTY_218][" + u + "]=" + arrUsuariosCola[u];
                }

                // console.log(htmlUsuariosCola);

                var settings = {
                  url: "https://demo.asesores-e.com/rest/1/nij52v7bj73pzb30/lists.element.add.json?IBLOCK_TYPE_ID=asesorest24&IBLOCK_ID=67&ELEMENT_CODE=" +
                    code +
                    "&FIELDS[NAME]=" +
                    nombre +
                    htmlUsuariosCola,
                  method: "GET",
                  timeout: 0,
                  headers: {
                    Cookie: "BITRIX_SM_DEMO_SALE_UID=4",
                  },
                };

                $.ajax(settings).done(function (response) {
                  console.log(response);
                });

                // $('#tbodyCola').load();
                $("#tbodyCola").load(location.href + " #tbodyCola");
              });
            } 
          }
          form.classList.add("was-validated");
        },
        false
      );
    });
  })();

  var colaListar = {
    "url": "https://demo.asesores-e.com/rest/1/nij52v7bj73pzb30/lists.element.get.json?IBLOCK_TYPE_ID=asesorest24&IBLOCK_ID=67",
    "method": "GET",
    "timeout": 0,
    "headers": {
      "Cookie": "BITRIX_SM_DEMO_SALE_UID=4"
    },
  };

  $.ajax(colaListar).done(function (response) {
    // console.dir(response.result);
    htmlCola = "";
    htmlTbodyCola = "";
    htmlPanel = "";
    obj = response.result;
    for (var key in obj) {
      // console.log(Object.keys(obj[key]["PROPERTY_218"]).length);
      htmlCola +=
        "<option value=" +
        obj[key]["ID"] +
        ">" +
        obj[key]["NAME"] +
        "</option>";
      htmlTbodyCola += "<tr><th scope='row'>" + obj[key]["ID"] + "</th><td>" + obj[key]["NAME"] + "</td><td>" + Object.keys(obj[key]["PROPERTY_218"]).length + "</td></tr>";
    }
    // document.getElementById("campanaCola").innerHTML = htmlCola;
    // document.getElementById("tbodyCola").innerHTML = htmlTbodyCola;

  });

  $.ajax({
    type: "POST",
    url: "./database/campaigns-show.php",
    cache: false,
    success: function(res) {
      console.log("result: ", res);
      // return "Activo";
    }
  });

  // var campanaListar = {
  //   "url": "https://demo.asesores-e.com/rest/1/nij52v7bj73pzb30/lists.element.get.json?IBLOCK_TYPE_ID=asesorest24&IBLOCK_ID=68",
  //   "method": "GET",
  //   "timeout": 0,
  //   "headers": {
  //     "Cookie": "BITRIX_SM_DEMO_SALE_UID=4"
  //   },
  // };



  // $.ajax(campanaListar).done(async function (response) {
  //   htmlTbodyCampana = "";
  //   objCampana = response.result;
  //   for (var key in objCampana) {

  //     urlCampana = "https://demo.asesores-e.com/rest/1/nij52v7bj73pzb30/lists.element.get.json?IBLOCK_TYPE_ID=asesorest24&IBLOCK_ID=68&ELEMENT_ID=" + objCampana[key]["ID"];
     
  //     var campanaColaId = '';

  //     $.each(objCampana[key]["PROPERTY_216"], function (index, value) {
  //       campanaColaId = value;
  //       return campanaColaId;
  //     });

  //     // var status = await campanaStatus(objCampana[key]["ID"]);
  //     // console.log("status: ", status)

  //     htmlTbodyCampana += "<tr><th scope='row'>" + objCampana[key]["ID"] + "</th><td>" + objCampana[key]["NAME"] + "</td><td><label id='statusLabel'>---</label></td><td><button class='btn btn-info' role='button' onclick='campanaPlay(" + objCampana[key]["ID"] + ", 1)'><img src='./images/play.svg' /></button>  <button class='btn btn-info' role='button' onclick='campanaStop(" + objCampana[key]["ID"] + ", 0)'><img src='./images/stop.svg' /></button> <button class='btn btn-info' role='button' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='" + objCampana[key]["ID"] +"'><img src='./images/edit.svg' /></button> <button class='btn btn-info' role='button' onclick='campanaTrash(" + objCampana[key]["ID"] + ")'><img src='./images/trash.svg' /></button></td></tr>";
  //     // htmlTbodyCampana += "<tr><th scope='row'>" + objCampana[key]["ID"] + "</th><td>" + objCampana[key]["NAME"] + "</td><td><button onclick='campanaStatus(" + objCampana[key]["ID"] + ")'>test</button></td><td><button class='btn btn-info' role='button' onclick='campanaPlay(" + objCampana[key]["ID"] + ", 1)'><img src='./images/play.svg' /></button>  <button class='btn btn-info' role='button' onclick='campanaStop(" + objCampana[key]["ID"] + ", 0)'><img src='./images/stop.svg' /></button> <button class='btn btn-info' role='button' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='" + objCampana[key]["ID"] +"'><img src='./images/edit.svg' /></button> <button class='btn btn-info' role='button' onclick='campanaTrash(" + objCampana[key]["ID"] + ")'><img src='./images/trash.svg' /></button></td></tr>";
  //   }

  //   document.getElementById("tbodyCampana").innerHTML = htmlTbodyCampana;
  //   console.log(objCampana);
  // });

  



  // $("#campanaEntidad").on("change", function () {
  //   var str = "";
  //   var id = "";
  //   $("#campanaEntidad option:selected").each(function () {
  //     str += $(this).text() + " (" + $(this).val() + ")";
  //     id += $(this).val();
  //   });
  //   // console.log(id);
  //   if (id == "lead") {
  //   } else if (id == "deal") {
  //     console.log("Estados de las negociaciones");
  //     BX24.callMethod(
  //       "crm.status.entity.items", {
  //         entityId: "DEAL_STAGE"
  //       },
  //       function (result) {
  //         if (result.error()) {
  //           console.error(result.error());
  //         } else {
  //           // console.dir(result.data());
  //           htmlEstadoDeal = "";
  //           obj = result.data();
  //           for (var key in obj) {
  //             htmlEstadoDeal +=
  //               "<option value=" +
  //               obj[key]["STATUS_ID"] +
  //               ">" +
  //               obj[key]["NAME"] +
  //               "</option>";
  //           }
  //           document.getElementById("campanaEstado").innerHTML = htmlEstadoDeal;
  //         }
  //       }
  //     );
  //   }
  // });

  // BX24.callMethod(
  //   "user.get", {
  //     FILTER: {
  //       ACTIVE: true,
  //       USER_TYPE: "employee",
  //     },
  //   },
  //   function (result) {
  //     if (result.error()) {
  //       console.error(result.error());
  //     } else {
  //       // console.log(result.data());
  //       html = "";
  //       obj = result.data();
  //       for (var key in obj) {
  //         html +=
  //           "<option value=" +
  //           obj[key]["ID"] +
  //           ">" +
  //           obj[key]["NAME"] +
  //           " " +
  //           obj[key]["LAST_NAME"] +
  //           "</option>";
  //       }
  //       document.getElementById("usuariosCola").innerHTML = html;
  //     }
  //   }
  // );

  // BX24.callMethod(
  //   "crm.status.entity.types", {},
  //   function (result) {
  //     if (result.error()) {
  //       console.error(result.error());
  //     } else {
  //       console.dir(result.data());
  //     }
  //   }
  // );

  // BX24.callMethod(
  //   "crm.status.entity.items", {
  //     entityId: "SOURCE"
  //   },
  //   function (result) {
  //     if (result.error()) {
  //       console.error(result.error());
  //     } else {
  //       console.log("origen: ", result.data());
  //       htmlOrigen = "";
  //       obj = result.data();
  //       for (var key in obj) {
  //         htmlOrigen +=
  //           "<option value=" +
  //           obj[key]["STATUS_ID"] +
  //           ">" +
  //           obj[key]["NAME"] +
  //           "</option>";
  //       }
  //       document.getElementById("campanaOrigen").innerHTML = htmlOrigen;
  //     }
  //   }
  // );
});