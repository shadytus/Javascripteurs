<?php
const MACHINE = "home"; // home
const DATABASE_TYPE = "MySql";
const DATABASE_NAME = "press_2025_v05";

define("DATABASE_PORT", 3306);      // MySQL maison
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "");


const DATABASE_DSN = "mysql:host=localhost;dbname=".DATABASE_NAME.";port=".DATABASE_PORT.";charset=utf8mb4;";
