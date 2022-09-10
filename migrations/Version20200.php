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

namespace DoctrineMigrations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use SolidInvoice\SettingsBundle\Form\Type\MailTransportType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

final class Version20200 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function isTransactional(): bool
    {
        return \PHP_VERSION_ID < 80000;
    }

    /**
     * @var Schema
     */
    private $schema;

    public function up(Schema $schema): void
    {
        $this->connection->insert(
            'app_config',
            [
                'setting_key' => 'invoice/watermark',
                'setting_value' => true,
                'description' => 'Display a watermark on the invoice with the status',
                'field_type' => CheckboxType::class],
        );
        $this->connection->insert(
            'app_config',
            [
                'setting_key' => 'quote/watermark',
                'setting_value' => true,
                'description' => 'Display a watermark on the quote with the status',
                'field_type' => CheckboxType::class],
        );
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('app_config', ['setting_key' => 'invoice/watermark']);
        $this->connection->delete('app_config', ['setting_key' => 'quote/watermark']);
    }
}
