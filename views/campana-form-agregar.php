<?php
?>
<form id="formCampana" class="needs-validation" novalidate>
    <input type="hidden" name="save" value="Y">
    <input type="hidden" name="access_token" value="<?= $_REQUEST['AUTH_ID']; ?>">
    <input type="hidden" name="refresh_token" value="<?= $_REQUEST['REFRESH_ID']; ?>">
    <input type="hidden" name="domain" value="<?= $_REQUEST['DOMAIN']; ?>">
    <input type="hidden" name="member_id" value="<?= $_REQUEST['member_id']; ?>">
    <div class="mb-3 position-relative">
        <label for="campanaNombre" class="form-label">Nombre de campaña: </label>
        <input type="text" class="form-control" id="campanaNombre" name="campanaNombre" required />
        <div class="invalid-tooltip">
            Ingresa el nombre de la campaña.
        </div>
    </div>
    <div class="mb-3 position-relative">
        <label for="campanaCola" class="form-label">Seleccionar cola de atención: </label>
        <select class="form-select" aria-label="Default select example" id="campanaCola" name="campanaCola" required>
        </select>
        <div class="invalid-tooltip">
            Ingresa una cola para la campaña.
        </div>
    </div>
    <div class="mb-3 position-relative">
        <label for="campanaEntidad" class="form-label">Entidad: </label>
        <select class="form-select" aria-label="Default select example" id="campanaEntidad" name="campanaEntidad" required>
            <option value="">Seleccionar</option>
            <option value="lead">Prospecto</option>
            <option value="deal">Negociación</option>
        </select>
        <div class="invalid-tooltip">
            Ingresa la entidad de la campaña.
        </div>
    </div>
    <div class="mb-3">
        <label for="campanaEstado" class="form-label">Estado: </label>
        <select class="form-select" aria-label="Default select example" id="campanaEstado" name="campanaEstado">
            <option value="">Seleccionar</option>
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
        <input type="text" class="form-control" id="campanaIntentosMax" name="campanaIntentosMax" required />
        <div class="invalid-tooltip">
            Ingresa intentos máximos.
        </div>
    </div>
    <div class="mb-3 position-relative">
        <label for="campanaIntervaloLlamadas" class="form-label">Intervalo entre llamadas: </label>
        <input type="text" class="form-control" id="campanaIntervaloLlamadas" name="campanaIntervaloLlamadas" required />
        <div class="invalid-tooltip">
            Ingresa intervalo entre llamadas.
        </div>
    </div>
    <div class="mb-3 position-relative">
        <label for="campanaAgentes" class="form-label">Agentes: </label>
        <input type="text" class="form-control" id="campanaAgentes" name="campanaAgentes" required />
        <div class="invalid-tooltip">
            Ingresa agentes.
        </div>
    </div>
    <div class="mb-3 position-relative">
        <label for="campanaNumTelf" class="form-label">Número de teléfono: </label>
        <input type="text" class="form-control" id="campanaNumTelf" name="campanaNumTelf" required />
        <div class="invalid-tooltip">
            Ingresa el número de la campaña.
        </div>
    </div>
    <div class="mb-3 position-relative">
        <label for="campanaTipo" class="form-label">Tipo: </label>
        <select class="form-select" aria-label="Default select example" id="campanaTipo" name="campanaTipo" required>
            <option value="0">Seleccionar</option>
            <option value="1">Predictivo</option>
            <option value="2">Progresivo</option>
            <option value="3">PressOne</option>
        </select>
        <div class="invalid-tooltip">
            Ingresa el tipo de la campaña.
        </div>
    </div>
    <div id="div"></div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-save btn-crear-campana">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    </div>
</form>