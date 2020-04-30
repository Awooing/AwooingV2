<?php declare(strict_types=1);

namespace App\Presenters;
use App\Response\JsonResponse;
use Nette\Application\UI\Presenter;
use Nette\Utils\Json;

class BasePresenter extends Presenter
{
    protected function startup()
    {
        parent::startup();
        $this->getHttpResponse()->addHeader("Access-Control-Allow-Origin", "*");
    }

    public function sendJson($data, $jsonFlag=null): void
    {
        $this->sendResponse(new JsonResponse($data, $jsonFlag));
    }

    public function sendPrettyJson($data): void
    {
        $this->sendJson($data, Json::PRETTY);
    }
}