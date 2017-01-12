<?php

namespace ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Providers;

use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Payment;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Result;
use GuzzleHttp\Client;

class PayPalProvider implements Provider
{
    public function processPayment(Payment $payment)
    {
        $result = new Result();
        $result->setTransactionId(1);

        $client = new Client();
        $response = $client->request('GET', 'https://www.paypal.côm/perform/transaction?amount=100');
        
        if ($response->getStatusCode() === 200) {
            $result->setSuccess(true);
        } else {
            $result->setSuccess(false);
        }

        return $result;
    }
}