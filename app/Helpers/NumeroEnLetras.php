<?php

if (!function_exists('numeroEnLetras')) {
    function numeroEnLetras($num)
    {
        $unidades = array(
            0 => 'CERO', 1 => 'UNO', 2 => 'DOS', 3 => 'TRES', 4 => 'CUATRO',
            5 => 'CINCO', 6 => 'SEIS', 7 => 'SIETE', 8 => 'OCHO', 9 => 'NUEVE',
            10 => 'DIEZ', 11 => 'ONCE', 12 => 'DOCE', 13 => 'TRECE', 14 => 'CATORCE',
            15 => 'QUINCE', 16 => 'DIECISÉIS', 17 => 'DIECISIETE', 18 => 'DIECIOCHO',
            19 => 'DIECINUEVE', 20 => 'VEINTE', 30 => 'TREINTA', 40 => 'CUARENTA',
            50 => 'CINCUENTA', 60 => 'SESENTA', 70 => 'SETENTA', 80 => 'OCHENTA',
            90 => 'NOVENTA', 100 => 'CIEN', 200 => 'DOSCIENTOS', 300 => 'TRESCIENTOS',
            400 => 'CUATROCIENTOS', 500 => 'QUINIENTOS', 600 => 'SEISCIENTOS',
            700 => 'SETECIENTOS', 800 => 'OCHOCIENTOS', 900 => 'NOVECIENTOS'
        );

        $num = intval($num);
        
        if ($num == 0) return 'CERO';
        if ($num < 0) return 'MENOS ' . numeroEnLetras(abs($num));
        if ($num < 20) return $unidades[$num];
        
        if ($num < 100) {
            $decena = intval($num / 10) * 10;
            $unidad = $num % 10;
            return $unidades[$decena] . ($unidad > 0 ? ' Y ' . $unidades[$unidad] : '');
        }
        
        if ($num < 1000) {
            $centena = intval($num / 100) * 100;
            $resto = $num % 100;
            
            if ($num == 100) {
                return 'CIEN';
            } elseif ($centena == 100) {
                $palabra = 'CIENTO';
            } else {
                $palabra = $unidades[$centena];
            }
            
            return $palabra . ($resto > 0 ? ' ' . numeroEnLetras($resto) : '');
        }
        
        // ⭐ AQUÍ ESTÁ EL FIX CRÍTICO ⭐
        if ($num < 1000000) {
            $mil = intval($num / 1000);
            $resto = $num % 1000;
            
            // Si es exactamente 1000, solo retornar "MIL"
            if ($mil == 1) {
                return 'MIL' . ($resto > 0 ? ' ' . numeroEnLetras($resto) : '');
            }
            
            // Si es más de 1000, convertir los miles
            return numeroEnLetras($mil) . ' MIL' . ($resto > 0 ? ' ' . numeroEnLetras($resto) : '');
        }
        
        $millon = intval($num / 1000000);
        $resto = $num % 1000000;
        
        if ($millon == 1) {
            return 'UN MILLÓN' . ($resto > 0 ? ' ' . numeroEnLetras($resto) : '');
        }
        
        return numeroEnLetras($millon) . ' MILLONES' . ($resto > 0 ? ' ' . numeroEnLetras($resto) : '');
    }
}