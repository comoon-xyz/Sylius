<?php

declare(strict_types=1);

namespace Sylius\Bundle\CoreBundle\DataFixtures\Util;

use Psr\EventDispatcher\EventDispatcherInterface;
use Sylius\Bundle\CoreBundle\DataFixtures\Event\FindOrCreateResourceEvent;
use Sylius\Bundle\CoreBundle\DataFixtures\Event\ResourceEventInterface;
use Sylius\Bundle\CoreBundle\DataFixtures\Factory\CustomerFactoryInterface;
use Sylius\Component\Core\Model\CustomerInterface;
use Zenstruck\Foundry\Proxy;

trait FindOrCreateCustomerTrait
{
    /**
     * @return CustomerInterface|Proxy
     */
    private function findOrCreateCustomer(EventDispatcherInterface $eventDispatcher, array $attributes): Proxy
    {
        /** @var ResourceEventInterface $event */
        $event = $eventDispatcher->dispatch(
            new FindOrCreateResourceEvent(CustomerFactoryInterface::class, $attributes)
        );

        return $event->getResource();
    }
}
