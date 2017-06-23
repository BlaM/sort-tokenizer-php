<pre><?php

require 'tokenizer.php';

$t = new SortTokenizer();
$t->keys = array(
    'name' => array(-1, 1),
    'id' => array(-1)
);

echo(json_encode($t->parse('-name'))), '<hr>';
echo(json_encode($t->parse('id'))), '<hr>';
echo(json_encode($t->parse('-id'))), '<hr>';
echo(json_encode($t->parse('name,-id'))), '<hr>';
