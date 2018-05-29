<?php

// Todo: Registrer person
$person_id = $_POST['ukm-person-id'];
$person_fornavn = $_POST['personFornavn'];
$person_etternavn = $_POST['personEtternavn'];
$personMobil = $_POST['personMobil'];
$personGruppe = $_POST['gruppeid'];
$rfidValue = $_POST['rfidValue'];

RFID::addResponseData('success', true );
RFID::addResponseData('gruppeid', $personGruppe);
RFID::addResponseData('ukm_person_id', $person_id);
RFID::addResponseData('rfid', $rfidValue);
RFID::addResponseData('message', array($person_id, $personMobil, $personGruppe, $rfidValue));