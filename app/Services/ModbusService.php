<?php

namespace App\Services;

use ModbusTcpClient\Network\ModbusTcpClient;
use ModbusTcpClient\Packet\ModbusFunction\ReadHoldingRegistersRequest;

class ModbusService
{
    private $client;

    public function __construct()
    {
        // Initialize Modbus client with the M4M 30's IP and port
        $this->client = new ModbusClient('tcp://10.55.11.62:502');
    }

    public function readRegisters(int $address, int $quantity, int $unitId = 1)
    {
        try {
            // Create a Modbus read request
            $packet = new ReadHoldingRegistersRequest($address, $quantity, $unitId);
            $binaryData = $this->client->send($packet);

            // Parse the binary data into register values
            return $packet->parse($binaryData);
        } catch (\Exception $e) {
            // Handle errors (e.g., no connection, invalid address)
            throw new \RuntimeException("Error reading Modbus registers: " . $e->getMessage());
        }
    }
}
