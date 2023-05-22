<?php

namespace App\Services;

use App\Domains\CapTable\Models\CapTable;
use App\Domains\CapTable\Repositories\CapTableRepository;
use App\Domains\CapTableOwner\Repositories\CapTableOwnerRepository;

class CompanyInformationService
{
    public function __construct(
        protected CapTableOwnerRepository $capTableOwner,
        protected CapTableRepository $capTable,
    ) {
    }

    private function calculateNumberOfShare(float $fullyDilutedOwnership, float $totalShare): float
    {
        return ($fullyDilutedOwnership / 100) * $totalShare;
    }

    private function warrantPoolAmount(float $totalShare, $cap_table_id): float
    {
        $cap_table = $this->capTable->find($cap_table_id);
        $warrant_pool_percentage = (float) $cap_table->warrant_pool_percentage;
        if ($warrant_pool_percentage > 0) {
            return ($totalShare * $warrant_pool_percentage) / 100;
        }

        return 0;
    }

    private function calculatedNonDilutedPercentage(float $totalShare, int $cap_table_id, $share, float $share_value): float
    {
        $number_of_warrant_pool = $this->warrantPoolAmount($totalShare, $cap_table_id);
        if ($number_of_warrant_pool > 0) {
            $totalShare = $totalShare - $number_of_warrant_pool;
            $this->updateCapTable($number_of_warrant_pool, $cap_table_id, $share_value);
        }

        return ($share / $totalShare) * 100;
    }

    private function updateCapTable($number_of_warrant_pool, $cap_table_id, float $share_value): void
    {
        $this->capTable->update([
            'number_of_warrant_pool' => $number_of_warrant_pool,
            'nominal_warrant_pool' => ($number_of_warrant_pool * $share_value),
        ], $cap_table_id);
    }

    private function calculateNominalShare($share_capital, $non_diluted_percentage, CapTable $capTable): float
    {
        /*
        |--------------------------------------------------------------------------
        | Nominal Share
        |--------------------------------------------------------------------------
        | (share_capital - warrant_pool) x non_diluted percentage //ex:(40000-1000)X10%
        |
       */
        $warrant_pool = ($share_capital * (float) $capTable->warrant_pool_percentage) / 100;
        $share_capital_without_warrant_pool = ($share_capital - $warrant_pool);

        return ($share_capital_without_warrant_pool * $non_diluted_percentage) / 100;
    }

    public function updateCapTableOwnerShare(CapTable $capTable, int $totalShare, float $shareCapital, float $share_value): void
    {
        $owners = $capTable->capTableOwner;
        foreach ($owners as $owner) {
            $share = $this->calculateNumberOfShare($owner->fully_diluted_ownership, $totalShare);
            $non_diluted_percentage = $this->calculatedNonDilutedPercentage($totalShare, $owner->cap_table_id, $share, $share_value);
            $nominal_share = $this->calculateNominalShare($shareCapital, $non_diluted_percentage, $capTable);
            $this->capTableOwner->update([
                'number_of_share' => $share,
                'total_number_share_warrant' => $share,
                'non_diluted_ownership' => $non_diluted_percentage,
                'nominal_share' => $nominal_share,
                'total_nominal_share_warrant' => $nominal_share,
            ], $owner->uuid, 'uuid');
        }
    }
}
