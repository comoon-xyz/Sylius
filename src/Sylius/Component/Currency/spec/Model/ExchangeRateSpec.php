<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Component\Currency\Model;

use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Component\Currency\Model\ExchangeRate;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Currency\Model\ExchangeRateInterface;

/**
 * @author Jan Góralski <jan.goralski@lakion.com>
 */
final class ExchangeRateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ExchangeRate::class);
    }

    function it_implements_exchange_rate_interface()
    {
        $this->shouldImplement(ExchangeRateInterface::class);
    }

    function it_throws_an_invalid_argument_exception_when_adding_non_float_ratio()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('setRatio', ['1.01']);
        $this->shouldThrow(\InvalidArgumentException::class)->during('setRatio', ['asd']);
        $this->shouldThrow(\InvalidArgumentException::class)->during('setRatio', [[]]);
        $this->shouldThrow(\InvalidArgumentException::class)->during('setRatio', [null]);
        $this->shouldThrow(\InvalidArgumentException::class)->during('setRatio', [false]);
        $this->shouldThrow(\InvalidArgumentException::class)->during('setRatio', [new \stdClass()]);
    }

    function it_has_a_ratio()
    {
        $this->getRatio()->shouldReturn(null);
        $this->setRatio(1.02);
        $this->getRatio()->shouldReturn(1.02);
        $this->setRatio(1e-6);
        $this->getRatio()->shouldReturn(1e-6);
    }

    function it_has_base_currency(CurrencyInterface $currency)
    {
        $this->getBaseCurrency()->shouldReturn(null);
        $this->setBaseCurrency($currency);
        $this->getBaseCurrency()->shouldReturn($currency);
    }

    function it_has_counter_currency(CurrencyInterface $currency)
    {
        $this->getCounterCurrency()->shouldReturn(null);
        $this->setCounterCurrency($currency);
        $this->getCounterCurrency()->shouldReturn($currency);
    }
}
