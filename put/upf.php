<?php

$content = file_get_contents('php://input');
print_r("ok");
$handle = fopen("./hello.json", "w+");
fwrite($handle, $content, strlen($content));
fclose($handle);

?>
