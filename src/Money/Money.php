<?php


namespace MarcosSegovia\Money;


abstract class Money
{
    protected $amount;

    public function equals(Money $money)
    {
        return $this->getAmount() == $money->getAmount() && get_class($this) == get_class($money);
    }

    public function getAmount()
    {
        return $this->amount;
    }

    static function dollar($amount)
    {
        return new Dollar($amount);
    }

    static function franc($amount)
    {
        return new Franc($amount);
    }

    abstract function multiply($factor);
}