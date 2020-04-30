<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Response\JsonResponse;
use Nette;


class Error4xxPresenter extends Nette\Application\UI\Presenter
{
    public function startup(): void
    {
        parent::startup();
        if (!$this->getRequest()->isMethod(Nette\Application\Request::FORWARD)) {
            $this->error();
        }
    }

    public function renderDefault(Nette\Application\BadRequestException $exception): void
    {
        $this->sendJson(["httpCode"=>$exception->getCode(), "message"=>$exception->getMessage()], Nette\Utils\Json::PRETTY);
    }

    public function sendJson($data, $jsonFlag=null): void
    {
        $this->sendResponse(new JsonResponse($data, $jsonFlag));
    }
}
