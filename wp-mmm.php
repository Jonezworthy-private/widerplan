<?php
/* Made by Andrew Jones for WiderPlan.com */
require('controllerInput.php');
require('controllerMaths.php');

$oControllerInput = new controllerInput();
//$oControllerInput->setFilePath('testdata.csv');
$oControllerInput->setSFilePath('benchmark.csv');
$oControllerInput->parseCSVFile();
$oControllerInput->organiseData();
$oControllerInput->sortFileDataAscending();

$oControllerMaths = new controllerMaths($oControllerInput->getAData());

$aReportDetails = array(
    'total' => $oControllerMaths->arrayCalculateTotal()
        ,'mean' => $oControllerMaths->arrayCalculateMean()
        , 'modal' => array($oControllerMaths->arrayCalculateMode())
        ,'median' => $oControllerMaths->arrayCalculateMedian()
        , 'frequency' => $oControllerMaths->arrayCalculateFrequency()
);

echo json_encode($aReportDetails);
