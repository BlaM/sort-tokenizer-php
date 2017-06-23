<pre><?php

require 'tokenizer.php';

$t = new SortTokenizer();
$t->keys = array(
    'name' => array(-1, 1),
    'id' => array(-1)
);

echo '<h1>Name descending:</h1>';
echo(json_encode($t->parse('-name'))), '<hr>';

echo '<h1>Nothing, no match in keys (id ascending not allowed):</h1>';
echo(json_encode($t->parse('id'))), '<hr>';

echo '<h1>ID descending:</h1>';
echo(json_encode($t->parse('-id'))), '<hr>';

echo '<h1>Name ascending, then ID descending:</h1>';
echo(json_encode($t->parse('name,-id'))), '<hr>';

echo '<h1>Nothing, no match in keys (boop not allowed):</h1>';
echo(json_encode($t->parse('boop'))), '<hr>';

echo '<h1>Exception, no match in keys (boop not allowed):</h1>';
$t->throwOnUnsupportedKey = true;

try {
    echo(json_encode($t->parse('boop'))), '<hr>';
} catch(Exception $E) {
    print_r($E);
    echo '<hr>';
}

echo '<h1>"boop" ascending, everything is allowed:</h1>';
$t->keys = array();
echo(json_encode($t->parse('boop'))), '<hr>';
