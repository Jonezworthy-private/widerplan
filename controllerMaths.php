<?php

/* This controller is used to hold the mathematical methods */

class controllerMaths {

    private $aInput;
    private $iComputedTotal;
    private $iComputedModal;
    private $iComputedFrequency;

    public function __construct($aInput) {
        if (isset($aInput) && is_array($aInput)) {
            $this->setAInput($aInput);
        } else {
            throw new Exception('No array has been set');
        }
    }

    public function arrayCalculateTotal() {
        $fRunningTotal = 0;
        foreach ($this->getAInput() as $iValue) {
            $fRunningTotal += floatval($iValue);
        }

        return round($fRunningTotal, 2); 
    }

    public function arrayCalculateMean() {
        $fArrayTotal = $this->getIComputedTotal() ? $this->getIComputedTotal() : $this->arrayCalculateTotal();
        $iAmountOfData = count($this->getAInput());

        return round($fArrayTotal / $iAmountOfData, 2);
    }

    public function arrayCalculateMode() {
        $aCounts = array();
        $iHighestValue = 0;
        $iHighestCount = 0;
        //Take counts of each number
        foreach ($this->getAInput() as $iValue) {
            if (!isset($aCounts[$iValue])) {
                $aCounts[$iValue] = 0;
            }
            $aCounts[$iValue] ++;
        }
        //Find the highest count
        foreach ($aCounts as $iValue => $iCount) {
            if ($iCount > $iHighestCount) {
                $iHighestValue = $iValue;
                $iHighestCount = $iCount;
            }
        }

        $this->setIComputedModal($iHighestValue);
        $this->setIComputedFrequency($iHighestCount);
        return $iHighestValue;
    }

    public function arrayCalculateFrequency() {
        //calculate mode does the work, run it if we need to
        if (!$this->getIComputedFrequency()) {
            $this->arrayCalculateMode();
        }
        return $this->getIComputedFrequency();
    }

    public function arrayCalculateMedian() {
        $aData = $this->getAInput(); //taking a reference
        $iAmountOfData = count($aData);
        if ($iAmountOfData % 2 === 0) {//if Odd
            $iArrayKeyMedian = ($iAmountOfData / 2) - 1;
            return $aData[$iArrayKeyMedian];
        } else {//Even
            //Median point has 2 values, return the average of the two
            $iArrayKeyMedianLow = ($iAmountOfData / 2) - 1;
            $iArrayKeyMedianHigh = ($iAmountOfData / 2) - 1;

            $iMedianLow = $aData[$iArrayKeyMedianLow];
            $iMedianHigh = $aData[$iArrayKeyMedianHigh];

            return ($iMedianLow + $iMedianHigh / 2);
        }
    }

    /* Getters & Setters */

    public function getIComputedModal() {
        return $this->iComputedModal;
    }

    public function getIComputedFrequency() {
        return $this->iComputedFrequency;
    }

    public function setIComputedModal($iComputedModal) {
        $this->iComputedModal = $iComputedModal;
    }

    public function setIComputedFrequency($iComputedFrequency) {
        $this->iComputedFrequency = $iComputedFrequency;
    }

    public function getIComputedTotal() {
        return $this->iComputedTotal;
    }

    public function setIComputedTotal($iComputedTotal) {
        $this->iComputedTotal = $iComputedTotal;
    }

    private function getAInput() {
        return $this->aInput;
    }

    private function setAInput($aInput) {
        $this->aInput = $aInput;
    }

}
