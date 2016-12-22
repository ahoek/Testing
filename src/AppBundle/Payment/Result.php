<?php

namespace ConnectHolland\UnitTestTutorial\AppBundle\Payment;

class Result
{

    private $success;
    private $transactionId;
    private $processorPassed;

    public function __construct()
    {
        $this->success = false;
        $this->processorPassed = false;
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    public function isProcessorPassed()
    {
        return $this->processorPassed;
    }

    public function setProcessorPassed($processorPassed)
    {
        $this->processorPassed = $processorPassed;
    }

}