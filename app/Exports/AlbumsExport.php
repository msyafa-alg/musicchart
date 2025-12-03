<?php

namespace App\Exports;

use App\Models\Album;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlbumsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Album::with('artist')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Album Title',
            'Artist',
            'Release Date',
            'Cover',
            'Created At',
            'Updated At'
        ];
    }

    public function map($album): array
    {
        // Helper untuk format tanggal dengan aman
        $formatDate = function ($value, $format = 'd M Y') {
            if (!$value) {
                return '-';
            }

            // Jika sudah instance dari DateTimeInterface (Carbon), pakai format langsung
            if ($value instanceof \DateTimeInterface) {
                return $value->format($format);
            }

            // Coba parse dengan Carbon (jika nilai string)
            try {
                return Carbon::parse($value)->format($format);
            } catch (\Exception $e) {
                // Jika gagal parse, kembalikan string as-is
                return (string) $value;
            }
        };

        return [
            $album->id,
            $album->judul,
            optional($album->artist)->name ?? 'Unknown Artist',
            $formatDate($album->tanggal_rilis, 'd M Y'),
            $album->cover ? 'Yes' : 'No',
            $formatDate($album->created_at, 'd M Y H:i'),
            $formatDate($album->updated_at, 'd M Y H:i'),
        ];
    }
}
