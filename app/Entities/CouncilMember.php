<?php


namespace Awoo\Entities;


use Nette\Database\Table\ActiveRow;

class CouncilMember
{
    /** @var ActiveRow|null */
    private $row;

    /**
     * CouncilMember constructor.
     * @param ActiveRow|null $member
     */
    public function __construct(?ActiveRow $member)
    {
        $this->row = $member;
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
    public function getName(): ?string
    {
        return $this->row->name;
    }

    /**
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->row->position;
    }

    /**
     * @return string|null
     */
    public function getAbout(): ?string
    {
        return $this->row->about;
    }

    /**
     * @return string|null
     */
    public function getDiscordId(): ?string
    {
        return $this->row->discord_id;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        if ($this->row->user_id !== 0) { return $this->row->user_id; }
        else { return null; }
    }
}