<?php declare(strict_types=1);

namespace Shopware\Core\System\Configuration\Aggregate\ConfigurationGroupTranslation\Event;

use Shopware\Core\Framework\ORM\Write\WrittenEvent;
use Shopware\Core\System\Configuration\Aggregate\ConfigurationGroupTranslation\ConfigurationGroupTranslationDefinition;

class ConfigurationGroupTranslationWrittenEvent extends WrittenEvent
{
    public const NAME = 'configuration_group_translation.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getDefinition(): string
    {
        return ConfigurationGroupTranslationDefinition::class;
    }
}
