<?php

// Todo: Registrer person
$person_id = $_POST['person_id'];
$personMobil = $_POST['personMobil'];
$personGruppe = $_POST['gruppeid'];
$rfidValue = $_POST['rfidValue'];

RFID::addResponseData('success', true );
RFID::addResponseData('gruppeid', $personGruppe);
RFID::addResponseData('person_id', $person_id);
RFID::addResponseData('rfid', $rfidValue);
RFID::addResponseData('message', array($person_id, $personMobil, $personGruppe, $rfidValue));