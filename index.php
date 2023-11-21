<!DOCTYPE html>
<html lang="la">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="css/app.css"> -->
	<title>AsesoresT24</title>

	<link rel="stylesheet" href="./css/t24.css" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="//api.bitrix24.com/api/v1/dev/"></script>
	<script>
		function campanaPlay(id, num) {
			// console.log("id: " + id + " num: " + num);

			let arr = {};
			arr["id"] = id;
			arr["num"] = num;

			$.ajax({
				type: "POST",
				url: "./database/campaigns-update.php",
				cache: false,
				data: {
					arr
				},
				success: async function(res) {
					var jsonData = JSON.parse(res);
					console.log(jsonData);
					await campanaStatus(id);
				}
			});
		}

		function campanaPause(id, num) {
			// console.log("id: " + id + " num: " + num);

			let arr = {};
			arr["id"] = id;
			arr["num"] = num;

			$.ajax({
				type: "POST",
				url: "./database/campaigns-update.php",
				cache: false,
				data: {
					arr
				},
				success: async function(res) {
					var jsonData = JSON.parse(res);
					console.log(jsonData);
					await campanaStatus(id);

				}
			});
		}

		function campanaStop(id, num) {
			// console.log("id: " + id + " num: " + num);

			let arr = {};
			arr["id"] = id;
			arr["num"] = num;

			$.ajax({
				type: "POST",
				url: "./database/campaigns-update2.php",
				cache: false,
				data: {
					arr
				},
				success: async function(res) {
					var jsonData = JSON.parse(res);
					console.log(jsonData);
					await campanaStatus(id);
				}
			});
		}

		function campanaRecycle(id, num) {
			// console.log("id: " + id + " num: " + num);

			let arr = {};
			arr["id"] = id;
			arr["num"] = num;

			$.ajax({
				type: "POST",
				url: "./database/recycle.php",
				cache: false,
				data: {
					arr
				},
				success: function(res) {
					var jsonData = JSON.parse(res);
					console.log(jsonData);

					$.ajax({
						type: "POST",
						url: "./database/lead-recycle.php",
						cache: false,
						data: {
							arr
						},
						success: function(resC) {
							var jsonDataC = JSON.parse(resC);
							console.log(jsonDataC);

							var settingsCampana = {
								"url": "https://demo.asesores-e.com/rest/1/nij52v7bj73pzb30/lists.element.get.json?IBLOCK_TYPE_ID=asesorest24&IBLOCK_ID=68&ELEMENT_ID=" + id,
								"method": "GET",
								"timeout": 0,
								"headers": {
									"Cookie": "BITRIX_SM_DEMO_SALE_UID=4"
								},
							};

							$.ajax(settingsCampana).done(function(response) {
								// console.log(response["result"][0]);
								// console.log(arrayFormCampana);

								for (var key in response["result"][0]["PROPERTY_234"]) {
									var origen = response["result"][0]["PROPERTY_234"][key];
								}

								for (var key2 in response["result"][0]["PROPERTY_235"]) {
									var estado = response["result"][0]["PROPERTY_235"][key2];
								}

								var campana = {
									"url": "https://desarrollo1.bitrix24.es/rest/11/nq49mcpyi2y32tn6/crm.lead.list.json?filter[HAS_PHONE]=Y&filter[SOURCE_ID]=" + origen + "&filter[STATUS_ID]=" + estado,
									"method": "GET",
									"timeout": 0,
									"headers": {
										"Cookie": "qmb=.; BITRIX_SM_SALE_UID=268"
									},
								};

								$.ajax(campana).done(function(responseL) {
									// console.log(responseL);

									for (var keyC in responseL["result"]) {
										let idLead = responseL["result"][keyC]["ID"];

										var settingsC = {
											"url": "https://desarrollo1.bitrix24.es/rest/11/nq49mcpyi2y32tn6/crm.lead.get.json?id=" + idLead,
											"method": "GET",
											"timeout": 0,
											"headers": {
												"Cookie": "qmb=.; BITRIX_SM_SALE_UID=268"
											},
										};

										$.ajax(settingsC).done(function(responseC) {
											let arrLeads = {};

											let nombre = responseC["result"]["NAME"] + " " + responseC["result"]["LAST_NAME"];
											let idLead = responseC["result"]["ID"];
											let telefono = responseC["result"]["PHONE"][0]["VALUE"];

											arrLeads["id"] = idLead;
											arrLeads["nombre"] = nombre;
											arrLeads["telefono"] = telefono;
											arrLeads["idCampana"] = id;

											$.ajax({
												type: "POST",
												url: "./database/leads.php",
												cache: false,
												data: {
													arrLeads
												},
												success: function(res) {
													var jsonData = JSON.parse(res);
													console.log(jsonData);
												}
											});
										});
									}
								});
							});

						}
					});

				}
			});
		}

		function campanaTrash(id) {
			console.log("id: " + id );

			let arr = {};
			arr["id"] = id;

			var settings = {
				"url": "https://demo.asesores-e.com/rest/1/nij52v7bj73pzb30/lists.element.delete.json?IBLOCK_TYPE_ID=asesorest24&IBLOCK_ID=68&ELEMENT_ID=" + id,
				"method": "GET",
				"timeout": 0,
				"headers": {
					"Cookie": "BITRIX_SM_DEMO_SALE_UID=4"
				},
			};

			$.ajax(settings).done(function (response) {
				console.log(response);
			});

			$.ajax({
				type: "POST",
				url: "./database/lead-trash.php",
				cache: false,
				data: {
					arr
				},
				success: function(res) {
					console.log(res);
				}
			});
		}

		function campanaStatus(id) {
			console.log("id: " + id );

			let arr = {};
			arr["id"] = id;

			$.ajax({
				type: "POST",
				url: "./database/campaigns-status.php",
				cache: false,
				data: {
					arr
				},
				success: function(res) {
					console.log("stats: ", res);
					// return "Activo";
				}
			});
		}
	</script>
