<?php

require_once('./vendor/autoload.php');

$textrun = new \PhpOffice\PhpWord\Element\TextRun;
$textrun->addText('Text123');
$textrun->addTextBreak();
$textrun->addText('Text123');

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
$templateProcessor->setComplexValue('TEST', $textrun);

$filename_urlencoded = urlencode('result.docx');

header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Encoding: UTF-8');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename* = UTF-8\'\'' . $filename_urlencoded);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Pragma: no-cache');

$templateProcessor->saveAs('php://output');