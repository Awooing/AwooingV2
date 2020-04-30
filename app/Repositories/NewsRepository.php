<?php


namespace App\Repositories;


use Awoo\Entities\Article;
use Nette\Database\Context;
use Nette\Database\Table\Selection;

class NewsRepository
{
    private $database;

    public function __construct(Context $db)
    {
        $this->database = $db;
    }

    public function getArticles(): ?Selection
    {
        return $this->database->table("awoo_posts");
    }

    public function getArticleById($id): Article
    {
        return new Article($this->database->table("awoo_posts")->get($id));
    }


}