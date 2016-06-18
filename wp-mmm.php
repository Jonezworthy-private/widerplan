<?php
/* Made by Andrew Jones for WiderPlan.com */
require('controllerInput.php');
require('controllerMaths.php');

$oControllerInput = new controllerInput();
//$oControllerInput->setFilePath('testdata.csv');
$oControllerInput->setFilePath('benchmark.csv');
$oControllerInput->parseCSVFile();
$oControllerInput->organiseData();
$oControllerInput->sortFileDataDescending();

$oControllerMaths = new controllerMaths();
$oControllerMaths->setAInput($oControllerInput->getAData());
$oControllerMaths->arrayCalculateMode();

$aReportDetails = array(
    'total' => $oControllerMaths->arrayCalculateTotal()
        ,'mean' => $oControllerMaths->arrayCalculateMean()
        , 'modal' => array($oControllerMaths->getIComputedModal())
        ,'median' => $oControllerMaths->arrayCalculateMedian()
        , 'frequency' => $oControllerMaths->getIComputedFrequency()
);


//echo '<pre>';
//print_r($oControllerInput->getAData());
//echo '</pre>';
echo '<pre>';
echo json_encode($aReportDetails);
echo '</pre>';
