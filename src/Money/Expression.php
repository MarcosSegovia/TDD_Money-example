<?php


namespace MarcosSegovia\Money;


interface Expression
{
    public function plus(Money $addFactor);
    public function reduce($to);
}