</head>

<body>
	<?php
	// header('Content-Type: application/json; charset=utf-8');
	require_once(__DIR__ . '/crest.php');
	?>
	<div class="container-fluid">
		<br>
		<!-- <h1 class="h1">AsesoresT24</h1> -->
		<img src="./images/logo.png" id="logo" alt="Logo AsesoresT24" />
		<br>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link link-dark active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Campaña</button>
			</li>
			<!-- <li class="nav-item" role="presentation">
				<button class="nav-link link-dark" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Cola de atención</button>
			</li> -->
			<li class="nav-item" role="presentation">
				<button class="nav-link link-dark" id="panel-tab" data-bs-toggle="tab" data-bs-target="#panel" type="button" role="tab" aria-controls="panel" aria-selected="false">Panel</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link link-dark" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Soporte técnico</button>
			</li>
		</ul>

		<div class="tab-content" id="myTabContent">
			<!-- Campaña -->
			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				<?php
					require_once("./views/formCampana2.php");
				?>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Nombre de campaña</th>
							<th scope="col">Estado</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					<tbody id="tbodyCampana">
					</tbody>
				</table>

				<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Open modal for @fat</button>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->

				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Editar campaña</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form id="formAgente" class="needs-validation" novalidate>
								<div class="mb-3">
									<label for="agente" class="col-form-label">Agente:</label>
									<input name="agente "type="text" class="form-control" id="agente">
								</div>
								<div class="mb-3">
									<!-- <label for="recipient-name" class="col-form-label">Agente:</label> -->
									<input name="campana-id" type="hidden" class="form-control" id="campana-id">
								</div>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								<button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
							</form>
						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- Cola -->
			<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				<br>
				<!-- <div class="modal fade" id="colaPopUp" aria-hidden="true" aria-labelledby="colaPopUpLabel" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="colaPopUpLabel">Agregar cola nueva:</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form id="formCola" class="needs-validation" novalidate>
									<input type="hidden" name="save" value="Y">
									<input type="hidden" name="access_token" value="<?= $_REQUEST['AUTH_ID']; ?>">
									<input type="hidden" name="refresh_token" value="<?= $_REQUEST['REFRESH_ID']; ?>">
									<input type="hidden" name="domain" value="<?= $_REQUEST['DOMAIN']; ?>">
									<input type="hidden" name="member_id" value="<?= $_REQUEST['member_id']; ?>">
									<div class="mb-3 position-relative">
										<label for="colaNombre" class="form-label">Nombre de cola: </label>
										<input type="text" class="form-control" id="colaNombre" name="colaNombre" required />
										<div class="invalid-tooltip">
											Ingresa el nombre de la cola.
										</div>
									</div>
									<div class="mb-3 position-relative">
										<label for="usuariosCola" class="form-label">Seleccionar cola de atención: </label>
										<select class="form-select" multiple aria-label="multiple select" id="usuariosCola" name="usuariosCola" required>
										</select>
										<div class="invalid-tooltip">
											Ingresa una cola para la campaña.
										</div>
									</div>
									<div id="div"></div>
									<div class="modal-footer">
										<button id="btn-guardar-cola" style="background-color: #3bc8f5 !important; border-color: #3bc8f5 !important; font-weight: bold !important" type="submit" class="btn btn-primary btn-save" data-bs-target="#colaPopUp2" data-bs-toggle="modal" data-bs-dismiss="modal">Guardar</button>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div> -->
				<!-- <div class="modal fade" id="colaPopUp2" aria-hidden="true" aria-labelledby="colaPopUpLabel2" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="campanaPopUpLabel2">Agregar cola nueva: </h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<span id="txt-cola"></span>
							</div>
							<div class="modal-footer">
								<button id="btn-regresar-cola" style="background-color: #3bc8f5 !important; border-color: #3bc8f5 !important; font-weight: bold !important" class="btn btn-primary btn-save" data-bs-target="#colaPopUp" data-bs-toggle="modal" data-bs-dismiss="modal">Regresar</button>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div> -->
				<!-- <a id="btn-crear-cola" style="background-color: #3bc8f5 !important; border-color: #3bc8f5 !important; font-weight: bold !important" class="btn btn-primary" data-bs-toggle="modal" href="#colaPopUp" role="button">Crear cola</a>
				<br> <br>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Nombre de cola</th>
							<th scope="col">Usuarios de cola</th>
						</tr>
					</thead>
					<tbody id="tbodyCola">
						<tr>
							<th scope="row">1</th>
							<td>Mark</td>
							<td>Otto</td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td>Jacob</td>
							<td>Thornton</td>
						</tr>
						<tr>
							<th scope="row">3</th>
							<td>Larry</td>
							<td>the Bird</td>
						</tr>
					</tbody>
				</table> -->
			</div>
			<!-- Panel -->
			<div class="tab-pane fade" id="panel" role="tabpanel" aria-labelledby="panel-tab">
				<!-- <div id="panel" class="container">
					<div class="row">
						<div class="col">
							Column
						</div>
						<div class="col">
							Column
						</div>
						<div class="col">
							Column
						</div>
					</div>
				</div> -->
			</div>
			<!-- Soporte -->
			<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
				<!-- Hola TEST -->
			</div>
		</div>
	</div>
	<script src="./js/validate.js"></script>
	<script src="./js/t24.js"></script>
	<script src="./js/formAgente.js"></script>
	<script src="./js/formCampana.js"></script>
	<script>
		$(document).ready(function() {
			console.log('test');
			consultarUsuario();
		});
	</script>
	<!-- <script src="./js/list.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>