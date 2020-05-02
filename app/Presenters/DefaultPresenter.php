<?php declare(strict_types=1);

namespace App\Presenters;
use App\Repositories\CouncilRepository;
use App\Repositories\NewsRepository;
use App\Repositories\UserRepository;
use Awoo\Actions\Actions;
use Nette;

class DefaultPresenter extends BasePresenter
{

    /** @var Actions @inject */
    public $actions;

    public function __construct()
    {
        parent::__construct();
    }

    public function actionDefault(): void
    {
        $welcome = array(
            "message"=>"This is the Awooing.moe API",
            "endpoints"=>
                [
                "user"=>"/api/v1/user/",
                "news"=>"/api/v1/news/",
                "council"=>"/api/v1/council",
                "random_awoo"=>"/api/v1/randawoo",
                ]
        );
        $this->sendPrettyJson($welcome);
    }

    public function actionUser($id=null): void
    {
        if ($this->request->isMethod('POST')) {
            // post login
            $this->actions->getUserActions()->actionUserPost($this->getHttpRequest(), $this);
        } elseif ($this->request->isMethod('GET')) {
            // get info
            $this->actions->getUserActions()->actionUserGet($this->getHttpRequest(), $this);
        } elseif ($this->request->isMethod('PUT')) {
            // put register
            $this->actions->getUserActions()->actionUserPut($this->getHttpRequest(), $this);
        } else {
            $this->error("method not supported", 400);
        }
    }

    public function actionCouncil($id=null): void
    {
        if ($this->request->isMethod('GET')) {
            $this->actions->getCouncilActions()->actionCouncilGet($this->getHttpRequest(), $this);
        } else {
            $this->error("method not supported", 400);
        }
    }

    public function actionNews($page=1, string $strip="false", string $truncate="0", string $pageInfo="false"): void
    {
        if ($this->request->isMethod('GET')) {
            $this->actions->getNewsActions()->actionNewsGet($this->getHttpRequest(), $this, $page, ($strip === "true"), (int)$truncate, ($pageInfo === "true"));
        } else {
            $this->error("method not supported", 400);
        }
    }

    public function actionArticle($id=null): void
    {
        if ($this->request->isMethod('GET')) {
            $this->actions->getNewsActions()->actionArticleGet($this->getHttpRequest(), $this, $id);
        } else {
            $this->error("method not supported", 400);
        }
    }

    public function actionAwoo(): void
    {
        $awoo = $this->actions->getCdnRepo()->getRandomAwoo();
        if ($awoo === null || !$awoo) {
            $this->sendPrettyJson(["error"=>'var_awoo_null']);
        } else {
            $this->sendPrettyJson([
                "path"=>$this->actions->getCdnRepo()->getFileKey($awoo),
                "fileSize"=>$this->actions->getCdnRepo()->getSize($awoo),
                "createdAt"=>$this->actions->getCdnRepo()->getLastModified($awoo)
            ]);
        }
    }


}
