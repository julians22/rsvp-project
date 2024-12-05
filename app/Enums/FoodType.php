<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum FoodType: string implements HasLabel
{
    case BUFFET = 'buffet';
    case ALA_CARTE = 'ala carte';

    /**
     * Get the label for the given enum value.
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::BUFFET => 'Buffet',
            self::ALA_CARTE => 'Ala Carte',
        };
    }
}
