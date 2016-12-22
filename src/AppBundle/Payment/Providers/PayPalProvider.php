<?php

namespace ConnectHolland\UnitTestTutorial\AppBundle\Payment\Providers;

use ConnectHolland\UnitTestTutorial\AppBundle\Payment\Payment;
use ConnectHolland\UnitTestTutorial\AppBundle\Payment\Result;

class PayPalProvider implements Provider
{
    public function processPayment(Payment $payment)
    {
        die("Whoops! This would actually connect to PayPal, and that is not something you would want in a unit test!");
        $result = new Result();
        $result->setSuccess(true);
        $result->setTransactionId(1);
        return $result;
    }
}