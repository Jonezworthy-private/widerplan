<?php

/* This controller is used to parse input files */

class controllerInput {

    private $sFilePath;
    private $sFileSource;
    private $aData = array();
    private $iDataAmount = 0;

    public function parseCSVFile() {
        if (!$this->getSFilePath() || !file_exists($this->getSFilePath())) {
            throw new Exception('Can\'t find the source file!');
        }
        $this->sFileSource = trim(file_get_contents($this->getSFilePath()));
    }

    public function organiseData() {
        $sFileDataRows = explode("\n", $this->sFileSource);
        foreach ($sFileDataRows as $sDataRow) {
            $aColumns = explode(",", $sDataRow);
            $iDataValue = floatval($aColumns[1]);
            if ($iDataValue) {
                array_push($this->aData, $iDataValue);
            }
        }
        unset($this->sFileSource);//No longer need it
    }

    public function sortFileDataAscending() {
        if (!is_array($this->getAData())) {
            throw new Exception('You need to organise the data first');
        }

        $aStoredData = array();
        $aData = array();
        //This uses PHP's natural array sorting
        
        foreach ($this->getAData() as $iValue) {
            if (isset($aStoredData[$iValue])) {
                $aStoredData[$iValue]['value'] = $iValue;
                $aStoredData[$iValue]['count'] ++;
            } else {
                $aStoredData = array_pad($aStoredData, ($iValue - 1), null);
                $aStoredData[$iValue] = array(
                    'count' => 1
                    ,'value' => $iValue
                    );
            }
        }
        //This padded array contains all of the values but natrually sorted by PHP
        //Now we will remove the gaps, leaving the data in order
        $iAmountOfStoredData = count($aStoredData);

        for ($i = 0; $i <= $iAmountOfStoredData; $i++) {
            if (isset($aStoredData[$i]) && $aStoredData[$i]) {
                if ($aStoredData[$i]['count'] > 1) {
                    for ($j = 1; $j <= $aStoredData[$i]['count']; $j++) {
                        array_push($aData, $aStoredData[$i]['value']);
                    }
                } else {
                    array_push($aData, $aStoredData[$i]['value']);
                }
            }
        }
        $this->setAData($aData);
    }

    /* Getters & Setters */

    public function getSFilePath() {
        return $this->sFilePath;
    }

    public function setSFilePath($sFilePath) {
        $this->sFilePath = $sFilePath;
    }

    public function getAData() {
        return $this->aData;
    }

    public function setAData($aData) {
        $this->aData = $aData;
    }

}
