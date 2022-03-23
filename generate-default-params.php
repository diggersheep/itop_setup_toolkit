<?php

if (sizeof($argv) < 4) {
    echo "usage: php generate.php <setup_template_filename> <output_filename> <module_json_filename>\n";
    exit(1);
}

$sFilename = $argv[1];
$sOutputFilename = $argv[2];
$sModuleFilename = $argv[3];

$aJsonContent = json_decode(
    file_get_contents($sModuleFilename),
    true
);

$sFormattedModules = "";
foreach ($aJsonContent as $sModule) {
    $sFormattedModules .= "    <item>" . $sModule . "</item>\n";
}

$sContent = file_get_contents($sFilename);
$sFormattedContent = sprintf($sContent, $sFormattedModules, $sFormattedModules);

file_put_contents($sOutputFilename, $sFormattedContent);
