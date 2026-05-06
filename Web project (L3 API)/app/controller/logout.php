<?php
function main_logout(): string
{
    unset($_SESSION['user']);
    header('Location: index.php?page=home');
    exit;
}
