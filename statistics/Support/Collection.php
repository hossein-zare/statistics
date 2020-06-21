<?php

namespace Statistics\Support;

class Collection {
    /**
     * Items.
     * 
     * @var array
     */
    public $items = [];
    
    /**
     * Create a new instance.
     * 
     * @param  array  $items
     */
    public function __construct(array $items)
    {
        $this->set($items);
    }

    /**
     * Set items.
     * 
     * @param  array  $items
     * @return \Statistics\Collection
     */
    public function set(array $items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * Get the number of items.
     * 
     * @return int
     */
    public function count(): int
    {
        return count(
            $this->items
        );
    }

    /**
     * Get the sum of numbers.
     * 
     * @return float
     */
    public function sum(): float
    {
        return array_sum(
            $this->items
        );
    }

    /**
     * Get the subtraction of numbers.
     * 
     * @return float
     */
    public function subtract(): float
    {
        return array_reduce(
            $this->items, function ($first, $second) {
                return $first === null ?
                    $second : $first - $second;
            }
        );
    }

    /**
     * Get the average.
     * 
     * @param  string  $index
     * @return float
     */
    public function average(): float
    {
        return $this->sum() / $this->count();
    }

    /**
     * Filter numbers.
     * 
     * @return array
     */
    public function filter(): array
    {
        return array_filter(
            $this->items
        );
    }

    /**
     * Get the square root.
     * 
     * @param  int|float  $number
     * @return float
     */
    public function sqrt($number): float
    {
        return sqrt($number);
    }

    /**
     * Get the absolute value.
     * 
     * @param  int|float  $number
     * @return float
     */
    public function abs($number): float
    {
        return abs($number);
    }

    /**
     * Map numbers.
     * 
     * @param  callable  $callback
     * @param  bool  $save
     * @return array
     */
    public function map(callable $callback, bool $save = false): array
    {
        $array = array_map(
            $callback, $this->items
        );

        if ($save)
            $this->items = $array;

        return $array;
    }

    /**
     * Format number.
     * 
     * @param  float  $number
     * @return string
     */
    public function format($number, $percision = 2): string
    {
        return \number_format($number, $percision);
    }
}
