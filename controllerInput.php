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
        if (!is_array($this->aData)) {
            throw new Exception('You need to organise the data first');
        }

        echo '<pre>';
        print_r($this->aData);
        echo '</pre>';

        $this->iDataAmount = count($this->aData);

        
        
        
        
        $sortedData = array();
        foreach ($this->aData as $value) {
            if (!$sortedData) {
                array_push($sortedData, $value);
                continue 1;
            }
            foreach ($sortedData as $iKey => $sortedValue) {
                if ($value >= $sortedValue) {
                    if (isset($sortedData[$iKey + 1]) && $value < $sortedData[$iKey + 1]) {
                        continue 2;
                    } else {
                        array_splice($sortedData, $iKey, 0, $value);
                        continue 2;
                    }
                } elseif ($value < $sortedValue) {
                    if ($value < $sortedData[count($sortedData) - 1]) {
                        array_push($sortedData, $value);
                        continue 2;
                    }
                }
            }
        }

        echo '<pre>';
        print_r($sortedData);
        echo '</pre>';
    }

    public function getFilePath() {
        return $this->filePath;
    }

    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }

    public function getFileData() {
        return $this->fileData;
    }

    public function setFileData($fileData) {
        $this->fileData = $fileData;
    }

}
