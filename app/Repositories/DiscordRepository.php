<?php


namespace Awoo\Models;


use Nette\Application\Responses\TextResponse;
use stdClass;

class DiscordRepository
{

    private $token;

    public function __construct()
    {
        // view excluded.md
    }

    /**
     * @param $id
     * @return stdClass
     */
    public function getUserById($id): ?stdClass
    {
        $options = [
            "http"=>[
                "method"=>"GET",
                "header"=>"Authorization: Bot $this->token"
            ]
        ];
        $context = stream_context_create($options);
        $json = file_get_contents("https://discordapp.com/api/v6/users/$id", false, $context);
        /*$decode = json_decode($json);
        $this->redirectUrl("https://cdn.discordapp.com/avatars/" . $decode->id . "/" . $decode->avatar);
        $this->sendResponse(new TextResponse($json));*/
        return json_decode($json);
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getUserNameById($uid): ?string
    {
        return $this->getUserById($uid)->username;
    }

    /**
     * @param $uid
     * @return string|null
     */
    public function getAvatarIdByUserId($uid): ?string
    {
        $user = $this->getUserById($uid);
        return $user->avatar;
    }

    /**
     * @param $uid
     * @return string|null
     */
    public function getAvatarUrlByUserId($uid): ?string
    {
        $avatar = $this->getAvatarIdByUserId($uid);
        return "https://cdn.discordapp.com/avatars/$uid/$avatar";
    }
}