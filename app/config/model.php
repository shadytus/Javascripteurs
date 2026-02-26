<?php
const MACHINE = "classe38"; // "classe38" ou "home"
const DATABASE_TYPE = "MySql";
const DATABASE_NAME = "press_2025_v05";

switch(MACHINE) {
    // ISFCE, classe 38
    case "classe38":
        define("DATABASE_PORT", 3307);      // MariaDB école
        define("DATABASE_USERNAME", "root");
        define("DATABASE_PASSWORD", "");
        break;
    case "home":
        define("DATABASE_PORT", 3306);      // MySQL maison
        define("DATABASE_USERNAME", "root");
        define("DATABASE_PASSWORD", "root");
        break;
}

const DATABASE_DSN = "mysql:host=localhost;dbname=".DATABASE_NAME.";port=".DATABASE_PORT.";charset=utf8mb4;";
