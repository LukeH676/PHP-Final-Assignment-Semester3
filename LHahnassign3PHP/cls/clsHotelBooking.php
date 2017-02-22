<?php
/* 
Written by: Lucas Hahn 
Assignment #3
*/
class clsHotelBooking extends clsBooking {

    private $HotelParking;

    public function __construct($pCustomerName = "", $pPricePerDay = 0, $pNbrOfDays = 0, $pHotelParking = 0) {
        $this->setHotelParking($pHotelParking);
        parent::__construct($pCustomerName, $pPricePerDay, $pNbrOfDays);
    }

    public function getHotelParking() {
        return $this->HotelParking;
    }

    public function setHotelparking($pHotelParking) {
        if ($pHotelParking >= 0)
            $this->HotelParking = $pHotelParking;
    }

    public function calcAmtOwing($subTotal = 0, $tax = 0, $total = 0) {
        $subTotal = $this->PricePerDay * $this->NbrOfDays + $this->HotelParking;
        $tax = $subTotal * $this->TaxRate;
        $total = $subTotal + $tax;

        return array(
            'total' => $total,
            'subTotal' => $subTotal,
            'tax' => $tax
        );
    }

}
