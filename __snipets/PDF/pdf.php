<?php

$path = '../test2.pdf';

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>PDF.js Example</title>
        <link rel="stylesheet" href="./css/viewer-iframe.css">
	</head>
	<body>
		<iframe class="pdf-viewer-iframe" src="./web/viewer.html?file=<?= $path; ?>" />
	</body>
</html>
