<?php
namespace App\Services;

/**
 * Rover service
 * 
 * Manage all the rover movments on a 200 map size. 
 * The rover can recieve commands to move: 'f' (forward), 'l' (left), 'r' (right).
 * 
 * Before moving forward the rover checks if there is any obstacles in the way, if it is, it stop.
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

    /**
     * 
     * @param array $startPosition Initial position as [x, y]
     * @param string $direction Initial direction : 'N', 'E', 'S', 'W'
     * @param array $obstacles Optional list of obstacles as [[x1, y1], [x2, y2], ...]
     */
    public function __construct(array $startPosition, string $direction, array $obstacles = [])
    {
        $this->x = $startPosition[0];
        $this->y = $startPosition[1];
        $this->direction = strtoupper($direction);
        $this->obstacles = $obstacles;
    }

    /**
     * Execute a give command string.
     * 
     * @param string $commands
     * @return array
     */
    public function execute(string $commands)
    {
        foreach(str_split(strtolower($commands)) as $command) {
                match ($command) {
                    'f' => $this->moveForward(),
                    'l' => $this->moveLeft(),
                    'r' => $this->moveRight(),
                    default => throw new \InvalidArgumentException("Invalid command: $command"),
                };
                if($this->obstacleFound) {
                    break;
                }
        }

        return [
            'final_position' => [$this->x, $this->y],
            'direction' => $this->direction,
            'obstacle_found' => $this->obstacleFound,
            'stopped_position' => $this->stoppedPosition,
        ];
    }

    /**
     * Move the rover forward in the current directon.
     * @return void
     */
    private function moveForward()
    {
        [$mx , $my] = match ($this->direction) {
            'N' => [0, 1],
            'E' => [1, 0],
            'S' => [0, -1],
            'W' => [-1, 0],
        };

        $newX = ($this->x + $mx + self::MAP_SIZE) % self::MAP_SIZE;
        $newY = ($this->y + $my + self::MAP_SIZE) % self::MAP_SIZE;
        if($this->isObstacle($newX, $newY)) {
            $this->obstacleFound = true;
            $this->stoppedPosition = [$this->x, $this->y];
            return;
        }
        $this->x = $newX;
        $this->y = $newY;

    }

    /**
     * Turn the rover to the left
     * 
     * @return void
     */
    private function moveLeft() 
    {
        $i = array_search($this->direction, self::DIRECTIONS);
        $this->direction = self::DIRECTIONS[($i - 1 + count(self::DIRECTIONS)) % count(self::DIRECTIONS)];
    }

    /**
     * Turn the rover to the right
     * 
     * @return void
     */
    private function moveRight() 
    {
        $i = array_search($this->direction, self::DIRECTIONS);
        $this->direction = self::DIRECTIONS[($i + 1) % count(self::DIRECTIONS)];
    }

    /**
     * Check if there is an obstacle in the given position.
     * @param int $x
     * @param int $y
     * @return bool
     */
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