<?php

/* 
Written by: Lucas Hahn 
Assignment #3
*/
abstract class clsBooking {

    protected $TaxRate = 0.13;
    protected $CustomerName;
    protected $PricePerDay;
    protected $NbrOfDays;

    public function __construct($pCustomerName = "", $pPricePerDay = 0, $pNbrOfDays = 0) {
        $this->setCustomerName($pCustomerName);
        $this->setPricePerDay($pPricePerDay);
        $this->setNbrOfDays($pNbrOfDays);
    }

    public function getCustomerName() {
        return $this->CustomerName;
    }

    public function setCustomerName($pCustomerName) {
        if ($pCustomerName != NULL)
            $this->CustomerName = $pCustomerName;
    }

    public function getPricePerDay() {
        return $this->PricePerDay;
    }

    public function setPricePerDay($pPricePerDay) {
        if ($pPricePerDay >= 0)
            $this->PricePerDay = $pPricePerDay;
    }

    public function getNbrOfDays() {
        return $this->NbrOfDays;
    }

    public function setNbrOfDays($pNbrOfDays) {
        if ($pNbrOfDays >= 0)
            $this->NbrOfDays = $pNbrOfDays;
    }

    public abstract function calcAmtOwing($subTotal, $tax, $total);
}
