<?php

namespace App\Exports\Task;


use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TasksExport implements WithHeadings, FromQuery, WithMapping,WithStyles
{
    public function query()
    {
        $task = Task::query()->with('getSources');
        return $task;
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone code',
            'Mobile',
            'Source',
            'Status'
        ];
    }
    public function map($task): array
    {
        if ($task->status == 1) {
            $status = 'ACTIVE';
        } else {
            $status = 'INACTIVE';
        }
        $values = [
            $task->name,
            $task->email,
            $task->code,
            $task->phone,
            $task->getSources->name,
            $status
        ];
        return $values;
    }
    public function styles(Worksheet $sheet)
    {
        return [
            
            1    => ['font' => ['bold' => true]],

       
            
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Sheet $sheet */
                $sheet = $event->sheet;

                $sheet->mergeCells('A1:T1');
                // $sheet->setCellValue('A1', 'Lead Status From ' . $this->headerDateFrom . ' To ' . $this->headerDateTo);

               

                $sheet->setCellValue('A1', 'Cancelled Sales List');

                $default_font_style = [
                    'font' => ['name' => 'Arial', 'size' => 15],
                ];
                $header_font = [
                    'font' => ['name' => 'Arial', 'size' => 11],
                ];

                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $cellRange = 'A1:T1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
                // $event->sheet->getParent()->getDefaultStyle()->applyFromArray($default_font_style);
                $event->sheet->getStyle('A1:U1')->applyFromArray($default_font_style);
                $event->sheet->getStyle('A2:U2')->applyFromArray($header_font);
            },
        ];
    }
}
