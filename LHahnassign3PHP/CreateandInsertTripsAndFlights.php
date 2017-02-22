<?php

echo "
	<!doctype html>  
    <html lang = \"en\">
	<head>
		<meta charset = \"UTF-8\">
		<title>Create & Insert Flights</title>
		</head>
	<body>
	<h1>Create Flights Table and Insert Records</h1>
	";
$mysqlObj;
$tripsAdded = 0;
$flightsAdded = 0;
$Host = "localhost";
$UserName = "root";
$Password = "mysql";
$Database = "test";
$mysqlObj = new mysqli($Host, $UserName, $Password, $Database);


// dropping table
if (($stmt = $mysqlObj->prepare("Drop table If Exists Trips")))
    $stmt->execute();
// creating table
$tripNbr = "tripNbr int primary key";
$departureCity = "departureCity varchar(25)";
$arrivalCity = "arrivalCity varchar(25)";
$stmt = $mysqlObj->prepare("Create Table Trips ($tripNbr, $departureCity, $arrivalCity)");
if ($stmt->execute())
    echo "Trips table created.";
else
    echo "Can't create table Trips. Execute failed: (" . $stmt->errno . ") " . $stmt->error;


// dropping table
if (($stmt = $mysqlObj->prepare("Drop table If Exists Flights")))
    $stmt->execute();
// creating table
$flightNbr = "flightNbr int primary key";
$tripNbr = "tripNbr int";
$whenDeparts = "whenDeparts datetime";
$flightLength = "flightLength int";
$flightDetails = "flightDetails varchar(255)";
$stmt = $mysqlObj->prepare("Create Table Flights ($flightNbr, $tripNbr, $whenDeparts, $flightLength, $flightDetails)");
if ($stmt->execute())
    echo "Flights table created.";
else
    echo "Can't create table Flights. Execute failed: (" . $stmt->errno . ") " . $stmt->error;
// inserting records into Trips
$tripNbr = 1;
$departureCity = "Toronto";
$arrivalCity = "Vienna";
InsertIntoTripsTable($tripNbr, $departureCity, $arrivalCity);

$tripNbr = 2;
$departureCity = "Madrid";
$arrivalCity = "Casablanca";
InsertIntoTripsTable($tripNbr, $departureCity, $arrivalCity);

$tripNbr = 3;
$departureCity = "Oslo";
$arrivalCity = "Stockholm";
InsertIntoTripsTable($tripNbr, $departureCity, $arrivalCity);

// inserting records into Flights
$flightNbr = 5505;
$tripNbr = 1;
$whenDeparts = new datetime('2016-11-25 1:30PM');
$flightLength = 450;
$flightDetails = "Movies and TV shows available at every seat.";
InsertIntoFlightsTable($flightNbr, $tripNbr, $whenDeparts, $flightLength, $flightDetails);

$flightNbr = 7707;
$tripNbr = 1;
$whenDeparts = new datetime('2016-11-30 4:00AM');
$flightLength = 300;
$flightDetails = "Free wifi even at 35000 feet";
InsertIntoFlightsTable($flightNbr, $tripNbr, $whenDeparts, $flightLength, $flightDetails);

$flightNbr = 8808;
$tripNbr = 1;
$whenDeparts = new datetime('2017-10-10 6:00PM');
$flightLength = 1000;
$flightDetails = "We will fly over the Atlantic";
InsertIntoFlightsTable($flightNbr, $tripNbr, $whenDeparts, $flightLength, $flightDetails);

$flightNbr = 123;
$tripNbr = 2;
$whenDeparts = new datetime('2017-5-5 8:00PM');
$flightLength = 5;
$flightDetails = "We aperate";
InsertIntoFlightsTable($flightNbr, $tripNbr, $whenDeparts, $flightLength, $flightDetails);

$flightNbr = 456;
$tripNbr = 2;
$whenDeparts = new datetime('2017-04-25 2:22AM');
$flightLength = 10;
$flightDetails = "Time travel at its best";
InsertIntoFlightsTable($flightNbr, $tripNbr, $whenDeparts, $flightLength, $flightDetails);

$flightNbr = 789;
$tripNbr = 3;
$whenDeparts = new datetime('2017-01-05 4:00PM');
$flightLength = 360;
$flightDetails = "Comedian on board";
InsertIntoFlightsTable($flightNbr, $tripNbr, $whenDeparts, $flightLength, $flightDetails);

$flightNbr = 102;
$tripNbr = 3;
$whenDeparts = new datetime('2016-12-12 12:00PM');
$flightLength = 245;
$flightDetails = "You get to the fly the plane";
InsertIntoFlightsTable($flightNbr, $tripNbr, $whenDeparts, $flightLength, $flightDetails);

echo "$tripsAdded trips added and $flightsAdded flights added.";
$stmt->close();
mysqli_close($mysqlObj);
echo "</body>\n";
echo "</html>\n";

function InsertIntoTripsTable($tripNbr, $departureCity, $arrivalCity) {
    global $mysqlObj, $tripsAdded;
    $query = "Insert Into Trips (tripNbr, departureCity, arrivalCity) Values (?, ?, ?)";
    $stmt = $mysqlObj->prepare($query);
    $BindSuccess = $stmt->bind_param("iss", $tripNbr, $departureCity, $arrivalCity);

    $success = $stmt->execute();
    if ($success)
        $tripsAdded++;
}

function InsertIntoFlightsTable($flightNbr, $tripNbr, $whenDeparts, $flightLength, $flightDetails) {
    global $mysqlObj, $flightsAdded;
    $whenDepartsString = $whenDeparts->format('Y-m-d');
    $query = "Insert Into Flights (flightNbr, tripNbr, whenDeparts, flightLength, flightDetails) Values (?, ?, ?, ?, ?)";
    $stmt = $mysqlObj->prepare($query);
    $BindSuccess = $stmt->bind_param("iisis", $flightNbr, $tripNbr, $whenDepartsString, $flightLength, $flightDetails);
    $success = $stmt->execute();
    if ($success)
        $flightsAdded++;
}

?>
