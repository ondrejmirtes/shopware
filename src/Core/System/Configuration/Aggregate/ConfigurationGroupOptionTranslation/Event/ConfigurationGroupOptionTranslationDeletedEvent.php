<?php declare(strict_types=1);

namespace Shopware\Core\System\Configuration\Aggregate\ConfigurationGroupOptionTranslation\Event;

use Shopware\Core\Framework\ORM\Write\DeletedEvent;
use Shopware\Core\Framework\ORM\Write\WrittenEvent;
use Shopware\Core\System\Configuration\Aggregate\ConfigurationGroupOptionTranslation\ConfigurationGroupOptionTranslationDefinition;

class ConfigurationGroupOptionTranslationDeletedEvent extends WrittenEvent implements DeletedEvent
{
    public const NAME = 'configuration_group_option_translation.deleted';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getDefinition(): string
    {
        return ConfigurationGroupOptionTranslationDefinition::class;
    }
}
