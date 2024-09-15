<?php

namespace App\Console\Commands;

use App\Models\GroupOfficial;
use App\Models\Student;
use App\Models\StudentGroupOfficial;
use Illuminate\Console\Command;

class ClearDataCampainOfficial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-data-campain-official {id}';

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
        $id = $this->argument('id');
        $students = Student::query()->where('campaign_id', $id)->get();
        $idStudents = $students->pluck('id')->toArray();
        StudentGroupOfficial::query()->whereIn('student_id', $idStudents)->delete();
        Student::query()->where('campaign_id', $id)->update([
           'group_official_id' => null
        ]);

        GroupOfficial::query()->where('campaign_id', $id)->delete();
    }
}
