<?php
function press_get_articles(int $limit = 10): array
{
    $query = "SELECT * FROM t_article 
              ORDER BY date_art DESC 
              LIMIT $limit";
    return db_select($query);
}

function press_get_article_by_id(int $id): array
{
    $query  = "SELECT * FROM t_article WHERE id_art = :id";
    $params = [':id' => $id];
    $result = db_select_prepare($query, $params);
    return $result[0] ?? [];
}

function press_get_articles_by_date(string $date, int $limit = 10): array
{
    $query  = "SELECT * FROM t_article 
               WHERE DATE(date_art) = :date
               ORDER BY date_art DESC 
               LIMIT $limit";
    $params = [':date' => $date];
    return db_select_prepare($query, $params);
}

function press_get_categories(): array
{
    $query = "SELECT * FROM t_category ORDER BY name_cat ASC";
    return db_select($query);
}

function press_get_articles_by_category(int $id_cat): array
{
    $query  = "SELECT * FROM t_article 
               WHERE fk_category_art = :id_cat
               ORDER BY date_art DESC";
    $params = [':id_cat' => $id_cat];
    return db_select_prepare($query, $params);
}
