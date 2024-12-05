<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum VisitorStatusType: string implements HasLabel
{
    case HADIR = 'hadir';
    case HADIR_TIDAK_PRESENTASI = 'Hadir tapi tidak presentasi';
    case SAKIT = 'sakit';
    case SUBSTITUTE = 'substitute';

    /**
     * Get the label for the given enum value.
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::HADIR => 'Hadir',
            self::HADIR_TIDAK_PRESENTASI => 'Hadir, tapi tidak presentasi',
            self::SAKIT => 'Sakit',
            self::SUBSTITUTE => 'Substitute',
        };
    }
}
