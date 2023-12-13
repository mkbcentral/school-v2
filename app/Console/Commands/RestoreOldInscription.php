<?php

namespace App\Console\Commands;

use App\Models\Inscription;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestoreOldInscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:restore-old-inscription';

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
        $counter=0;
        $worksheet=$this->getActiveSheet(storage_path('data/inscriptions.xlsx'));
        foreach ($worksheet->getRowIterator() as $row) {
            if($counter++ ==0) continue;
            $iteratorCell=$row->getCellIterator();
            $iteratorCell->setIterateOnlyExistingCells(true);
            $cells=[];
            foreach ($iteratorCell as $cell) {
                $cells[]=$cell->getValue();

            }
            $date=Date::excelToDateTimeObject($cells[6]);

            Inscription::create([
                'id'=>$cells[0],
                'number_paiment'=>$cells[1],
                'scolary_year_id'=>$cells[2],
                'cost_inscription_id'=>$cells[3],
                'student_id'=>$cells[4],
                'classe_id'=>$cells[5],
                'created_at'=>$date,
                'school_id'=>1,
                'is_paied'=>true,
                'active' =>true,
                'is_old_student'=>true,
                'rate_id'=>1,
                'user_id'=>3
            ]);


        }

        $this->comment("Fiche bien importées");
    }
    public function getActiveSheet(string $path): Worksheet
    {
        return (new Xlsx)->load($path)->getActiveSheet();
    }
}
