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

use SolidInvoice\NotificationBundle\Form\Type\Transport\FakeSmsType;
use Symfony\Component\Notifier\Transport\Dsn;
use function sprintf;
use function urlencode;

/**
 * @codeCoverageIgnore
 */
final class FakeSmsConfigurator implements ConfiguratorInterface
{
    public static function getName(): string
    {
        return 'FakeSms';
    }

    public static function getType(): string
    {
        return 'texter';
    }

    public function getForm(): string
    {
        return FakeSmsType::class;
    }

    /**
     * @param array{ mailer_service_id: string, to: string, from: string } $config
     */
    public function configure(array $config): Dsn
    {
        return new Dsn(sprintf('fakesms+email://%s?to=%s&amp;from=%s', urlencode($config['mailer_service_id']), urlencode($config['to']), urlencode($config['from'])));
    }
}
