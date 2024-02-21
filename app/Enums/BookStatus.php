<?php

namespace App\Enums;

enum BookStatus : string
{
    case AVAILABLE = 'available';
    case UNAVAILABLE = 'unavailable';
    case NOT_RETURNED = 'not returned';
}