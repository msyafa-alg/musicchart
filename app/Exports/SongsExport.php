<?php

namespace App\Exports;

use App\Models\Song;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SongsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Song::with(['artist', 'album'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Song Title',
            'Artist',
            'Album',
            'Duration (seconds)',
            'Duration (formatted)',
            'Created At',
            'Updated At'
        ];
    }

    public function map($song): array
    {
        $formatDate = function ($value, $format = 'd M Y H:i') {
            if (!$value) {
                return '-';
            }
            if ($value instanceof \DateTimeInterface) {
                return $value->format($format);
            }
            try {
                return Carbon::parse($value)->format($format);
            } catch (\Exception $e) {
                return (string) $value;
            }
        };

        return [
            $song->id,
            $song->judul,
            optional($song->artist)->name ?? 'Unknown Artist',
            optional($song->album)->judul ?? 'Unknown Album',
            $song->durasi,
            $song->durasi_formatted,
            $formatDate($song->created_at),
            $formatDate($song->updated_at),
        ];
    }
}
