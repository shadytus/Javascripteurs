<?php
echo json_encode([
    'articles' => press_get_articles(),
    'favoris' => array_keys(favorites_get())
]);