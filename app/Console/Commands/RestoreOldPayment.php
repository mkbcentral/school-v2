<?php

namespace App\Console\Commands;

use App\Livewire\Helpers\DateFormatHelper;
use App\Models\CostGeneral;
use App\Models\Payment;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestoreOldPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:restore-old-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $counter = 0;
        $worksheet = $this->getActiveSheet(storage_path('data/paiments.xlsx'));
        foreach ($worksheet->getRowIterator() as $row) {
            if ($counter++ == 0) continue;
            $iteratorCell = $row->getCellIterator();
            $iteratorCell->setIterateOnlyExistingCells(true);
            $cells = [];
            foreach ($iteratorCell as $cell) {
                $cells[] = $cell->getValue();
            }
            $date=Date::excelToDateTimeObject($cells[7]);
            $month='';
            if ($cells[2] < 10){
                $month="0".$cells[2];
            }else{
                $month=$cells[2];
            }
            Payment::create([
                'id' => $cells[0],
                'number_payment' => $cells[1],
                'month_name' => $month,
                'cost_general_id' => $cells[3],
                'student_id' => $cells[4],
                'classe_id'=>$cells[5],
                'is_paid' => $cells[6],
                'created_at'=>$date,
                'rate_id' => 1,
                'user_id' => 4,
                'school_id'=>1
            ]);
        }
        $this->comment("Paiments bien importées");
    }
    public function getActiveSheet(string $path): Worksheet
    {
        return (new Xlsx)->load($path)->getActiveSheet();
    }
}
