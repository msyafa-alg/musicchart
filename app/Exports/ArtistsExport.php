<?php

namespace App\Exports;

use App\Models\Artist;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ArtistsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Artist::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Artist Name',
            'Biography',
            'Photo',
            'Created At',
            'Updated At'
        ];
    }

    public function map($artist): array
    {
        return [
            $artist->id,
            $artist->name,
            $artist->bio ?? '-',
            $artist->photo ? 'Yes' : 'No',
            $artist->created_at->format('d M Y H:i'),
            $artist->updated_at->format('d M Y H:i'),
        ];
    }
}
