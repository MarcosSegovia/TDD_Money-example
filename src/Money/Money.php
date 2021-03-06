<?php


namespace MarcosSegovia\Money;


class Money implements Expression
{
    protected $amount;
    protected $currency;

    public function __construct($amount, $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function equals(Money $money)
    {
        return $this->getAmount() == $money->getAmount() && strcmp($this->currency(), $money->currency()) == 0;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    static function dollar($amount)
    {
        return new Money($amount, 'USD');
    }

    static function franc($amount)
    {
        return new Money($amount, 'CHF');
    }

    public function currency()
    {
        return $this->currency;
    }

    public function multiply($factor)
    {
        return new Money($this->amount * $factor, $this->currency());
    }

    public function plus(Expression $addFactor)
    {
        return new Sum($this, $addFactor);
    }

    public function reduce(Bank $bank, $to)
    {
        $rate = $bank->rate($this->currency(), $to);
        return new Money($this->amount / $rate, $to);
    }
}