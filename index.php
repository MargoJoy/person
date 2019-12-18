<?php
include __DIR__ . '/PDOAdapter.php';
include __DIR__ . '/MyLogger.php';
include  __DIR__ . '/Controller/Persons.php';
include __DIR__ . '/View/View.php';

$template = __DIR__ . '/Templates/persons.php';

$Persons = new \Controller\Persons();
$view = new \View\View();

$persons = $Persons->getPersonsMaxAge();
$age = $Persons->getMaxAge();

$update = $Persons->update();

$view->assign('persons', $persons);
$view->assign('maxAge', $age);

$view->display($template);

