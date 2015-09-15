<?php

namespace MarcosSegovia\Money;

class Dollar extends Money
{

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function multiply($factor)
    {
        return new Dollar($this->amount * $factor);
    }

}