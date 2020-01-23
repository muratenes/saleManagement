<?php namespace App\Repositories\Interfaces;

interface SaleInterface
{
    public function getAllSales();

    public function getSalesByUserRole($userId, $roleId);

    public function getSalesBySaleDirectorUserId($saleDirectorUserId);

    public function getSalesBySaleRepresentativeUserId($saleRepresentativeUserId, $subRepresentativeCount = 10);

    public function getUserSalePay($userId, $roleId);

    public function getManagerPay($managerUserId);

    public function getDirectorPay($directorUserId);

    public function getRepresentativePay($repUserId);
}
