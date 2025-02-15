<?php

declare(strict_types=1);

namespace App\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;

#[AsCallback(table: 'tl_content', target: 'fields.url.attributes')]
class InfoBoxListener
{
    public function __invoke(array $attributes, DataContainer|null $dc = null): array
    {
        if (!$dc || 'info_box' !== ($dc->getCurrentRecord()['type'] ?? null)) {
            return $attributes;
        }

        $attributes['mandatory'] = false;

        return $attributes;
    }
}
