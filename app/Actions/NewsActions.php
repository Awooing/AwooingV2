<?php


namespace Awoo\Actions;


use App\Presenters\BasePresenter;
use App\Repositories\CouncilRepository;
use App\Repositories\NewsRepository;
use App\Repositories\UserRepository;
use Awoo\Entities\User;
use Awoo\Misc\Helper;
use Awoo\Models\DiscordRepository;
use Nette\Http\IRequest;
use Nette\Security\Passwords;
use Nette\Utils\DateTime;

class NewsActions
{

    /** @var NewsRepository */
    public $newsRepo;

    /** @var UserRepository */
    private $userRepo;

    /** @var Helper */
    private $helper;

    public function __construct(NewsRepository $nws, UserRepository $usr)
    {
        $this->newsRepo = $nws;
        $this->helper = new Helper();
        $this->userRepo = $usr;
    }

    public function actionNewsGet(IRequest $req, BasePresenter $p, $page, $strip=false, $truncate=0, $pageInfo=false)
    {
        $news = $this->newsRepo->getArticles();
        $lastPage = 0;
        $articles = $news->page((int)$page, 3, $lastPage);
        $ar_articles = array();
        foreach ($articles as $article) {
            $a = $article->toArray();
            if ($strip) {
                $a['content'] = strip_tags($a['content']);
            }
            if ($truncate !== 0) {
                $a['content'] = substr($a['content'], 0, $truncate);
            }
            $author = $this->userRepo->getUserById($a['user_id']);
            if (!$author->getRow()) {
                $author_name = "Deleted User";
            } else {
                $author_name = $author->getShowName();
            }
            $author_info = [
                "username" => ($author->getRow() ? $author->getUsername() : "deleted"),
                "showName" => ($author->getRow() ? $author->getShowName() : "Deleted User")
            ];
            $a['author_info'] = $author_info;
            $a['content'] = $this->helper->awooIt($a['content']);
            /** @var DateTime $date */
            $date = $a['created_at'];
            $a['created_at'] = $date->format("d/m/Y");
            array_push($ar_articles, $a);
        }
        $result = ["news"=>$ar_articles];
        if ($pageInfo) {
          $result = [
              "news"=>$ar_articles,
              "pageInfo"=>[
                  "current"=>$page,
                  "last"=>$lastPage
              ]
          ];
        }
        $p->sendPrettyJson($result);
    }

    public function actionArticleGet(IRequest $req, BasePresenter $p, $id): void
    {
        if (!$id) { $p->error("no id specified", 404); }
        $article = $this->newsRepo->getArticleById($id);
        if (!$article->getRow()) { $p->error("article doesn't exist", 404); }
        $p->sendPrettyJson($article->getRow()->toArray());
    }

}