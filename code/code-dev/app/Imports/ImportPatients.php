<?php

namespace App\Imports;

use App\Http\Models\Patient;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportPatients implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Patient([
            'id' => $row['id'],
            'unit_id' => $row['unit_id'],
            'exp_prev' => $row['exp_prev'],
            'type' => $row['type'],
            'affiliation' => $row['affiliation'],
            'affiliation_principal' => $row['affiliation_principal'],
            'affiliation_idparent' => $row['affiliation_idparent'],
            'name' => $row['name'],
            'lastname' => $row['lastname'],
            'contact' => $row['contact'],
            'birth' => $row['birth'],
            'age' => $row['age'],
            'gender' => $row['gender'],
            'deleted_at' => $row['deleted_at'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);
    }
}
