<?php declare(strict_types=1);

namespace Shopware\Core\Content\Category\Dto;

use Shopware\Core\Framework\Struct\ArrayStruct;
use Shopware\Core\Framework\Struct\Extendable;
use Shopware\Core\Framework\Struct\Struct;
use Shopware\Core\System\SalesChannel\StoreApiResponse;

class Navigation extends StoreApiResponse
{
    use Extendable;

    /**
     * @param array<NavigationItem> $items
     */
    public function __construct(public string $root, public array $items)
    {
        parent::__construct(new ArrayStruct($items));
    }

    public function getObject(): Struct
    {
        return new ArrayStruct(
            data: [
                'root' => $this->root,
                'items' => $this->items,
                'extensions' => $this->_data,
            ],
            apiAlias: 'navigation'
        );
    }
}
