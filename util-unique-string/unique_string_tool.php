<?php
/**
 * Created by PhpStorm.
 * User: chenjinlong
 * Date: 1/8/16
 * Time: 4:36 PM
 */

print_r("Begin reading source file...\n");
$sourceArr = array();
$handle = @fopen("source.txt", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        $tempStr = strval($buffer);
        if (strlen($tempStr) == 0 || $tempStr == '\n' || $tempStr == '\r' || $tempStr == '\t') {
            continue;
        }
        if (!in_array($tempStr, $sourceArr)) {
            $sourceArr[] = $tempStr;
        }
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail when reading source.txt\n";
    }
}
fclose($handle);
print_r("Reading source file completely...\n");

print_r("Begin writing target file...\n");

// The reason why use "w" mode here is to place the file pointer
// at the beginning of the file and truncate the file to zero length.
$handle = @fopen("target.txt", "w");
if (empty($sourceArr)) {
    echo "source.txt is an empty file.\n";
    return;
}
if ($handle) {
    foreach($sourceArr as $value) {
        fwrite($handle, $value);
    }
}
fclose($handle);
print_r("Writing target file completely...\n");