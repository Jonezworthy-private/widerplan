<?php

/* This controller is used to parse input files */

class controllerInput {

    private $filePath;
    private $fileSource;
    private $aData = array();

    public function parseCSVFile() {
        if (!$this->getFilePath() || !file_exists($this->getFilePath())) {
            throw new Exception('Can\'t find the source file!');
        }
        $this->fileSource = file_get_contents($this->getFilePath());
    }

    public function organiseData() {
        $fileDataRows = explode("\n", $this->fileSource);
        foreach ($fileDataRows as $row) {
            $aColumns = explode(",", $row);
            $iDataKey = intval($aColumns[0]);
            $sDataValue = floatval($aColumns[1]);
            if ($iDataKey && $sDataValue) {
                $this->aData[$iDataKey] = $sDataValue;
            }
        }

        echo '<pre>';
        print_r($this->aData);
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
