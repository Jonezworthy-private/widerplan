<?php

/* This controller is used to parse input files */

class controllerInput {

    private $filePath;
    private $fileSource;
    private $fileData;

    public function parseCSVFile() {
        if (!$this->getFilePath() || !file_exists($this->getFilePath())) {
            throw new Exception('Can\'t find the source file!');
        }
        $this->fileSource = file_get_contents($this->getFilePath());
        $this->fileData = explode(",", $this->fileSource);
        
        echo '<pre>';
        print_r($this->fileData);
        echo '</pre>';
    }
    
    public function organiseData(){
        
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
