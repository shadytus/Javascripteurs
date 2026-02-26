<?php
function db_get_pdo()
{
    static $pdo;
    if (empty($pdo))
    {
        $pdo = new PDO(DATABASE_DSN, DATABASE_USERNAME, DATABASE_PASSWORD);
    }
    return $pdo;
}

function db_select(string $query_s): array
{
    $pdo    = db_get_pdo();
    $stmt   = $pdo->query($query_s);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function db_select_prepare(string $query_s, array $param_a): array
{
    $pdo  = db_get_pdo();
    $stmt = $pdo->prepare($query_s);
    $stmt->execute($param_a);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
