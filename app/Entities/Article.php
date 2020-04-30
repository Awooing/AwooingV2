<?php


namespace Awoo\Entities;


use Nette\Database\Table\ActiveRow;

class Article
{

    private $row;

    /**
     * Article constructor.
     * @param ActiveRow|null $article
     */
    public function __construct(?ActiveRow $article)
    {
        $this->row = $article;
    }

    /**
     * @return ActiveRow|null
     */
    public function getRow(): ?ActiveRow
    {
        return $this->row;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->row->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->row->title;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->row->content;
    }

    /**
     * @return int|null
     */
    public function getAuthorId(): ?int
    {
        return $this->row->user_id;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        $date = $this->row->created_at;
        return $date->format("d/m/Y");
    }


}