<?php
function favorites_get(array $session_favoris): array
{
    return $session_favoris;
}

function favorites_add(array &$session_favoris, int $id): void
{
    $session_favoris[$id] = $id;
}

function favorites_remove(array &$session_favoris, int $id): void
{
    unset($session_favoris[$id]);
}

function favorites_clear(array &$session_favoris): void
{
    $session_favoris = [];
}
