<?php

namespace App\Imports;

use App\Models\Grade;
use Maatwebsite\Excel\Concerns\ToModel;

class GradesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Grade([
            'student_id' => $row[0],
            'unit_id' => $row[1],
            'grade' => $row[2],
        ]);
    }
    public function batchSize(): int
    {
        return 1000; // Adjust the batch size as needed
    }


}
