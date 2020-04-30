<?php declare(strict_types=1);
namespace Awoo\Actions;

use App\Presenters\BasePresenter;
use App\Repositories\UserRepository;
use Nette\Http\IRequest;
use Nette\Security\AuthenticationException;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

class UserActions
{

    /** @var UserRepository */
    public $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function actionUserGet(IRequest $req, BasePresenter $p): void
    {
        // Getting the ID in URL (mod_rewrite rewrites it - so it's /api/v1/user/<id> instead of ?id=<id>)
        $id = $p->getParameter("id");

        // Checking if ID param is null
        if ($id === null) {
            // If indeed ID is null, it checks if user is logged
            // in case we're trying to get info of the logged user
            if($p->getUser()->isLoggedIn()) {
                // If we're logged in, the ID is set to the ID of the logged user
                $id = $p->getUser()->getId();
            } else {
                // If we aren't logged in, the 404 error is thrown
                $p->error("id is required", 404);
            }
        }
        // Getting the Awoo\Entities\User instance
        $user = $this->userRepo->getUserById((int)$id);

        // If the ActiveRow of User is invalid (= user doesn't exist in db) an 404 error is thrown
        if (!$user->getRow()) {
            $p->error("id is invalid", 404);
        }

        // Forms an array (depending if the user is authorized to see personal info or not
        $result = $user->formArray($p->getUser());

        // Sends the Result
        $p->sendPrettyJson($result);
    }

    public function actionUserPost(IRequest $req, BasePresenter $p): void
    {
        try {
            $json = Json::decode($req->getRawBody());
        } catch (JsonException $e) {
            $p->error("invalid json", 400);
        }
        if (!$json || $json->username === null || $json->password === null) {
            $p->error("invalid request", 400);
        }
        try {
            $p->getUser()->login($json->username, $json->password);
            $p->sendPrettyJson(["error"=>"OK"]);
        } catch (AuthenticationException $e) {
            $p->error($e->getMessage(), 401);
        }
    }

    public function actionUserPut(IRequest $req, BasePresenter $p): void
    {
        // Decoding JSON, also check if it isn't malformed
        try {
            $json = Json::decode($req->getRawBody());
        } catch (JsonException $e) {
            $p->error("invalid json", 400);
        }

        // Checking if JSON contains all required values
        if (!$json || $json->username === null || $json->email === null || $json->repeatpw === null) {
            $p->error("invalid request", 400);
        }

        // Checking if Username isn't taken
        if ($this->userRepo->getUserByUsername($json->username)->getRow()) {
            $p->error("username_taken", 400);
        }

        // Checking if Email isn't used
        if ($this->userRepo->getUserByEmail($json->email)->getRow()) {
            $p->error("email_used", 400);
        }

        // Checking if Passwords are not mismatch
        // Note: on website it's checked on frontend side already
        if ($json->password !== $json->repeatpw) {
            $p->error("password_mismatch", 400);
        }

        // Registering the user using method register($username, $email, $password) in Awoo\Repositories\UserRepository
        $this->userRepo->register($json->username, $json->email, $json->password);

        // Sends JSON confirming a successful registration
        $p->sendPrettyJson(["error" => "OK", "message" => "register success"]);
    }


}