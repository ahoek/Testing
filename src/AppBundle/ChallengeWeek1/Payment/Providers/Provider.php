<?php
namespace ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Providers;

use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Payment;

interface Provider
{
    public function processPayment(Payment $payment);
}