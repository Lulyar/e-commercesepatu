<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function createTransaction(array $data);
    public function findByTrxIdAndPhoneNumber($bookingTrxId, $phone);
    public function saveToSession(array $data);
    public function updateSessionData(array $data);
    public function getOrderDataFromSession();

}
