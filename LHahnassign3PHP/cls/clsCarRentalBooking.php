<?php

/* 
Written by: Lucas Hahn 
Assignment #3
*/
class clsCarRentalBooking extends clsBooking {

    private $Insurance;

    public function __construct($pCustomerName = "", $pPricePerDay = 0, $pNbrOfDays = 0, $pInsurance = 0) {
        $this->setInsurance($pInsurance);
        parent::__construct($pCustomerName, $pPricePerDay, $pNbrOfDays);
    }

    public function getInsurance() {
        return $this->Insurance;
    }

    public function setInsurance($pInsurance) {
        if ($pInsurance >= 0)
            $this->Insurance = $pInsurance;
    }

    public function calcAmtOwing($subTotal = 0, $tax = 0, $total = 0) {
        $subTotal = $this->PricePerDay * $this->NbrOfDays + $this->Insurance;
        $tax = $subTotal * $this->TaxRate;
        $total = $subTotal + $tax;

        return array(
            'total' => $total,
            'subTotal' => $subTotal,
            'tax' => $tax
        );
    }

}
