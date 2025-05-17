<?php

use Illuminate\Support\Str;

if (!function_exists('french_singular')) {
    function french_singular(string $word): string
    {
        $map = [
            'chevaux' => 'cheval',
            'travaux' => 'travail',
            'yeux' => 'œil',
            'journaux' => 'journal',
            'bateaux' => 'bateau',
            'categorie_sorties' => 'categorie_sortie',
            'sorties' => 'sortie',
            'caisses' => 'caisse'
            // Add more rules here
        ];

        return $map[$word] ?? Str::singular($word);
    }
}

if (!function_exists('french_plural')) {
    function french_plural(string $word): string
    {
        $map = [
            'cheval' => 'chevaux',
            'travail' => 'travaux',
            'œil' => 'yeux',
            'journal' => 'journaux',
            'bateau' => 'bateaux',
              'categorie_sortie' => 'categorie_sorties',
            'sortie' => 'sorties',
            'caisse' => 'caisses'
        ];

        return $map[$word] ?? Str::plural($word);

    }
}
