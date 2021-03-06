<?php

namespace MarcosSegovia\MoneyTest;

use MarcosSegovia\Money\Money;
use MarcosSegovia\Money\Bank;
use MarcosSegovia\Money\Sum;



class MoneyTest extends \PHPUnit_Framework_TestCase
{

    public function testDollarEquality()
    {
        $five = Money::dollar(5);
        $this->assertTrue($five->equals(Money::dollar(5)));
        $this->assertFalse($five->equals(Money::dollar(6)));
    }

    public function testFrancEquality()
    {
        $five = Money::franc(5);
        $this->assertTrue($five->equals(Money::franc(5)));
        $this->assertFalse($five->equals(Money::franc(6)));
    }

    public function testEquality()
    {
        $fiveDollar = Money::dollar(5);
        $this->assertTrue($fiveDollar->equals(Money::dollar(5)));
        $this->assertFalse($fiveDollar->equals(Money::dollar(6)));
        $fiveFranc = Money::franc(5);

        $this->assertFalse($fiveFranc->equals(Money::dollar(5)));
    }

    public function testMultiplication()
    {
        $fiveDollar = Money::dollar(5);
        $this->assertEquals(Money::dollar(10), $fiveDollar->multiply(2));
        $this->assertEquals(Money::dollar(15), $fiveDollar->multiply(3));
    }

    public function testCurrency()
    {
        $this->assertEquals("USD", Money::dollar(1)->currency());
        $this->assertEquals("CHF", Money::franc(1)->currency());
    }

    public function testSimpleAddition()
    {
        $five = Money::dollar(5);
        $sum = $five->plus($five);
        $bank = new Bank();
        $reduced = $bank->reduce($sum, 'USD');
        $this->assertEquals(Money::dollar(10), $reduced);
    }

    public function testPlusReturnSum()
    {
        $five = Money::dollar(5);
        $result = $five->plus($five);
        $this->assertEquals($five, $result->getAugend());
        $this->assertEquals($five, $result->getAugend());
    }

    public function testReduceSum()
    {
        $sum = new Sum(Money::dollar(3), Money::dollar(4));
        $bank = new Bank();
        $result = $bank->reduce($sum, 'USD');
        $this->assertEquals(Money::dollar(7), $result);
    }

    public function testReduceMoneyDifferentCurrency()
    {
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);
        $result = $bank->reduce(Money::franc(2), 'USD');
        $this->assertEquals(Money::dollar(1), $result);
    }

    public function testIdentifyRate()
    {
        $bank = new Bank();
        $this->assertEquals(1, $bank->rate('USD', 'USD'));
    }

    public function testMixedAddition()
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);
        $result = $bank->reduce($fiveBucks->plus($tenFrancs), 'USD');
        $this->assertEquals(Money::dollar(10), $result);
    }

    public function testSumPlusMoney()
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);
        $sum = new Sum($fiveBucks, $tenFrancs);
        $sumTotal = $sum->plus($fiveBucks);
        $result = $bank->reduce($sumTotal, 'USD');
        $this->assertEquals(Money::dollar(15), $result);
    }

    public function testSumMultiply()
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);
        $sum = new Sum($fiveBucks, $tenFrancs);
        $sumTotal = $sum->multiply(2);
        $result = $bank->reduce($sumTotal, 'USD');
        $this->assertEquals(Money::dollar(20), $result);
    }
}