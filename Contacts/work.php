<?php

require_once 'classes/JobTable.php';
require_once 'classes/ContactTable.php';

define('STEP', 5);
define('UPLOAD_ROOT', '/home/mikayel/Desktop/ACA/Contacts/uploads/');

$jobTable = new JobTable();
$contactTable = new ContactTable();

$jobs = $jobTable->getJobs();

foreach ($jobs as $job) {
    $fileName = UPLOAD_ROOT . $job['file_name'];
    $file = new SplFileObject( $fileName );

    $file->seek($job['current']);

    $limit = STEP;

    if ($job['current'] + STEP > $job['total']) {
        $limit = $job['total'] - $job['current'] - 1;
        $jobTable->changeJobStatus($job['id'], 1);
    }

    for ($line=0;$line<$limit;$line++) {
        $row = $file->getCurrentLine();

        $contactArray = explode(' ', $row);
        $firstName = $contactArray[0];
        $lastName = $contactArray[1];
        $phone = $contactArray[2];

        $newContact = new NewContact();
        $newContact->setJobId($job['id']);
        $newContact->setFirstName($firstName);
        $newContact->setLastName($lastName);
        $newContact->setPhone($phone);

        $contactTable->createContact($newContact);
    }

    $currentLineNumber = $file->key();

    $jobTable->changeJobCurrent($job['id'], $currentLineNumber);
}

