<?php

namespace App;

use DateTimeImmutable;

class Event
{
    public string $identifier;

    public float $longitude;

    public float $latitude;

    public string $description;

    public DateTimeImmutable $date;
}
