<?php
/* 
Written by: Lucas Hahn 
Assignment #3
*/

require_once("asst3include.php");
require_once ("cls/clsBooking.php");
require_once ("cls/clsMySQLFunctions.php");
require_once ("cls/clsCarRentalBooking.php");
require_once ("cls/clsHotelBooking.php");
echo " <link rel=\"stylesheet\" href=\"css/Asst3Style.css\"/> ";
// *** Modify the line below to run your asst. Test the link 
// http://localhost/LHahnassign3PHP/asst3main.php?

date_default_timezone_set('America/Toronto');
if (isset($_POST['findFlightsButton']))
    displayFlights();
else if (isset($_POST['bookFlightButton']))
    bookFlight();
else if (isset($_POST['rentCarButton']))
    rentCar();
else if (isset($_POST['bookHotelButton']))
    bookHotel();
else
    displayMainForm();

function displayMainForm() {
    echo "<form action = ? method = post>";
    echo "<div class = \"leftpiece\">";
    echo "<fieldset>
	<legend>Rent A Car</legend>";
    echo "<div class = \"addspace\">";
    DisplayLabel("Customer Name");
    DisplayTextbox("f_CarCustomerName", 25, "");
    echo "</div>";
    echo "<div class = \"addspace\">";
    DisplayLabel("Price Per Day");
    DisplayTextbox("f_CarPricePerDay", 0, "");
    echo "</div>";
    echo "<div class = \"addspace\">";
    DisplayLabel("Number of Days");
    DisplayTextbox("f_CarNbrOfDays", 0, "");
    echo "</div>";

    echo "<div class = \"addspace\">";
    DisplayLabel("Insurance");
    DisplayTextbox("f_CarInsurance", 7, 0);
    echo "</div>";
    echo "<button name = \"rentCarButton\">Rent a car</button>";
    echo "</fieldset>";
    echo "</div><div class = \"middlepiece\">";

    echo "<fieldset>
	<legend>Book A Hotel</legend>";
    echo "<div class = \"addspace\">";
    DisplayLabel("Customer Name");
    DisplayTextbox("f_HotelCustomerName", 25, "");
    echo "</div>";
    echo "<div class = \"addspace\">";
    DisplayLabel("Price Per Day");
    DisplayTextbox("f_HotelPricePerDay", 7, 0);
    echo "</div>";
    echo "<div class = \"addspace\">";
    DisplayLabel("Number of Days");
    DisplayTextbox("f_HotelNbrOfDays", 4, 0);
    echo "</div>";
    echo "<div class = \"addspace\">";
    DisplayLabel("Parking");
    DisplayTextbox("f_HotelParking", 7, 0);
    echo "</div>";
    echo "<p><button name = \"bookHotelButton\">Book a hotel</button></p>";
    echo "</fieldset>";
    echo "</div>";
    echo "<div class = \"rightpiece\">";
    echo "<fieldset><legend>Trips</legend>";
    echo "<div class = \"addspace\">";
    DisplayLabel("Trips");
    $newMysql = new clsMySQLFunctions();
    $trips = $newMysql->retrieveAllTripsInTable();

    echo "<select size = \"3\" name = \"tripNbr\">";
    foreach ($trips as $trip) {
        echo "<option value='" . $trip['tripNbr'] . "'>" . $trip['departureCity'] . "<------>" . $trip['arrivalCity'] . "</option>";
    }
    echo "</select>";

    echo "</div>";
    echo "<button name = \"findFlightsButton\">Find Flights</button>";
    echo "</fieldset>";
    echo "</div>";
    echo "</form>";
}

function rentCar() {
    $carRental = new clsCarRentalBooking($_POST['f_CarCustomerName'], $_POST['f_CarPricePerDay'], $_POST['f_CarNbrOfDays'], $_POST['f_CarInsurance']);
    $carAmtOwing = $carRental->calcAmtOwing();
    echo "<form action = ? method = post>";
    echo "<p>";
//$newCar = new clsCarRentalBooking;
    echo "Thank you for borrowing our race car. " .
    "Subtotal: $" . number_format($carAmtOwing['subTotal'], 2) .
    ". Tax amount: $" . number_format($carAmtOwing['tax'], 2) .
    ". Total: $" . number_format($carAmtOwing['total'], 2);
    echo "</p>";
    echo "<button name = \"Home\">Home</button>";
    echo "</form>";
}

function bookHotel() {
    $hotelBooking = new clsHotelBooking($_POST['f_HotelCustomerName'], $_POST['f_HotelPricePerDay'], $_POST['f_HotelNbrOfDays'], $_POST['f_HotelParking']);
    $hotelAmtOwing = $hotelBooking->calcAmtOwing();
    echo "<form action = ? method = post>";
    echo "<p>";

    echo "Thank you for staying with us. " .
    "Subtotal: $" . number_format($hotelAmtOwing['subTotal'], 2) .
    ". Tax amount: $" . number_format($hotelAmtOwing['tax'], 2) .
    ". Total: $" . number_format($hotelAmtOwing['total'], 2);
    echo "</p>";
    echo "<button name = \"Home\">Home</button>";
    echo "</form>";
}

function displayFlights() {
    echo "<h2>Showing Your Flights</h2>";
    echo "<form action = ? method = post>";
    $newMysql = new clsMySQLFunctions();
   $flights = $newMysql->retrieveRequestedFlights($_POST['tripNbr']);
  

    echo "<select size = \"5\" name = \"flightNbr\">";
    foreach ($flights as $flight) {
        echo "<option value='" . $flight['flightNbr'] . "'>" ."  Flight #  ". $flight['flightNbr'] ." :". $flight['departureCity'] . " To " . $flight['arrivalCity'] . " - Leaving: " .
                  $flight['DATE_FORMAT(whenDeparts ,\'%b %d %Y\')'] . "</option>";
    }
    echo "</select>";
    echo "<button name = \"bookFlightButton\">Book flight</button>";
    echo "</form>";
}

function bookFlight() {
    echo "<h2>Your Flight Is Booked!</h2>";
    echo "<form action = ? method = post>";
    $newMysql = new clsMySQLFunctions();
    $booked = $newMysql->retrieveOneFlight($_POST['flightNbr']);

    echo "<select size = \"5\" name = \"bookNbr\">";
        echo "<option value='" . $booked['flightNbr'] . "'>" ."  Flight #  ". $booked['flightNbr'] ." :". $booked['departureCity'] . " To " . $booked['arrivalCity'] . " - Leaving: " .
                  $booked['DATE_FORMAT(whenDeparts ,\'%b %d %Y\')']." Travel Time: ".$booked['flightLength']."Minutes - Details ". $booked['flightDetails']."</option>";
    echo "</select>";
    //strtotime(+$booked['flightLength'],$booked['DATE_FORMAT(whenDeparts ,\'%b %d %Y\')'] )
}

?>
