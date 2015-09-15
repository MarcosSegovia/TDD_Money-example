<?php


namespace MarcosSegovia\Money;


class Franc extends Money
{

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function multiply($factor)
    {
        return new Franc($this->amount * $factor);
    }


}