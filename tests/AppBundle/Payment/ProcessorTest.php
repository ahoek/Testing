<?php

namespace Tests\ConnectHolland\UnitTestTutorial\AppBundle;

use PHPUnit_Framework_TestCase;
use ConnectHolland\UnitTestTutorial\AppBundle\Payment\Payment;
use ConnectHolland\UnitTestTutorial\AppBundle\Payment\Providers\PayPalProvider;
use ConnectHolland\UnitTestTutorial\AppBundle\Payment\Processor;
use ConnectHolland\UnitTestTutorial\AppBundle\Payment\Result;

class ProcessorTest extends PHPUnit_Framework_TestCase
{

    public function testPaymentSuccess()
    {

        $payment = new Payment(12.25);

        //$paypal = new PayPalProvider();
        $result = new Result();                                     /// 1
        $result->setSuccess(true);
        $result->setTransactionId(1);

        $paypal = $this->getMockBuilder(PayPalProvider::class)      /// 2
            ->getMock();

        $paypal->expects($this->once())                             /// 3
            ->method('processPayment')
            ->will($this->returnValue($result));

        $processor = new Processor($paypal);

        $result = $processor->doPayment($payment);

        $this->assertTrue($result->isProcessorPassed());
        $this->assertTrue($result->isSuccess());
    }
}
