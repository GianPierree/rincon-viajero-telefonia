<!-- Button trigger modal -->
<br>
<button type="button" class="btn btn-primary" style="background-color: #3bc8f5 !important; border-color: #3bc8f5 !important; font-weight: bold !important" data-bs-toggle="modal" data-bs-target="#formCampana2">
    Crear Campañas
</button>

<!-- Modal -->
<div class="modal hide" id="formCampana2" tabindex="-1" aria-labelledby="formCampana2Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formCampana2Label">Agregar Campaña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCampanaTwo">
                    <input type="hidden" name="save" value="Y">
                    <input type="hidden" name="access_token" value="<?= $_REQUEST['AUTH_ID']; ?>">
                    <input type="hidden" name="refresh_token" value="<?= $_REQUEST['REFRESH_ID']; ?>">
                    <input type="hidden" name="domain" value="<?= $_REQUEST['DOMAIN']; ?>">
                    <input type="hidden" name="member_id" value="<?= $_REQUEST['member_id']; ?>">
                    <div class="mb-3 position-relative">
                        <label for="campanaNombre" class="form-label">Nombre de campaña: </label>
                        <input type="text" class="form-control" id="campanaNombre" name="campanaNombre" />
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaCola" class="form-label">Id de cola de atención: </label>
                        <input type="text" class="form-control" id="campanaCola2" name="campanaCola" />
                    </div>
                    <div class="mb-3">
                        <label for="campanaEstado" class="form-label">Estado de prospecto: </label>
                        <select class="form-select" aria-label="Default select example" id="campanaEstadoLead" name="campanaEstado">                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="campanaOrigen" class="form-label">Origen: </label>
                        <select class="form-select" aria-label="Default select example" id="campanaOrigen" name="campanaOrigen">
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaIntentosMax" class="form-label">Intentos máximos: </label>
                        <input type="text" class="form-control" id="campanaIntentosMax" name="campanaIntentosMax" />
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaIntervaloLlamadas" class="form-label">Intervalo entre llamadas: </label>
                        <input type="text" class="form-control" id="campanaIntervaloLlamadas" name="campanaIntervaloLlamadas" />
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaAgentes" class="form-label">Agentes: </label>
                        <input type="text" class="form-control" id="campanaAgentes" name="campanaAgentes" />
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaNumTelf" class="form-label">Número de teléfono: </label>
                        <input type="text" class="form-control" id="campanaNumTelf" name="campanaNumTelf" />
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="campanaTipo" class="form-label">Tipo: </label>
                        <select class="form-select" aria-label="Default select example" id="campanaTipo" name="campanaTipo">
                            <option value="1">Predictivo</option>
                            <option value="2">Progresivo</option>
                            <option value="3">PressOne</option>
                            <option value="4">Reverse</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-guardar-campana" style="background-color: #3bc8f5 !important; border-color: #3bc8f5 !important; font-weight: bold !important" type="button" class="btn btn-primary btn-save" onclick="validate()">Guardar</button>
                <button id="btn-cargando-campana" style="background-color: #3bc8f5 !important; border-color: #3bc8f5 !important; font-weight: bold !important; display: none !important" type="button" class="btn btn-primary btn-save" disabled>Cargando...</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>