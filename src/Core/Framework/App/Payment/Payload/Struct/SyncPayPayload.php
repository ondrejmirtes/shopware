<?php declare(strict_types=1);

namespace Shopware\Core\Framework\App\Payment\Payload\Struct;

use Shopware\Core\Checkout\Order\Aggregate\OrderTransaction\OrderTransactionEntity;
use Shopware\Core\Checkout\Order\OrderEntity;
use Shopware\Core\Checkout\Payment\Cart\Recurring\RecurringDataStruct;
use Shopware\Core\Framework\Feature;
use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\Struct\CloneTrait;
use Shopware\Core\Framework\Struct\JsonSerializableTrait;

/**
 * @internal only for use by the app-system
 *
 * @deprecated tag:v6.7.0 - will be removed, only exists for RecurringPayPayload
 */
#[Package('core')]
class SyncPayPayload implements PaymentPayloadInterface
{
    use CloneTrait;
    use JsonSerializableTrait {
        jsonSerialize as private traitJsonSerialize;
        convertDateTimePropertiesToJsonStringRepresentation as private traitConvertDateTimePropertiesToJsonStringRepresentation;
    }
    use RemoveAppTrait;

    protected Source $source;

    protected OrderTransactionEntity $orderTransaction;

    /**
     * @param mixed[] $requestData
     */
    public function __construct(
        OrderTransactionEntity $orderTransaction,
        protected OrderEntity $order,
        protected array $requestData = [],
        protected ?RecurringDataStruct $recurring = null,
    ) {
        Feature::triggerDeprecationOrThrow(
            'v6.7.0.0',
            'SyncPayPayload will be removed, use PaymentPayload instead'
        );

        $this->orderTransaction = $this->removeApp($orderTransaction);
    }

    public function setSource(Source $source): void
    {
        Feature::triggerDeprecationOrThrow(
            'v6.7.0.0',
            'SyncPayPayload will be removed, use PaymentPayload instead'
        );

        $this->source = $source;
    }

    public function getSource(): Source
    {
        Feature::triggerDeprecationOrThrow(
            'v6.7.0.0',
            'SyncPayPayload will be removed, use PaymentPayload instead'
        );

        return $this->source;
    }

    public function getOrderTransaction(): OrderTransactionEntity
    {
        Feature::triggerDeprecationOrThrow(
            'v6.7.0.0',
            'SyncPayPayload will be removed, use PaymentPayload instead'
        );

        return $this->orderTransaction;
    }

    public function getOrder(): OrderEntity
    {
        Feature::triggerDeprecationOrThrow(
            'v6.7.0.0',
            'SyncPayPayload will be removed, use PaymentPayload instead'
        );

        return $this->order;
    }

    /**
     * @return mixed[]
     */
    public function getRequestData(): array
    {
        Feature::triggerDeprecationOrThrow(
            'v6.7.0.0',
            'SyncPayPayload will be removed, use PaymentPayload instead'
        );

        return $this->requestData;
    }

    public function getRecurring(): ?RecurringDataStruct
    {
        Feature::triggerDeprecationOrThrow(
            'v6.7.0.0',
            'SyncPayPayload will be removed, use PaymentPayload instead'
        );

        return $this->recurring;
    }

    /**
     * @return array<array-key, mixed>
     */
    public function jsonSerialize(): array
    {
        Feature::triggerDeprecationOrThrow(
            'v6.7.0.0',
            'Payment flow `capture` will be removed'
        );

        return $this->traitJsonSerialize();
    }

    /**
     * @param array<string, mixed> $array
     */
    protected function convertDateTimePropertiesToJsonStringRepresentation(array &$array): void
    {
        Feature::triggerDeprecationOrThrow(
            'v6.7.0.0',
            'Payment flow `capture` will be removed'
        );

        $this->traitConvertDateTimePropertiesToJsonStringRepresentation($array);
    }
}
