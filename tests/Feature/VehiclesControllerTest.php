<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Models\Vehicle;

class VehiclesControllerTest extends TestCase
{
    public function testIndex()
    {
        $this->call('GET', 'vehicles');
    }
}
