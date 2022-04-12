<?php
require_once __DIR__ . '/../Lib/pdoInit.php';

function articleList()
{
    $pdo = pdoInit();

    $sql = 'SELECT * FROM blogs';
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $blogs = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $blogs;
}

function orderSearch()
{
    $pdo = pdoInit();
    $sql = 'SELECT * FROM blogs';
    if (!empty($_GET['searchWord'])) {
        $escapedKeyword = '';
        $searchWord = filter_input(
            INPUT_GET,
            'searchWord',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
        $sql .= ' where title like :keyword';
        $pattern = '/%/';
        if (preg_match($pattern, $searchWord)) {
            $escapedKeyword = str_replace('%', '\%', $search);
            $searchKeyword = '%' . $escapedKeyword . '%';
        } else {
            $searchKeyword = '%' . $searchWord . '%';
        }
    }

    $sortMode = '';
    if (!empty($_GET['order'])) {
        $sortMode = filter_input(
            INPUT_GET,
            'order',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    if ($sortMode == 'asc' || $sortMode == 'desc') {
        $sql = $sql . " order by created_at $sortMode";
    }

    $statement = $pdo->prepare($sql);
    if (!empty($_GET['searchWord'])) {
        $statement->bindValue(':keyword', $searchKeyword, PDO::PARAM_STR);
    }
    $statement->execute();
    $blogs = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $blogs;
}
