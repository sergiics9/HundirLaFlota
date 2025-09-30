<?php
header('Content-Type: application/json');
$boardSize = 10;
$fleetDefinition = [
    ["name" => "Portaaviones", "size" => 5],
    ["name" => "Acorazado", "size" => 4],
    ["name" => "Destructor", "size" => 3],
    ["name" => "Submarino", "size" => 3],
    ["name" => "Patrullero", "size" => 2],
];

$placedShips = [];
$occupiedCoordinates = [];

foreach ($fleetDefinition as $shipInfo) {
    $isPlaced = false;

    while (!$isPlaced) {

        $orientation = rand(0, 1) ? 'horizontal' : 'vertical';

        $startRow = rand(0, $boardSize - 1);
        $startCol = rand(0, $boardSize - 1);

        $shipCoordinates = [];

        $isValidPlacement = true;

        for ($i = 0; $i < $shipInfo['size']; $i++) {

            $row = $orientation === 'horizontal' ? $startRow : $startRow + $i;
            $col = $orientation === 'horizontal' ? $startCol + $i : $startCol;

            if ($row >= $boardSize || $col >= $boardSize) {
                $isValidPlacement = false;
                break;
            }

            if (isset($occupiedCoordinates["$row-$col"])) {
                $isValidPlacement = false;
                break;
            }

            $shipCoordinates[] = ["row" => $row, "col" => $col];
        }

        if ($isValidPlacement) {
            foreach ($shipCoordinates as $coord) {
                $occupiedCoordinates["{$coord['row']}-{$coord['col']}"] = true;
            }

            $placedShips[] = [
                "name"     => $shipInfo['name'],
                "size"     => $shipInfo['size'],
                "positions" => $shipCoordinates,
                "hits"     => 0,
                "isSunk"   => false
            ];

            $isPlaced = true;
        }
    }
}

$response = [
    "boardSize" => $boardSize,
    "fleet"     => $placedShips
];
echo json_encode($response);
