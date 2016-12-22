<?php

namespace ConnectHolland\UnitTestTutorial\AppBundle\Payment;


class Payment
{

    private $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

}