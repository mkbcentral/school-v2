<?php

namespace App\Console\Commands;

use App\Livewire\Helpers\DateFormatHelper;
use App\Models\Inscription;
use App\Models\Payment;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestoreOldStudnet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:restore-old-studnet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restaurer la liste des ancien eélèves';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $counter=0;
        $worksheet=$this->getActiveSheet(storage_path('data/students.xlsx'));
        foreach ($worksheet->getRowIterator() as $row) {
            if($counter++ ==0) continue;
            $iteratorCell=$row->getCellIterator();
            $iteratorCell->setIterateOnlyExistingCells(true);
            $cells=[];
            foreach ($iteratorCell as $cell) {
                $cells[]=$cell->getValue();
            }
            $date=Date::excelToDateTimeObject($cells[4]);
            Student::create([
                'id'=>$cells[0],
                'name'=>$cells[1],
                'gender'=>$cells[2],
                'place_of_birth'=>$cells[3],
                'date_of_birth'=>$date,
                'school_id'=>1,
                'scolary_year_id'=>1
            ]);
        }
        $this->comment("Student bien importées");
    }

    public function getActiveSheet(string $path): Worksheet
    {
        return (new Xlsx)->load($path)->getActiveSheet();
    }

}
