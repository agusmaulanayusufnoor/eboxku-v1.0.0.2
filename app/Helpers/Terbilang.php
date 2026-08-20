<?php

namespace App\Helpers;

class Terbilang
{
    public static function convert($number)
    {
        $number = (int) $number;

        if ($number == 0) {
            return 'Nol';
        }

        $minus = '';
        if ($number < 0) {
            $minus = 'Minus ';
            $number = abs($number);
        }

        $pembilang = self::proses($number);

        return $minus . trim($pembilang);
    }

    private static function proses($current)
    {
        if ($current == 0) {
            return '';
        }

        $huruf = [
            '', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima',
            'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas',
        ];

        $pembilang = '';

        if ($current < 12) {
            $pembilang = ' ' . $huruf[$current];
        } elseif ($current < 20) {
            $pembilang = self::proses($current - 10) . ' Belas';
        } elseif ($current < 100) {
            $pembilang = self::proses(floor($current / 10)) . ' Puluh' . self::proses($current % 10);
        } elseif ($current < 200) {
            $pembilang = ' Seratus' . self::proses($current - 100);
        } elseif ($current < 1000) {
            $pembilang = self::proses(floor($current / 100)) . ' Ratus' . self::proses($current % 100);
        } elseif ($current < 2000) {
            $pembilang = ' Seribu' . self::proses($current - 1000);
        } elseif ($current < 1000000) {
            $pembilang = self::proses(floor($current / 1000)) . ' Ribu' . self::proses($current % 1000);
        } elseif ($current < 1000000000) {
            $pembilang = self::proses(floor($current / 1000000)) . ' Juta' . self::proses($current % 1000000);
        } elseif ($current < 1000000000000) {
            $pembilang = self::proses(floor($current / 1000000000)) . ' Miliar' . self::proses($current % 1000000000);
        } elseif ($current < 1000000000000000) {
            $pembilang = self::proses(floor($current / 1000000000000)) . ' Triliun' . self::proses($current % 1000000000000);
        }

        return $pembilang;
    }
}
