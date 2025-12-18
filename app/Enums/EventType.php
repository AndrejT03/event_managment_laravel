<?php

namespace App\Enums;

enum EventType: string
{
    case SEMINAR = 'seminar';
    case WORKSHOP = 'workshop';
    case LECTURE = 'lecture';
}
