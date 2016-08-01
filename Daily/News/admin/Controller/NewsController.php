<?php

require_once NEWS_ROOT . '/core/Model/NewsTable.php';

class NewsController
{
    public function listAction()
    {
        $newsTable = new NewsTable();
        $news = $newsTable->getNews();
        require_once NEWS_ROOT . '/admin/View/NewsList.php';
    }

    public function creatAction($data)
    {

    }

    public function updateAction($id, $data)
    {

    }

    public function deleteAction($id)
    {

    }
}