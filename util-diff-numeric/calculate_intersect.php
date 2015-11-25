<?php 
print_r("读取当前目标迁移数据...\n");
$targetArr = array();
$handle = @fopen("target.txt", "r");
if ($handle) {
	while (($buffer = fgets($handle, 4096)) !== false) {
		$targetArr[] = intval($buffer);
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail when reading target.txt\n";
    }
}
fclose($handle);

print_r("读取当前待迁移统计数据...\n");
$sourceCmpArr = array();
$handle = @fopen("source.txt", "r");
if ($handle) {
	while (($buffer = fgets($handle, 4096)) !== false) {
		$sourceCmpArr[] = intval($buffer);
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail when reading source.txt\n";
    }
}
fclose($handle);

var_dump(sizeof($targetArr), sizeof($sourceCmpArr));
// $sourceCmpArr = array("33248\n",33249);
// $targetArr = array(33257,"33248\n");
print_r("打印相同的编号如下：\n");
var_dump(array_intersect($targetArr, $sourceCmpArr));


