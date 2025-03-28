<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum VisitorType: string implements HasLabel
{
    case VISITOR = 'visitor';
    case INTERNATIONAL_MEMBER = 'international member';
    case NATIONAL_DIRECTOR = 'national director';
    case DC_AND_AMBASSADOR = 'dc and ambassador';
    case ALTITUDE = 'altitude';
    case MAGNITUDE = 'magnitude';
    case MAGNIFY = 'magnify';
    case DIGNIFY = 'dignify';
    case FIREFLY = 'firefly';
    case AMPLIFY = 'amplify';
    case GLORIFY = 'glorify';
    case BALIONAIRE = 'balionaire';
    case RISE = 'rise';
    case MULTIPLY = 'multiply';
    case MAHARDIKA = 'mahardika';
    case NUSANTARA = 'nusantara';
    case VICTORY = 'victory';
    case GROW = 'grow';
    case VISION = 'vision';
    case CHAMPION = 'champion';
    case PASSION = 'passion';
    case STAR = 'star';
    case PIONEER = 'pioneer';
    case MULTIRICH = 'multirich';
    case OTHER = 'other';
    case OBSERVER = 'observer';
    case VISITOR_HOST = 'visitor Host';
    /**
     * Get the label for the given enum value.
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::VISITOR => 'Visitor',
            self::INTERNATIONAL_MEMBER => 'International Member',
            self::NATIONAL_DIRECTOR => 'National Director',
            self::DC_AND_AMBASSADOR => 'DC & Ambassador',
            self::ALTITUDE => 'Altitude',
            self::MAGNITUDE => 'Magnitude',
            self::MAGNIFY => 'Magnify',
            self::DIGNIFY => 'Dignify',
            self::FIREFLY => 'Firefly',
            self::AMPLIFY => 'Amplify',
            self::GLORIFY => 'Glorify',
            self::BALIONAIRE => 'Balionaire',
            self::RISE => 'Rise',
            self::MULTIPLY => 'Multiply',
            self::MAHARDIKA => 'Mahardika',
            self::NUSANTARA => 'Nusantara',
            self::VICTORY => 'Victory',
            self::GROW => 'Grow',
            self::VISION => 'Vision',
            self::CHAMPION => 'Champion',
            self::PASSION => 'Passion',
            self::STAR => 'Star',
            self::PIONEER => 'Pioneer',
            self::MULTIRICH => 'Multirich',
            self::OTHER => 'Other Chapter / Core Group',
            self::OBSERVER => 'Observer',
            self::VISITOR_HOST => 'Visitor Host',
        };
    }

    public function getBgImgPath(): string
    {
        return match ($this) {
            self::VISITOR => asset('img/zoom-bg/Visitor.png'),
            self::NATIONAL_DIRECTOR => asset('img/zoom-bg/National Director.png'),
            self::ALTITUDE,
            self::MAGNITUDE => asset('img/zoom-bg/Member.png'),

                // TODO: WE REALLY SHOULD PUT THIS LINK IN A CONSTANT SOMEWHERE, NOT HARD CODED.
            default => 'https://drive.google.com/drive/folders/1N7GMUHap1w-J29MdaXMWi8p76revHFEq?usp=sharing',
        };
    }
}
