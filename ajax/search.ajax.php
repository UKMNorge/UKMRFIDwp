<?php
namespace UKMNorge\RFID;
use Exception;

require_once( 'UKM/postgres.class.php');
POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

// Start søk etter person
$rowCount = PersonColl::countMatching($_POST['personFornavn'], $_POST['personEtternavn'], $_POST['personMobil']);

\UKMRFID::addResponseData('matchingPersons', $rowCount);
\UKMRFID::addResponseData('success', true );