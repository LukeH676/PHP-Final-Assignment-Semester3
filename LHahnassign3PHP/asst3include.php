
 

<?php
/* 
Written by: Lucas Hahn 
Assignment #3
*/
function WriteHeaders($Heading="Welcome",$TitleBar="MySite")
{
  echo "
    <!doctype html> 
    <html>
	<head>
	<title>$TitleBar</title>\n
	<link rel=\"stylesheet\" href=\"Asst2Style.css\"/>
	</head>
	<body>\n
	<div class=\"top\">
	$Heading - Student Full Name
	</div>
	";
}

function WriteFooters()
{
  echo "<div class=\"bottom\">";
  DisplayContactInfo(); 
  echo "</div></body>\n";
  echo "</html>\n";
}
function DisplayLabel($prompt)
{  
  echo "<label>" . $prompt . "  " . "</label>";
}
function DisplayTextbox($Name, $Size, $Value)
{ 
 
  echo "<Input type = text name = \"$Name\" Size = $Size value = \"$Value\">";   
}

function DisplayImage($Src, $Alt, $Height="", $Width="")
{
	 echo "<img src=$Src alt=$Alt height = $Height width = $Width>";
 
}

function DisplayButton($Name, $Text, $Filename="", $Alt="")
{
	 
	if ($Filename == "") 
	  echo "<button type = \"submit\" name = \"$Name\">$Text</button>";
	else
	{
	  echo "<button type = \"submit\" name = \"$Name\">"; 
	  DisplayImage($Filename,$Alt,65,75);
	  echo "</button>";
	}
}

function DisplayContactInfo()
{
  echo "<footer> Please feel free to contact me with any questions you have regarding any of the bands!: <a href = \"mailto:lhahn16@sl.on.ca\">lhahn16@student.sl.on.ca</a></footer>";  
 }

?>

