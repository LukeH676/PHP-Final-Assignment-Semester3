<?php
/* 
Written by: Lucas Hahn 
Assignment #3
*/
class clsMySQLFunctions {

    private $mysqlObj;

    public function __construct() {
        $Host = "localhost";
        $UserName = "root";
        $Password = "mysql";
        $Database = "test";
        $this->mysqlObj = new mysqli($Host, $UserName, $Password, $Database);
    }

    public function retrieveAllTripsInTable() {
        $sql = "SELECT tripNbr, departureCity, arrivalCity FROM Trips";
        $result = $this->mysqlObj->query($sql);

        if ($result->num_rows > 0) {

            $tripData = array();
            while ($row = $result->fetch_assoc()) {
                $tripData[] = array(
                    'tripNbr' => $row['tripNbr'],
                    'departureCity' => $row['departureCity'],
                    'arrivalCity' => $row['arrivalCity'],
                );
            }
            return $tripData;
        }
    }

    public function retrieveRequestedFlights($tripId) {
        $sql = "SELECT flights.tripNbr, trips.departureCity, Trips.arrivalCity, flights.flightNbr, DATE_FORMAT(whenDeparts ,'%b %d %Y') FROM Flights JOIN trips 
       ON trips.tripNbr = flights.tripNbr WHERE trips.tripNbr = " . intval($tripId);

        $result = $this->mysqlObj->query($sql);

        

        if ($result->num_rows > 0) {

            $flightData = array();
            while ($row = $result->fetch_assoc()) {
                $flightData[] = array(
                    'tripNbr' => $row['tripNbr'],
                    'departureCity' => $row['departureCity'],
                    'arrivalCity' => $row['arrivalCity'],
                    'flightNbr' => $row['flightNbr'],
                    "DATE_FORMAT(whenDeparts ,'%b %d %Y')" => $row['DATE_FORMAT(whenDeparts ,\'%b %d %Y\')']
                );
            }
            return $flightData;
        }
    }
// NOTE -- Tried all different types of Time formatting with zero succcess. 
    public function retrieveOneFlight($flightId) {
        $sql = "SELECT flights.tripNbr, trips.departureCity, trips.arrivalCity, flights.flightNbr, DATE_FORMAT(whenDeparts ,'%b %d %Y'), 
              flights.flightLength,flights.flightDetails FROM Flights JOIN trips 
       ON trips.tripNbr = flights.tripNbr WHERE flights.flightNbr = " . intval($flightId);        
        $result = $this->mysqlObj->query($sql);
      
        if ($result->num_rows > 0) {
    
            return $result->fetch_assoc();

        }
    }

}
