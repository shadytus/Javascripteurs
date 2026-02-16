<?php
function db_get_pdo()
{
    static $pdo;
    if( empty($pdo) )
    {
        $pdo = new PDO( DATABASE_DSN, DATABASE_USERNAME, DATABASE_PASSWORD );
    }
    return $pdo;
}

function db_select($query_s): array
{
    $pdo = db_get_pdo();
    $stmt = $pdo->query($query_s);
    $content_a = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $content_a;
}

function db_select_prepare($query_s, $param_a): array
{
    $pdo = db_get_pdo();
    $stmt = $pdo->prepare($query_s);
    $stmt->execute($param_a);
    $content_a = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $content_a;
}
```
