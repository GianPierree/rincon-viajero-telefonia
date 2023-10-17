<?php
require_once(__DIR__ . '/crest.php');

$result = CRest::installApp();
if ($result['rest_only'] === false) : ?>

	<head>
		<script src="//api.bitrix24.com/api/v1/"></script>
		<?php if ($result['install'] == true) : ?>
			<script>
				BX24.init(function() {
					BX24.installFinish();
				});
			</script>
		<?php endif; ?>
	</head>

	<body>
		<?php if ($result['install'] == true) : ?>
			La instalación de <strong>AsesoresT24</strong> se realizó correctamente :D
		<?php else : ?>
			No se realizó la instalación de AsesoresT24. Contactar a nuestro equipo de soporte (soporte@asesores-e.com).
		<?php endif; ?>
	</body>
<?php endif;
