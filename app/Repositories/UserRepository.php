<?php
namespace App\Repositories;

use Awoo\Entities\User;
use Nette\Database\Context;
use Nette\Database\Table\Selection;
use Nette\Http\Session;
use Nette\Mail\SmtpMailer;
use Nette\Security\Passwords;

class UserRepository
{
    /** @var Context */
    private $database;

    /** @var SmtpMailer */
    private $mailer;

    /** @var Passwords */
    private $passwords;

    /**
     * UserRepository constructor.
     * @param Context $db
     * @param Passwords $pw
     */
    public function __construct(Context $db, Passwords $pw)
    {
        $this->database = $db;
        $this->mailer = new SmtpMailer([
            'smtp' => true,
            'host' => "mail.awooing.moe",
            'username' => "noreply@awooing.moe",
            'password' => 'wy&W60$bYVQQsr4ld',
            'secute' => "ssl",
        ]);
        $this->passwords = $pw;
    }

    /**
     * Gets users in DB or returns null if table doesn't exist.
     * @return Selection
     */
    public function getUsers(): ?Selection
    {
        return $this->database->table("awoo_users");
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        return new User($this->database->table("awoo_users")->get($id));
    }

    /**
     * @param $username
     * @return User
     */
    public function getUserByUsername($username): User
    {
        return new User($this->database->table("awoo_users")->where("username = ?", $username)->fetch());
    }

    /**
     * @param $email
     * @return User
     */
    public function getUserByEmail($email): User
    {
        return new User($this->database->table("awoo_users")->where("email = ?", $email)->fetch());
    }

    /**
     * @param $discordId
     * @return User
     */
    public function getUserByDiscordId($discordId): User
    {
        return new User($this->database->table("awoo_users")->where("discord_id = ?", $discordId)->fetch());
    }

    /**
     * This method checks if the login IP
     * matches with the current IP address.
     * This is a precaution against Session Hijacking
     * @param Session $session
     * @param \Nette\Security\User $user
     * @return bool|null
     */
    public function checkSession(Session $session, \Nette\Security\User $user): ?bool
    {
        if ($user->isLoggedIn()) {
            if ($user->getIdentity()->loginIP === $_SERVER['REMOTE_ADDR']) {
                return true;
            } else {
                $user->logout(true);
                $session->destroy();
                return false;
            }
        } else {
            return null;
        }
    }

    /**
     * @param $username
     * @param $email
     * @param $password
     */
    public function register($username, $email, $password): void {
        $user = $this->database->table("awoo_users")->insert([
            "username"=>$username,
            "email"=>$email,
            "password"=>$this->passwords->hash($password),
            "showAs"=>$username,
            "active"=>"1",
            "email_verified"=>"0",
            "banned"=>"0",
            "role"=>"member",
            "discord_id"=>"unset",
            "location"=>"unset"
        ]);
        // TODO: Send Verify Email
    }

}