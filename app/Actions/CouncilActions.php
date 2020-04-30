<?php


namespace Awoo\Actions;


use App\Presenters\BasePresenter;
use App\Repositories\CouncilRepository;
use Awoo\Misc\Helper;
use Awoo\Models\DiscordRepository;
use Nette\Http\IRequest;

class CouncilActions
{

    /** @var CouncilRepository */
    public $councilRepo;

    /** @var DiscordRepository */
    private $discordRepo;

    /** @var Helper */
    private $helper;

    public function __construct(CouncilRepository $cou, DiscordRepository $dis)
    {
        $this->councilRepo = $cou;
        $this->discordRepo = $dis;
        $this->helper = new Helper();
    }


    public function actionCouncilGet(IRequest $req, BasePresenter $p)
    {
        // Getting the ID in URL (mod_rewrite rewrites it - so it's /api/v1/user/<id> instead of ?id=<id>)
        $id = $p->getParameter("id");

        // Checking if ID is null
        if ($id === null) {
            // Getting all council members
            $members = $this->councilRepo->getCouncilMembers();
            $result = array();
            foreach ($members as $member) {
                $m = $member->toArray();
                $m['discord_avatar'] = $this->discordRepo->getAvatarUrlByUserId($member->discord_id);
                $m['about'] = $this->helper->awooIt($m['about']);
                array_push($result, $m);
            }
            // Sends Result
            $p->sendPrettyJson($result);
        } else {

            // Getting the Awoo\Entities\CouncilMember instance
            $member = $this->councilRepo->getCouncilMemberById((int)$id);

            // If the ActiveRow of CouncilMember is invalid (= member doesn't exist in db) an 404 error is thrown
            if (!$member->getRow()) {
                $p->error("id is invalid", 404);
            }

            // Sends Result
            $p->sendPrettyJson($member->getRow()->toArray());
        }
    }

}