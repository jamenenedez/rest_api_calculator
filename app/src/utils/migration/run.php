<?php
require_once(__DIR__."/MigratorHelper.php");
$migrator = new MigratorHelper();
$migrator->migrate(array(
    "CreateUser",
    "CreateService",
    "CreateRecord",
    "AddAdmin",
    "AddUser",
));
