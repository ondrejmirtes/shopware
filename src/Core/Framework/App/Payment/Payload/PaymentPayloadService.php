<?php declare(strict_types=1);

namespace Shopware\Core\Framework\App\Payment\Payload;

use GuzzleHttp\Client;
use Shopware\Core\Checkout\Payment\PaymentException;
use Shopware\Core\Framework\App\AppEntity;
use Shopware\Core\Framework\App\AppException;
use Shopware\Core\Framework\App\AppPayloadServiceHelper;
use Shopware\Core\Framework\App\Hmac\Guzzle\AuthMiddleware;
use Shopware\Core\Framework\App\Payment\Payload\Struct\PaymentPayloadInterface;
use Shopware\Core\Framework\App\Payment\Payload\Struct\SourcedPayloadInterface;
use Shopware\Core\Framework\App\Payment\Response\AbstractResponse;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Log\Package;

/**
 * @internal only for use by the app-systems
 */
#[Package('core')]
class PaymentPayloadService
{
    public function __construct(
        private readonly AppPayloadServiceHelper $helper,
        private readonly Client $client,
        private readonly string $shopUrl
    ) {
    }

    /**
     * @template T of AbstractResponse
     *
     * @param class-string<T> $responseClass
     *
     * @return T
     */
    public function request(
        string $url,
        SourcedPayloadInterface $payload,
        AppEntity $app,
        string $responseClass,
        Context $context
    ): AbstractResponse {
        $optionRequest = $this->getRequestOptions($payload, $app, $context);

        $response = $this->client->post($url, $optionRequest);

        $content = $response->getBody()->getContents();

        return $responseClass::create(\json_decode($content, true, 512, \JSON_THROW_ON_ERROR));
    }

    /**
     * @return array<string, mixed>
     */
    private function getRequestOptions(SourcedPayloadInterface $payload, AppEntity $app, Context $context): array
    {
        $payload->setSource($this->helper->buildSource($app, $this->shopUrl));
        $encoded = $this->helper->encode($payload);
        $jsonPayload = json_encode($encoded, \JSON_THROW_ON_ERROR);

        if (!$jsonPayload) {
            if ($payload instanceof PaymentPayloadInterface) {
                throw PaymentException::asyncProcessInterrupted($payload->getOrderTransaction()->getId(), \sprintf('Empty payload, got: %s', var_export($jsonPayload, true)));
            }

            throw PaymentException::validatePreparedPaymentInterrupted(\sprintf('Empty payload, got: %s', var_export($jsonPayload, true)));
        }

        $secret = $app->getAppSecret();
        if ($secret === null) {
            throw AppException::registrationFailed($app->getName(), 'App secret is missing');
        }

        return [
            AuthMiddleware::APP_REQUEST_CONTEXT => $context,
            AuthMiddleware::APP_REQUEST_TYPE => [
                AuthMiddleware::APP_SECRET => $secret,
                AuthMiddleware::VALIDATED_RESPONSE => true,
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => $jsonPayload,
        ];
    }
}
