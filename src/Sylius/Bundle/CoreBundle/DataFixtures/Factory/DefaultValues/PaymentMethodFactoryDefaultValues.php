<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Bundle\CoreBundle\DataFixtures\Factory\DefaultValues;

use Faker\Generator;
use Sylius\Bundle\CoreBundle\DataFixtures\Factory\ChannelFactoryInterface;
use Sylius\Bundle\CoreBundle\DataFixtures\Factory\ZoneFactoryInterface;

final class PaymentMethodFactoryDefaultValues implements PaymentMethodFactoryDefaultValuesInterface
{
    public function __construct(private ChannelFactoryInterface $channelFactory)
    {
    }

    public function getDefaults(Generator $faker): array
    {
        return [
            'code' => null,
            'name' => (string) $faker->words(3, true),
            'description' => $faker->sentence(),
            'instructions' => null,
            'gateway_name' => 'Offline',
            'gateway_factory' => 'offline',
            'gateway_config' => [],
            'enabled' => $faker->boolean(90),
            'channels' => $this->channelFactory::all(),
        ];
    }
}