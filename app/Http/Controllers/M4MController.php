<?php

namespace App\Http\Controllers;

use App\Services\ModbusService;
use Illuminate\Http\Request;

class M4MController extends Controller
{
    private $modbusService;

    public function __construct(ModbusService $modbusService)
    {
        $this->modbusService = $modbusService;
    }

    public function getL1N()
    {
        try {
            // Read registers (example: address 3000, 4 registers, Unit ID 1)
            $data = $this->modbusService->readRegisters(4098, 1, 1);

            // Example: Convert registers to float (check M4M manual for format)
            $energy = unpack("f", pack("S2", $data[1], $data[0]))[1];

            return response()->json(['energy' => $energy]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
