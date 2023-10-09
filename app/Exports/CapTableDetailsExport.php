<?php

namespace App\Exports;

use App\Domains\CapTable\Repositories\CapTableRepository;
use App\Domains\CapTable\Services\CapTableDetails;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CapTableDetailsExport implements FromCollection, ShouldAutoSize, WithCustomStartCell, WithEvents, WithHeadings, WithStyles
{
    public function __construct(
        protected array $details,
        protected CapTableRepository $capTable,
        protected CapTableDetails $capTableDetails)
    {
    }

    public function headings(): array
    {
        return [
            [
                'VUTAL Cap Table',
            ],
            [
                '',
            ],
            [
                'Shareholder',
                'Nominal Share',
                'Number Of Share',
                'Nominal Warrant',
                'Number Of Warrant',
                'Total Nominal Share + Warrant',
                'Total Number of Share + Warrant',
                'Date Of Transaction',
                'Remarks',
                'Date Of Registration',
                'Voting Right',
                'Non Diluted Ownership',
                'Fully Diluted Ownership',
            ],
        ];
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function collection(): Collection
    {
        $data = collect([]);
        $nominalShare = 0;
        $numberOfShare = 0;
        $nominalWarrant = 0;
        $totalNominalShareWarrant = 0;
        $totalNumberOfShareWarrant = 0;
        $nonDilutedOwnership = 0;
        $fullyDilutedOwnership = 0;
        $companyInformation = $this->details['company_information'];
        foreach ($this->details['cap_table_owner'] as $owner) {
            $nominalShare = $nominalShare + $owner->nominal_share;
            $numberOfShare = $numberOfShare + $owner->number_of_share;
            $nominalWarrant = $nominalWarrant + $owner->nominal_warrant;
            $totalNominalShareWarrant = $totalNominalShareWarrant + $owner->total_nominal_share_warrant;
            $totalNumberOfShareWarrant = $totalNumberOfShareWarrant + $owner->total_nominal_share_warrant;
            $nonDilutedOwnership = $nonDilutedOwnership + $owner->non_diluted_ownership;
            $fullyDilutedOwnership = $fullyDilutedOwnership + $owner->fully_diluted_ownership;

            $data[] = [
                'shareholder' => $owner->name ?? 'N/A',
                'nominal_share' => $owner->nominal_share ?? 'N/A',
                'number_of_share' => $owner->number_of_share ?? 'N/A',
                'nominal_warrant' => $owner->nominal_warrant ?? 'N/A',
                'number_of_warrant' => $owner->number_of_warrant ?? 'N/A',
                'total_nominal_share_warrant' => $owner->total_nominal_share_warrant ?? 'N/A',
                'total_number_share_warrant' => $owner->total_number_share_warrant ?? 'N/A',
                'date_of_transaction' => $owner->transaction_date ?? 'N/A',
                'remarks' => $owner->remarks ?? 'N/A',
                'date_of_registration' => $owner->date_of_registration ?? 'N/A',
                'voting_right' => $owner->voting_right ?? 'N/A',
                'non_diluted_ownership' => $owner->non_diluted_ownership ?? 'N/A',
                'fully_diluted_ownership' => $owner->fully_diluted_ownership ?? 'N/A',
            ];

            foreach ($owner->transactions as $transaction) {
                $data[] = [
                    'shareholder' => '',
                    'nominal_share' => $transaction->nominal_share ?? 'N/A',
                    'number_of_share' => $transaction->number_of_share ?? 'N/A',
                    'nominal_warrant' => $transaction->nominal_warrant ?? 'N/A',
                    'number_of_warrant' => $transaction->number_of_warrant ?? 'N/A',
                    'total_nominal_share_warrant' => $transaction->total_nominal_share_warrant ?? 'N/A',
                    'total_number_share_warrant' => $transaction->total_number_share_warrant ?? 'N/A',
                    'date_of_transaction' => $transaction->transaction_date ?? 'N/A',
                    'remarks' => $transaction->remarks ?? 'N/A',
                    'date_of_registration' => $transaction->date_of_registration ?? 'N/A',
                    'voting_right' => $transaction->voting_right ?? 'N/A',
                    'non_diluted_ownership' => $transaction->non_diluted_ownership ?? 'N/A',
                    'fully_diluted_ownership' => $transaction->fully_diluted_ownership ?? 'N/A',
                ];
            }
        }
        $data[] = [
            [
                'shareholder' => 'Warrant Pool',
                'nominal_share' => '',
                'number_of_share' => '',
                'nominal_warrant' => $this->details['cap_table']['nominal_warrant_pool'],
                'number_of_warrant' => $this->details['cap_table']['number_of_warrant_pool'],
                'total_nominal_share_warrant' => $this->details['cap_table']['nominal_warrant_pool'],
                'total_number_share_warrant' => $this->details['cap_table']['number_of_warrant_pool'],
                'date_of_transaction' => '',
                'remarks' => '',
                'date_of_registration' => '',
                'voting_right' => '',
                'non_diluted_ownership' => '',
                'fully_diluted_ownership' => $this->details['cap_table']['warrant_pool_percentage'],
            ],
            [],
            [
                'shareholder' => '',
                'nominal_share' => 'Total- '.$companyInformation->total_nominal_share,
                'number_of_share' => 'Total- '.$companyInformation->total_number_of_share,
                'nominal_warrant' => 'Total- '.$companyInformation->total_nominal_warrant,
                'total_nominal_share_warrant' => 'Total- '.$companyInformation->total_number_of_warrant,
                'total_number_share_warrant' => 'Total- '.$companyInformation->share_capital,
                'date_of_transaction' => 'Total- '.$companyInformation->total_share,
                'remarks' => '',
                'date_of_registration' => '',
                'voting_right' => '',
                'non_diluted_ownership' => 'Total- '.$nonDilutedOwnership.'%',
                'fully_diluted_ownership' => 'Total- '.$fullyDilutedOwnership + $this->details['cap_table']['warrant_pool_percentage'].'%',
            ],
        ];

        return $data;
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('2')->getFont()->setBold(true);
        $sheet->getStyle('4')->getFont()->setBold(true);

        return [

            'A' => ['font' => ['size' => 12]],
            'B' => ['font' => ['size' => 12]],
            'C' => ['font' => ['size' => 12]],
            'D' => ['font' => ['size' => 12]],
            'E' => ['font' => ['size' => 12]],
            'F' => ['font' => ['size' => 12]],
            'G' => ['font' => ['size' => 12]],
            'H' => ['font' => ['size' => 12]],
            'I' => ['font' => ['size' => 12]],
            'J' => ['font' => ['size' => 12]],
            'K' => ['font' => ['size' => 12]],
            'L' => ['font' => ['size' => 12]],
            'M' => ['font' => ['size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'testtsgstt';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A:M')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(50);
            },
        ];
    }
}
