<?php

namespace App\Console\Commands;

use App\Models\Classe;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestoreOldClasse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:restore-old-classe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resaurer les ancienne classe';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $counter=0;
        $worksheet=$this->getActiveSheet(storage_path('data/classes_up.xlsx'));
        foreach ($worksheet->getRowIterator() as $row) {
            if($counter++ ==0) continue;
            $iteratorCell=$row->getCellIterator();
            $iteratorCell->setIterateOnlyExistingCells(true);
            $cells=[];
            foreach ($iteratorCell as $cell) {
                $cells[]=$cell->getValue();
            }
            Classe::create([
                'id'=>$cells[0],
                'name'=>$cells[1],
                'classe_option_id'=>$cells[2],
            ]);
        }
        $this->comment("Classes bien importées");
    }

    public function getActiveSheet(string $path): Worksheet
    {
        return (new Xlsx)->load($path)->getActiveSheet();
    }
}
