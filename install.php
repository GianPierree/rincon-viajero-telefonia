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
			Se instaló el aplicativo correctamente.
		<?php else : ?>
			Error cuando se instaló el aplicativo.
		<?php endif; ?>
	</body>
<?php endif;
