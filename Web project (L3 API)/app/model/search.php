<?php
function search_articles(string $keyword, string $author = '', int $limit = 10): array
{
    // On prépare les paramètres pour le LIKE
    $params = [
        ':keyword'  => '%' . $keyword . '%',
        ':keyword2' => '%' . $keyword . '%'
    ];

    // Construction de la requête avec les bonnes jointures
    // On utilise INNER JOIN pour être sûr de lier l'article à son reporter
    if (!empty($author)) {
        $query = "SELECT a.*, r.name_rep 
                  FROM t_article a
                  INNER JOIN t_reporter r ON a.reporter_art = r.id_rep
                  WHERE (a.title_art LIKE :keyword OR a.hook_art LIKE :keyword2)
                  AND r.name_rep LIKE :author
                  ORDER BY a.date_art DESC 
                  LIMIT $limit";
        $params[':author'] = '%' . $author . '%';
    } else {
        $query = "SELECT a.*, r.name_rep 
                  FROM t_article a
                  INNER JOIN t_reporter r ON a.reporter_art = r.id_rep
                  WHERE (a.title_art LIKE :keyword OR a.hook_art LIKE :keyword2)
                  ORDER BY a.date_art DESC 
                  LIMIT $limit";
    }

    // Appelle TA fonction de database.php
    // Elle va elle-même appeler db_get_pdo() donc tout est automatique !
    return db_select_prepare($query, $params);
}