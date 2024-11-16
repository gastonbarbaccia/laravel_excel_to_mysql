<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class UsersImport implements ToCollection, WithChunkReading, WithBatchInserts, WithHeadingRow, SkipsEmptyRows
{
    use Importable;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }

    public function collection(Collection $rows)
    {
        $users = [];

        foreach ($rows as $row) {

                $users[] = [
                    'name'       => $row['dni'],
                    'email'      => $row['nombre'],
                    'password'   => $row['entidad_de_origen'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

	}
        User::insert($users);
    }

    public function chunkSize(): int
    {
        return 11000;
    }

    public function batchSize(): int
    {
        return 11000; // Inserta 1000 registros a la vez en la base de datos
    }
}

