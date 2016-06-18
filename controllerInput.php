<?php

/* This controller is used to parse input files */

class controllerInput {

    private $filePath;
    private $fileSource;
    private $aData = array();
    private $iDataAmount = 0;

    public function parseCSVFile() {
        if (!$this->getFilePath() || !file_exists($this->getFilePath())) {
            throw new Exception('Can\'t find the source file!');
        }
        $this->fileSource = trim(file_get_contents($this->getFilePath()));
    }

    public function organiseData() {
        $fileDataRows = explode("\n", $this->fileSource);
        foreach ($fileDataRows as $row) {
            $aColumns = explode(",", $row);
            $iDataValue = floatval($aColumns[1]);
            if ($iDataValue) {
                array_push($this->aData, $iDataValue);
            }
        }
    }

    public function sortFileDataDescending() {
        if (!is_array($this->getAData())) {
            throw new Exception('You need to organise the data first');
        }

        $storedData = array();
        $aData = array();
        
        
        foreach ($this->getAData() as $value) {
            if (isset($storedData[$value])) {
                $storedData[$value]['value'] = $value;
                $storedData[$value]['count'] ++;
            } else {
                $storedData = array_pad($storedData, ($value - 1), null);
                $storedData[$value] = array(
                    'count' => 1
                    ,'value' => $value
                    );
            }
        }

        $amountOfStoredData = count($storedData);

        for ($i = 0; $i <= $amountOfStoredData; $i++) {
            if (isset($storedData[$i]) && $storedData[$i]) {
                if ($storedData[$i]['count'] > 1) {
                    for ($j = 1; $j <= $storedData[$i]['count']; $j++) {
                        array_push($aData, $storedData[$i]['value']);
                    }
                } else {
                    array_push($aData, $storedData[$i]['value']);
                }
            }
        }

        $this->setAData($aData);
    }

    /* Getters & Setters */

    public function getFilePath() {
        return $this->filePath;
    }

    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }

    public function getAData() {
        return $this->aData;
    }

    public function setAData($aData) {
        $this->aData = $aData;
    }

}
