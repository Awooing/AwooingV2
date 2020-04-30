<?php declare(strict_types=1);

/**
 * Modified version of JSONResponse supporting JSON flags
 */

namespace App\Response;
use Nette;

class JsonResponse implements Nette\Application\IResponse
{
    use Nette\SmartObject;

    /** @var mixed */
    private $payload;

    /** @var string */
    private $contentType;

    /** @var int */
    private $jsonFlag;


    public function __construct($payload, int $jsonFlag = null, string $contentType = null)
    {
        $this->payload = $payload;
        $this->contentType = $contentType ?: 'application/json';
        $this->jsonFlag = $jsonFlag ?: null;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Returns the MIME content type of a downloaded file.
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @return int
     */
    public function getJsonFlag(): int
    {
        return $this->jsonFlag;
    }

    /**
     * Sends response to output.
     * @param Nette\Http\IRequest $httpRequest
     * @param Nette\Http\IResponse $httpResponse
     * @throws Nette\Utils\JsonException
     */
    public function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse): void
    {
        $httpResponse->setContentType($this->contentType, 'utf-8');
        echo Nette\Utils\Json::encode($this->payload, $this->jsonFlag);
    }
}
