<?php
/* Made by Andrew Jones for WiderPlan.com */
require('controllerInput.php');
require('controllerMaths.php');

$oControllerInput = new controllerInput();
$oControllerInput->setFilePath('testdata.csv');
$aFileData = $oControllerInput->parseCSVFile();
