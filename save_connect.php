<?php
$name = $_GET['name'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$social = $_GET['social'];

// echo $name. "<br>";
// echo $email. "<br>";
// echo $phone. "<br>";
// echo $social. "<br>";


    // Set vCard properties
    $vc_name = $name;

    // Create vCard file
    $filename = $name . '.vcf';
    $vcard = "BEGIN:VCARD\n";
    $vcard .= "VERSION:2.1\n";
    $vcard .= "N:$name\n";
    $vcard .= "FN:$name\n";
    $vcard .= "EMAIL:$email\n";
    $vcard .= "TEL;TYPE=HOME,VOICE:$phone\n";
    // $vcard .= "TEL;TYPE=WORK,VOICE:$telephone\n";
    // $vcard .= "ORG:" . $company . "\r\n";
    // $vcard .= "TITLE:" . $designation . "\r\n";
    // $vcard .= "ADR;TYPE=WORK:;;" . $address . "\r\n";
    // $vcard .= "NOTE:" . $biography . "\r\n";
    $vcard .= "URL;TYPE=" . "Social" . ":" . $social . "\r\n";
    // $vcard .= "URL;TYPE=" . "Website" . ":" . $website . "\r\n";
    $vcard .= "END:VCARD";

    // Set HTTP headers for vCard download
    header('Content-type: text/x-vcard');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Output vCard file contents
    echo $vcard;

