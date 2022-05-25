<?php

header('Content-type: application/pdf');
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Content-Disposition: inline;filename=myfile.pdf'");
header("Content-length: ".strlen($arquivo));

echo $arquivo;
