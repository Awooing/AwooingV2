<?php


namespace App\Repositories;


use Awoo\Entities\CouncilMember;
use Nette\Database\Context;
use Nette\Database\Table\Selection;

class CouncilRepository
{
    /** @var Context */
    private $database;

    public function __construct(Context $db)
    {
        $this->database = $db;
    }

    public function getCouncilMembers(): ?Selection
    {
        return $this->database->table("awoo_council");
    }

    public function getCouncilMemberById(int $id): CouncilMember
    {
        return new CouncilMember($this->database->table("awoo_council")->get($id));
    }

}