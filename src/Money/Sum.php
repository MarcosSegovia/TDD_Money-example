<?php


namespace MarcosSegovia\Money;


class Sum implements Expression
{
    private $augend;
    private $addend;

    public function __construct(Money $augend, Money $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    public function plus(Money $addFactor)
    {

    }

    public function reduce($to)
    {
        $amount = $this->augend->getAmount() + $this->addend->getAmount();
        return new Money($amount, $to);
    }

    public function getAugend()
    {
        return $this->augend;
    }

    public function getAddend()
    {
        return $this->addend;
    }

}