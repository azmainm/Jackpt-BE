<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ReportImport implements ToCollection
{
    public function collection(Collection $collections)
    {
        $account_number = null;
        $account_data = [];

        for ($i = 0; $i < count($collections); $i++) {
            if (! is_int($collections[$i][0])) {
                continue;
            }
            if ($account_number == null) {
                $account_number = (int) substr($collections[$i][0], 0, 2);
                $account_data[] = $this->getAccountData($collections[$i]);

            } elseif ((int) substr($collections[$i][0], 0, 2) != $account_number) {
                $account_number = (int) substr($collections[$i][0], 0, 2);
                //store data
                $account_data = (array) null;
                $account_data[] = $this->getAccountData($collections[$i]);
            }
            $account_data[] = $this->getAccountData($collections[$i]);
        }

    }

    private function getAccountData($data)
    {
        $account = (int) substr($data[0], 0, 2);
        $data[] = $account;

        return $data;
    }
}
