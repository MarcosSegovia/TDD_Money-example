<?php


namespace MarcosSegovia\Money;


class Bank
{
    private $rates;

    public function __construct()
    {
        $this->rates = array();
    }

    public function reduce(Expression $source, $to)
    {
        return $source->reduce($this, $to);
    }

    public function addRate($originCurrency, $destinyCurrency, $ratio)
    {
        $this->rates[$originCurrency][$destinyCurrency] = $ratio;
    }

    public function rate($from, $to)
    {
        if (strcmp($from, $to) == 0) {
            return 1;
        }
        return $this->rates[$from][$to];
    }
}