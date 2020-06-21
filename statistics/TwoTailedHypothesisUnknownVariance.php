<?php

namespace Statistics;
use Statistics\Support\Traits\CollectionTrait;

class TwoTailedHypothesisUnknownVariance {
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
     * Get degree.
     * 
     * @return array
     */
    public function getDegree(): array
    {
        return [
            $this->x['n'], $this->y['n']
        ];
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

        return $this->cache['variance'] = (
            (($this->x['n'] - 1) * pow($this->x['deviation'], 2)) + (($this->y['n'] - 1) * pow($this->y['deviation'], 2))
        ) / ($this->x['n'] + $this->y['n'] - 1);
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

        return $this->cache['tZero'] = (
            $this->y['average'] - $this->x['average']
        ) / (
            $this->deviation() * sqrt(
                (1 / $this->x['n']) + (1 / $this->y['n'])
            )
        );
    }

    /**
     * Get the average formula.
     * 
     * @return string
     */
    public function averageFormula(): string
    {
        return "`\overline{x} = {$this->format($this->x['average'])} , \overline{y} = {$this->format($this->y['average'])}`";
    }

    /**
     * Get the variance and deviation formula.
     * 
     * @return string
     */
    public function varianceDeviationFormula(): string
    {
        return "`s_p^2 = ((n_1 - 1)s_1^2 + (n_2 - 1)s_2^2) / (n_1 + n_2 - 2) = (({$this->format($this->x['n'])} - 1)({$this->format($this->x['deviation'])})^2 + ({$this->format($this->y['n'])} - 1)({$this->format($this->y['deviation'])})^2) / (({$this->format($this->x['n'])}) + ({$this->format($this->y['n'])}) - 2) = {$this->format($this->variance())} -> s_p = sqrt{{$this->format($this->variance())}} = {$this->format($this->deviation())}`";
    }

    /**
     * Get the tZero formula.
     * 
     * @return string
     */
    public function tZeroFormula(): string
    {
        return "`T_0 = (\overline{y} - \overline{x}) / (s_p sqrt{ 1 / n_1 + 1 / n_2 }) = ({$this->format($this->y['average'])} - {$this->format($this->x['average'])}) / ({$this->format($this->deviation())} sqrt{ 1 / {$this->format($this->x['n'])} + 1 / {$this->format($this->y['n'])} }) = {$this->format($this->tZero())}`";
    }
}
