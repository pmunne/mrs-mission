<?php
namespace App\Services;

/**
 * Rover service
 * 
 * Rover service gestiona todos los movimientos del rover en una cuadricula de 200x200. 
 *  'f' para avanzar, 'l' para girar a la izquierda, 'r' para girar a la derecha.
 *  Detecta los obstaculos y detiene el rover. Vuelve a la ultima posicion valida.
 *  
 */
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

    private function moveForward()
    {
        [$mx , $my] = match ($this->direction) {
            'N' => [0, 1],
            'E' => [1, 0],
            'S' => [0, -1],
            'W' => [-1, 0],
        };

        $newX = ($this->x + $mx + self::MAP_SIZE) % self::MAP_SIZE;
        $newY = ($this->x + $my + self::MAP_SIZE) % self::MAP_SIZE;
        if($this->isObstacle($newX, $newY)) {
            $this->obstacleFound = true;
            $this->stoppedPosition = [$this->x, $this->y];
            return;
        }
        $this->x = $newX;
        $this->y = $newY;

    }

    private function moveLeft() 
    {

    }

    private function moveRight() 
    {

    }

    private function isObstacle(int $x, int $y) 
    {
        foreach ($this->obstacles as [$ox, $oy]) {
            if ($x === $ox && $y === $oy) {
                return true;
            }
        }
        return false;
    }
}