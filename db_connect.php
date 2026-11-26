<?php

$mysqli = new mysqli(
    "localhost",
    "2415722",
    "@onlyore012345",
    "db2415722"
);

if ($mysqli->connect_errno) {
    exit("Database connection failed.");
}

$mysqli->set_charset("utf8mb4");