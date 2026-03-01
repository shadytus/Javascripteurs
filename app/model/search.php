<?php
function search_articles(string $keyword, string $author = '', int $limit = 10): array
{
    $params = [];

    if (!empty($author)) {
        $query = "SELECT * FROM t_article 
                  WHERE (title_art LIKE :keyword 
                  OR hook_art LIKE :keyword2)
                  AND author_art = :author
                  ORDER BY date_art DESC 
                  LIMIT $limit";
        $params = [
            ':keyword'  => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%',
            ':author'   => $author
        ];
    } else {
        $query = "SELECT * FROM t_article 
                  WHERE title_art LIKE :keyword 
                  OR hook_art LIKE :keyword2
                  ORDER BY date_art DESC 
                  LIMIT $limit";
        $params = [
            ':keyword'  => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%',
        ];
    }

    return db_select_prepare($query, $params);
}
