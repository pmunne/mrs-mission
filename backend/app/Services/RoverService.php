<?php
namespace App\Services;

class RoverService
{
    private int $x;
    private int $y;
    private string $direction;
    private array $obstacles;
    private bool $obstacleFound = false;
    private array $stoppedPosition = [];

    private const DIRECTIONS = ['N', 'E', 'S', 'W'];
    private const MAP_SIZE = 200;

    public function __construct(array $startPosition, string $direction, array $obstacles = [])
    {
        $this->x = $startPosition[0];
        $this->y = $startPosition[1];
        $this->direction = strtoupper(direction);
        $this->obstacles = $obstacles;
    }

    public function execute()
    {
        return [];
    }

    public function move()
}