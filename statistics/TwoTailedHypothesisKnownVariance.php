<?php

namespace Statistics;
use Statistics\Support\Traits\CollectionTrait;

class TwoTailedHypothesisKnownVariance {
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
    }

    /**
     * Calculate variance.
     * 
     * @param  string  $index
     * @return float
     */
    public function variance($index): float
    {
        if (array_key_exists('variance', $this->cache))
            return $this->cache['variance'];

        return $this->cache['variance'] = pow($this->{$index}['deviation'], 2);
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
     * Calculate zZero.
     * 
     * @return float
     */
    public function zZero(): float
    {
        if (array_key_exists('tZero', $this->cache))
            return $this->cache['tZero'];

        return $this->cache['tZero'] = (
            $this->y['average'] - $this->x['average']
        ) / sqrt(
            (pow($this->x['deviation'], 2) / $this->y['n']) + (pow($this->x['deviation'], 2) / $this->y['n'])
        );
    }
    
    /**
     * Get the zZero formula.
     * 
     * @return string
     */
    public function zZeroFormula(): string
    {
        return "`Z_0 = (\overline{y} - \overline{x}) / sqrt{\sigma_1^2 / n_1 + \sigma_2^2 / n_2} = ({$this->format($this->y['average'])} - {$this->format($this->x['average'])}) / sqrt{{$this->format($this->variance('x'))} / {$this->format($this->x['n'])} + {$this->format($this->variance('y'))} / {$this->format($this->y['n'])}} = {$this->format($this->zZero())}`";
    }
}
