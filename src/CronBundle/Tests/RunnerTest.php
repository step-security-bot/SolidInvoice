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

namespace SolidInvoice\CronBundle\Tests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as M;
use PHPUnit\Framework\TestCase;
use SolidInvoice\CronBundle\CommandInterface;
use SolidInvoice\CronBundle\Runner;

class RunnerTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function testRun(): void
    {
        $cron = new Runner();

        $command = M::mock(CommandInterface::class);

        $command->shouldReceive('isDue')
            ->once()
            ->andReturn(true);

        $command->shouldReceive('process')
            ->once();

        $cron->addCommand($command);

        $cron->run();
    }

    public function testRunNoCommands(): void
    {
        $cron = new Runner();

        $command = M::mock(CommandInterface::class);

        $command->shouldReceive('isDue')
            ->once()
            ->andReturn(false);

        $command->shouldReceive('process')
            ->never();

        $cron->addCommand($command);

        $cron->run();
    }
}
