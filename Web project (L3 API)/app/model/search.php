<?php
function search_articles(string $keyword, string $author = '', int $limit = 10): array
{
    $params = [];

    if (!empty($author)) {
        $query = "SELECT * FROM t_article a, t_reporter r
                  WHERE (title_art LIKE :keyword 
                  OR hook_art LIKE :keyword2)
                  AND name_rep = :author
                  AND a.reporter_art = r.id_rep
                  ORDER BY date_art DESC 
                  LIMIT $limit";
        $params = [
            ':keyword'  => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%',
            ':author'   => $author
        ];
    } else {
        $query = "SELECT * FROM t_article a, t_reporter r 
                  WHERE title_art LIKE :keyword 
                  OR hook_art LIKE :keyword2
                  AND a.reporter_art = r.id_rep
                  ORDER BY date_art DESC 
                  LIMIT $limit";
        $params = [
            ':keyword'  => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%',
        ];
    }

    return db_select_prepare($query, $params);
}
