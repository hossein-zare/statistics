<?php

namespace Statistics;
use Statistics\Support\Traits\CollectionTrait;

class Hypothesis {
    use CollectionTrait;

    /**
     * The x.
     * 
     * @var array
     */
    public $x = [];

    /**
     * The y.
     * 
     * @var array
     */
    public $y = [];

    /**
     * The d.
     * 
     * @var array
     */
    public $d = [
        'numbers' => [],
        'deviation' => [],
        'deviation_pow' => [],
    ];

    /**
     * The number of items.
     * 
     * @var int
     */
    public $count = 0;

    /**
     * The cache.
     * 
     * @var array
     */
    protected $cache = [];

    /**
     * Create a new instance.
     * 
     * @param  array  $x
     * @param  array  $y
     */
    public function __construct(array $x, array $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->count = count($x);

        // Loop through the numbers
        $this->loop();
    }

    /**
     * Prepare the collection.
     * 
     * @return void
     */
    protected function loop(): void
    {
        for ($i = 0; $i < $this->count; $i++)
            array_push($this->d['numbers'], $this->y[$i] - $this->x[$i]);

        $average = $this->avg();

        for ($i = 0; $i < $this->count; $i++) {
            array_push($this->d['deviation'], $this->d['numbers'][$i] - $average);
            array_push($this->d['deviation_pow'], pow($this->d['deviation'][$i], 2));
        }
    }

    /**
     * Get the average.
     * 
     * @return float
     */
    public function avg(): float
    {
        if (array_key_exists('avg', $this->cache))
            return $this->cache['avg'];

        return $this->cache['avg'] = $this->set(
            $this->d['numbers']
        )->average();
    }

    /**
     * Calculate variance.
     * 
     * @return float
     */
    public function variance(): float
    {
        if (array_key_exists('variance', $this->cache))
            return $this->cache['variance'];

        return $this->cache['variance'] = $this->set(
            $this->d['deviation_pow']
        )->sum() / ($this->count - 1);
    }

    /**
     * Calculate standard deviation.
     * 
     * @return float
     */
    public function deviation(): float
    {
        if (array_key_exists('deviation', $this->cache))
            return $this->cache['deviation'];

        return $this->cache['deviation'] = sqrt(
            $this->variance()
        );
    }

    /**
     * Calculate tZero.
     * 
     * @return float
     */
    public function tZero(): float
    {
        if (array_key_exists('tZero', $this->cache))
            return $this->cache['tZero'];

        return $this->cache['tZero'] = $this->avg() / ($this->deviation() / sqrt($this->count));
    }

    /**
     * Get the average formula.
     * 
     * @return string
     */
    public function averageFormula(): string
    {
        $sum = $this->set(
            $this->d['numbers']
        )->sum();
        return "`\overline{d} = (sum d_i) / n = {$sum} / {$this->count} = {$this->format($this->avg())}`";
    }

    /**
     * Get the variance and deviation formula.
     * 
     * @return string
     */
    public function varianceDeviationFormula(): string
    {
        $sum = $this->set(
            $this->d['deviation_pow']
        )->sum();
        $count = $this->count - 1;
        return "`s_d^2 = (sum (d_i - \overline{d})^2) / (n - 1) = ({$this->format($sum)}) / {$count} = {$this->format($this->variance())} -> s = {$this->format($this->deviation())}`";
    }

    /**
     * Get the tZero formula.
     * 
     * @return string
     */
    public function tZeroFormula(): string
    {
        return "`T_0 = \overline{d} / (S_d / sqrt{n}) = ({$this->format($this->avg())}) / (({$this->format($this->deviation())}) / sqrt{{$this->count}}) = {$this->format($this->tZero())}`";
    }
}
