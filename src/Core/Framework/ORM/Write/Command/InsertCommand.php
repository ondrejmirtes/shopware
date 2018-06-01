<?php declare(strict_types=1);
/**
 * Shopware\Core 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware\Core" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Core\Framework\ORM\Write\Command;

use Shopware\Core\Framework\ORM\EntityDefinition;
use Shopware\Core\Framework\ORM\Write\EntityExistence;

class InsertCommand implements WriteCommandInterface
{
    /**
     * @var array
     */
    private $payload;

    /**
     * @var string|EntityDefinition
     */
    private $definition;

    /**
     * @var array
     */
    private $primaryKey;
    /**
     * @var EntityExistence
     */
    private $existence;

    public function __construct(string $definition, array $payload, array $primaryKey, EntityExistence $existence)
    {
        $this->payload = $payload;
        $this->definition = $definition;
        $this->primaryKey = $primaryKey;
        $this->existence = $existence;
    }

    public function isValid(): bool
    {
        return (bool) count($this->payload);
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getDefinition(): string
    {
        return $this->definition;
    }

    public function getPrimaryKey(): array
    {
        return $this->primaryKey;
    }

    /**
     * @return EntityExistence
     */
    public function getEntityExistence(): EntityExistence
    {
        return $this->existence;
    }
}
