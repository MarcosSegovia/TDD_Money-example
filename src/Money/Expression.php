<?php


namespace MarcosSegovia\Money;


interface Expression
{
    public function multiply($factor);
    public function plus(Expression $addFactor);
    public function reduce(Bank $bank, $to);
}