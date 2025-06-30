<?php
include "../res/imemail.inc.php";

//Form Data
$txtData = "";
$htmData = "";
$txtData .= "Your Name: " . $_POST["Itm_8_00_1"] . "\r\n";
$htmData .= "<tr><td width=\"25%\"><b>Your Name:</b></td><td>" . $_POST["Itm_8_00_1"] . "</td></tr>";
$txtData .= "Your Email ID: " . $_POST["Itm_8_00_2"] . "\r\n";
$htmData .= "<tr><td width=\"25%\" bgcolor=\"#EEEEEE\"><b>Your Email ID:</b></td><td bgcolor=\"#EEEEEE\">" . $_POST["Itm_8_00_2"] . "</td></tr>";
$txtData .= "Tell Us: " . $_POST["Itm_8_00_3"] . "\r\n";
$htmData .= "<tr><td width=\"25%\"><b>Tell Us:</b></td><td>" . $_POST["Itm_8_00_3"] . "</td></tr>";
$txtData .= "Primary Phone Number: " . $_POST["Itm_8_00_4"] . "\r\n";
$htmData .= "<tr><td width=\"25%\" bgcolor=\"#EEEEEE\"><b>Primary Phone Number:</b></td><td bgcolor=\"#EEEEEE\">" . $_POST["Itm_8_00_4"] . "</td></tr>";
$txtData .= "Secondary Phone Number: " . $_POST["Itm_8_00_5"] . "\r\n";
$htmData .= "<tr><td width=\"25%\"><b>Secondary Phone Number:</b></td><td>" . $_POST["Itm_8_00_5"] . "</td></tr>";
$txtData .= "Your Address: " . $_POST["Itm_8_00_6"] . "\r\n";
$htmData .= "<tr><td width=\"25%\" bgcolor=\"#EEEEEE\"><b>Your Address:</b></td><td bgcolor=\"#EEEEEE\">" . $_POST["Itm_8_00_6"] . "</td></tr>";
$txtData .= "Attachment: " . $_FILES["Itm_8_00_7"]["name"] . "\r\n";
$htmData .= "<tr><td width=\"25%\"><b>Attachment:</b></td><td>" . $_FILES["Itm_8_00_7"]["name"] . "</td></tr>";

// Template
$htmHead = "<table width=\"90%\" border=\"0\" bgcolor=\"#FFFFFF\" cellpadding=\"4\" style=\"font: 11px Tahoma; color: #000000; border: 1px solid #BBBBBB;\">";
$htmFoot = "</table>";

//Send email to owner
$txtMsg = "";
$htmMsg = $htmHead . "<tr><td></td></tr>" . $htmFoot;
$oEmail = new imEMail(($imForceSender ? $_POST["Itm_8_00_2"] : "craft@makeitlifelike.com"),"craft@makeitlifelike.com","Make It Life Like Notification","iso-8859-1");
$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
$oEmail->setHTML("<html><body bgcolor=\"#063A69\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData . $htmFoot . "</center></body></html>");
if ($_FILES["Itm_8_00_7"]["name"] != "") $oEmail->attachFile($_FILES["Itm_8_00_7"]["name"],file_get_contents($_FILES["Itm_8_00_7"]["tmp_name"]),$_FILES["Itm_8_00_7"]["type"]);
$oEmail->send();

//Send email to user
$txtMsg = "Thanks for reaching out! We're excited to connect with you and will get back to you shortly. Thank you for choosing us.";
$htmMsg = $htmHead . "<tr><td>Thanks for reaching out! We're excited to connect with you and will get back to you shortly. Thank you for choosing us.</td></tr>" . $htmFoot;
$oEmail = new imEMail("craft@makeitlifelike.com",$_POST["Itm_8_00_2"],"Thank you for contacting us.","iso-8859-1");
$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
$oEmail->setHTML("<html><body bgcolor=\"#063A69\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData . $htmFoot . "</center></body></html>");
$oEmail->send();
@header("Location: ../thank_you.html");
?>
