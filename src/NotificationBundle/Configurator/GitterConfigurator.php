<?php

declare(strict_types=1);

/*
 * This file is part of SolidInvoice project.
 *
 * (c) Pierre du Plessis <open-source@solidworx.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

// !! This file is autogenerated. Do not edit. !!

namespace SolidInvoice\NotificationBundle\Configurator;

use SolidInvoice\NotificationBundle\Form\Type\Transport\GitterType;
use Symfony\Component\Notifier\Transport\Dsn;
use function sprintf;
use function urlencode;

/**
 * @codeCoverageIgnore
 */
final class GitterConfigurator implements ConfiguratorInterface
{
    public static function getName(): string
    {
        return 'Gitter';
    }

    public static function getType(): string
    {
        return 'chatter';
    }

    public function getForm(): string
    {
        return GitterType::class;
    }

    /**
     * @param array{ token: string, room_id: string } $config
     */
    public function configure(array $config): Dsn
    {
        return new Dsn(sprintf('gitter://%s@default?room_id=%s', urlencode($config['token']), urlencode($config['room_id'])));
    }
}
