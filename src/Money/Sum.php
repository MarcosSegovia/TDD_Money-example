<?php


namespace MarcosSegovia\Money;


class Sum implements Expression
{
    private $augend;
    private $addend;

    public function __construct(Expression $augend, Expression $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    public function plus(Expression $addFactor)
    {
        return new Sum($this, $addFactor);
    }

    public function reduce(Bank $bank, $to)
    {
        $augendReduced = $this->getAugend()->reduce($bank, $to);
        $addendReduced = $this->getAddend()->reduce($bank, $to);
        $amount = $augendReduced->getAmount() + $addendReduced->getAmount();
        return new Money($amount, $to);
    }

    public function multiply($factor)
    {
        return new Sum($this->getAugend()->multiply($factor), $this->getAddend()->multiply($factor));
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