<?php declare(strict_types=1);
namespace Awoo\Actions;


use App\Repositories\NewsRepository;
use Awoo\Models\CdnRepository;

class Actions
{

    /** @var UserActions */
    private $userActions;

    /** @var CouncilActions */
    private $councilActions;

    /** @var NewsActions */
    private $newsActions;

    // no need for actions at the moment
    /** @var CdnRepository */
    private $cdnRepo;

    public function __construct(CouncilActions $councilActions, NewsActions $newsActions, UserActions $userActions, CdnRepository $cdnRepo)
    {
        $this->userActions = $userActions;
        $this->councilActions = $councilActions;
        $this->newsActions = $newsActions;
        $this->cdnRepo = $cdnRepo;
    }

    /**
     * @return CouncilActions
     */
    public function getCouncilActions(): CouncilActions
    {
        return $this->councilActions;
    }

    /**
     * @return NewsActions
     */
    public function getNewsActions(): NewsActions
    {
        return $this->newsActions;
    }

    /**
     * @return UserActions
     */
    public function getUserActions(): UserActions
    {
        return $this->userActions;
    }

    /**
     * @return CdnRepository
     */
    public function getCdnRepo(): CdnRepository
    {
        return $this->cdnRepo;
    }



}