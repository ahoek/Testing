<?php

namespace ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment;

use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Providers\Provider;

class Processor
{

    private $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    public function doPayment(Payment $payment)
    {
        $result = $this->provider->processPayment($payment);
        $result->setProcessorPassed(true);
        return $result;
    }

}