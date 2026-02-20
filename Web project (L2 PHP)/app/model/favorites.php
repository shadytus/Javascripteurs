<?php
function favorites_get(): array
{
    return $_SESSION['favoris'] ?? [];
}

function favorites_add(int $id): void
{
    $_SESSION['favoris'][$id] = $id;
}

function favorites_remove(int $id): void
{
    unset($_SESSION['favoris'][$id]);
}

function favorites_clear(): void
{
    $_SESSION['favoris'] = [];
}
