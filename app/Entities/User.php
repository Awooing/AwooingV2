<?php declare(strict_types=1);

namespace Awoo\Entities;

use Nette\Database\Table\ActiveRow;
use Nette\Utils\DateTime;

class User
{
    /** @var ActiveRow */
    private $user;

    public function __construct(?ActiveRow $userRow)
    {
        $this->user = $userRow;
    }

    /**
     * @return ActiveRow
     */
    public function getRow(): ?ActiveRow
    {
        return $this->user;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->user->id;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->user->username;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->user->email;
    }

    /**
     * @return string|null
     */
    public function getPasswordHash(): ?string
    {
        return $this->user->password;
    }

    /**
     * @return string|null
     */
    public function getShowName(): ?string
    {
        return $this->user->showAs;
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return (bool)$this->user->active;
    }

    /**
     * @return bool|null
     */
    public function isBanned(): ?bool
    {
        return (bool)$this->user->banned;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->user->role;
    }

    /**
     * @return string|null
     */
    public function getDiscordId(): ?string
    {
        return $this->user->discord_id;
    }

    /**
     * @return string|null
     */
    public function getJoinDate(): ?string
    {
        /** @var DateTime $date */
        $date = $this->user->join_date;

        return $date->format("d/m/Y");
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->user->location;
    }

    public function formArray(\Nette\Security\User $user): array
    {
        if ($user->isLoggedIn() && $user->getId() === $this->getId()) {
            $values = [
                "id"=>$this->getId(),
                "username"=>$this->getUsername(),
                "email"=>$this->getEmail(),
                "showAs"=>$this->getShowName(),
                "active"=>$this->isActive(),
                "banned"=>$this->isBanned(),
                "role"=>$this->getRole(),
                "discord_id"=>$this->getDiscordId(),
                "location"=>$this->getLocation(),
                "join_date"=>$this->getJoinDate()
            ];
        } else {
            $values = [
                "id"=>$this->getId(),
                "username"=>$this->getUsername(),
                "showAs"=>$this->getShowName(),
                "role"=>$this->getRole(),
                "discord_id"=>$this->getDiscordId(),
                "location"=>$this->getLocation(),
                "join_date"=>$this->getJoinDate()
            ];
        }
        return $values;
    }

}