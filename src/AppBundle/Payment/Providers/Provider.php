<?php
namespace ConnectHolland\UnitTestTutorial\AppBundle\Payment\Providers;

use ConnectHolland\UnitTestTutorial\AppBundle\Payment\Payment;

interface Provider
{
    public function processPayment(Payment $payment);
}