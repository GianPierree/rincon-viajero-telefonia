<br>
<div class="modal fade" id="campanaPopUp" aria-hidden="true" aria-labelledby="campanaPopUpLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="campanaPopUpLabel">Agregar campaña nueva:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCampana">
                    <input type="hidden" name="save" value="Y">
                    <input type="hidden" name="access_token" value="<?= $_REQUEST['AUTH_ID']; ?>">
                    <input type="hidden" name="refresh_token" value="<?= $_REQUEST['REFRESH_ID']; ?>">
                    <input type="hidden" name="domain" value="<?= $_REQUEST['DOMAIN']; ?>">
                    <input type="hidden" name="member_id" value="<?= $_REQUEST['member_id']; ?>">
                    <div class="mb-3 position-relative">
                        <label for="campanaNombre" class="form-label">Nombre de campaña: </label>
                        <input type="text" class="form-control" id="campanaNombre" name="campanaNombre" onchange="validate()" required />
                        <div class="invalid-feedback">
                            Ingresa el nombre de la campaña.
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaCola" class="form-label">Id de cola de atención: </label>
                        <input type="text" class="form-control" id="campanaCola2" name="campanaCola" onchange="validate()" required />
                        <div class="invalid-feedback">
                            Ingresa una cola para la campaña.
                        </div>
                    </div>
                    <!-- <div class="mb-3 position-relative">
										<label for="campanaCola" class="form-label">Seleccionar cola de atención: </label>
										<select class="form-select" aria-label="Default select example" id="campanaCola" name="campanaCola" required>
										</select>
										<div class="invalid-tooltip">
											Ingresa una cola para la campaña.
										</div>
									</div> -->
                    <!-- <div class="mb-3 position-relative">
										<label for="campanaEntidad" class="form-label">Entidad: </label>
										<select class="form-select" aria-label="Default select example" id="campanaEntidad" name="campanaEntidad" required>
											<option value="">Seleccionar</option>
											<option value="lead">Prospecto</option>
											<option value="deal">Negociación</option>
										</select>
										<div class="invalid-tooltip">
											Ingresa la entidad de la campaña.
										</div>
									</div> -->
                    <div class="mb-3">
                        <label for="campanaEstado" class="form-label">Estado de prospecto: </label>
                        <select class="form-select" aria-label="Default select example" id="campanaEstadoLead" onchange="validate()" name="campanaEstado">
                            <option value="">Seleccionar</option>
                            <!-- <option value="IN_PROCESS">Seguimiento</option>
											<option value="2">Contactado</option> -->
                        </select>
                        <div class="invalid-feedback">
                            Ingresa el estado del prospecto.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="campanaOrigen" class="form-label">Origen: </label>
                        <select class="form-select" aria-label="Default select example" id="campanaOrigen" onchange="validate()" name="campanaOrigen">
                            <option value="">Seleccionar</option>
                        </select>
                        <div class="invalid-feedback">
                            Ingresa el origen.
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaIntentosMax" class="form-label">Intentos máximos: </label>
                        <input type="text" class="form-control" id="campanaIntentosMax" name="campanaIntentosMax" onchange="validate()" required />
                        <div class="invalid-feedback">
                            Ingresa intentos máximos.
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaIntervaloLlamadas" class="form-label">Intervalo entre llamadas: </label>
                        <input type="text" class="form-control" id="campanaIntervaloLlamadas" name="campanaIntervaloLlamadas" onchange="validate()" required />
                        <div class="invalid-feedback">
                            Ingresa intervalo entre llamadas.
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaAgentes" class="form-label">Agentes: </label>
                        <input type="text" class="form-control" id="campanaAgentes" name="campanaAgentes" onchange="validate()" required />
                        <div class="invalid-feedback">
                            Ingresa agentes.
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaNumTelf" class="form-label">Número de teléfono: </label>
                        <input type="text" class="form-control" id="campanaNumTelf" name="campanaNumTelf" onchange="validate()" required />
                        <div class="invalid-feedback">
                            Ingresa el número de la campaña.
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaTipo" class="form-label">Tipo: </label>
                        <select class="form-select" aria-label="Default select example" id="campanaTipo" name="campanaTipo" onchange="validate()" required>
                            <option value="0">Seleccionar</option>
                            <option value="1">Predictivo</option>
                            <option value="2">Progresivo</option>
                            <option value="3">PressOne</option>
                            <option value="4">Reverse</option>
                        </select>
                        <div class="invalid-feedback">
                            Ingresa el tipo de la campaña.
                        </div>
                    </div>
                    <div id="div"></div>
                    <div class="modal-footer">
                        <!-- <button type="submit" class="btn btn btn-primary btn-lg btn-save" name="btn-guardar" data-bs-dismiss="modal">Guardar</button> -->
                        <button id="btn-guardar-campana" style="background-color: #3bc8f5 !important; border-color: #3bc8f5 !important; font-weight: bold !important" type="submit" class="btn btn-primary btn-save" data-bs-target="#campanaPopUp2" data-bs-toggle="modal" data-bs-dismiss="modal">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="campanaPopUp2" aria-hidden="true" aria-labelledby="campanaPopUpLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="campanaPopUpLabel2">Agregar campaña nueva: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="txt"></span>
            </div>
            <div class="modal-footer">
                <button id="btn-regresar" style="background-color: #3bc8f5 !important; border-color: #3bc8f5 !important; font-weight: bold !important" class="btn btn-primary btn-save" data-bs-target="#campanaPopUp" data-bs-toggle="modal" data-bs-dismiss="modal">Regresar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload()">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<a id="btn-crear-campana" style="background-color: #3bc8f5 !important; border-color: #3bc8f5 !important; font-weight: bold !important" class="btn btn-primary" data-bs-toggle="modal" href="#campanaPopUp" role="button">Crear campañas 1111111</a>
<br> <br>