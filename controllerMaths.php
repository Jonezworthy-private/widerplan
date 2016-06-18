<?php

/* This controller is used to hold the mathematical methods */

class controllerMaths {

    private $aInput;
    private $iComputedTotal;
    private $iComputedModal;
    private $iComputedFrequency;

    public function arrayCalculateTotal() {
        $fRunningTotal = 0;
        if (!$this->getAInput() || !is_array($this->getAInput())) {
            throw new Exception('No array has been set');
        }
        foreach ($this->getAInput() as $value) {
            $fRunningTotal += floatval($value);
        }

        return round($fRunningTotal, 2);
    }

    public function arrayCalculateMean() {
        $fArrayTotal = $this->getIComputedTotal() ? $this->getIComputedTotal() : $this->arrayCalculateTotal();
        $iAmountOfData = count($this->getAInput());

        return $fArrayTotal / $iAmountOfData;
    }

    public function arrayCalculateMode() {
        $aData = $this->getAInput();
        $aCounts = array();
        $highestValue = 0;
        $highestCount = 0;

        foreach ($aData as $data) {
            if (!isset($aCounts[$data])) {
                $aCounts[$data] = 0;
            }
            $aCounts[$data] ++;
        }
        foreach ($aCounts as $value => $count) {
            if ($count > $highestCount) {
                $highestValue = $value;
                $highestCount = $count;
            }
        }

        $this->setIComputedModal($highestValue);
        $this->setIComputedFrequency($highestCount);
    }

    public function arrayCalculateMedian() {
        $aData = $this->getAInput();
        $iAmountOfData = count($aData);
        if ($iAmountOfData % 2 === 0) {//if Odd
            $iArrayKeyMedian = ($iAmountOfData / 2) - 1;
            return $aData[$iArrayKeyMedian];
        } else {//Even
            //Median point has 2 values, reutn the average of the two
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

    public function getAInput() {
        return $this->aInput;
    }

    public function setAInput($aInput) {
        $this->aInput = $aInput;
    }

}
