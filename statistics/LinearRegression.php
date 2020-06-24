<?php

namespace Statistics;

use Statistics\Support\Traits\CollectionTrait;

class LinearRegression
{
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
     * The xi.
     * 
     * @var int|float
     */
    public $xi = 0;

    /**
     * The number of item.
     * 
     * @var int
     */
    public $count = 0;

    /**
     * The data.
     * 
     * @var array
     */
    public $data = [
        'multiplication' => [],
        'y_xi_pow' => [],
        'x_deviation' => [],
        'x_deviation_pow' => [],
        'x_pow' => [],
    ];

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
     * @param  int|float  $xi
     */
    public function __construct(array $x, array $y, $xi)
    {
        $this->x = $x;
        $this->y = $y;
        $this->xi = $xi;
        $this->count = count($x);

        // Loop
        $this->loop();
    }

    /**
     * Loop through the x and y.
     * 
     * @return void
     */
    private function loop(): void
    {
        for ($i = 0; $i < $this->count; $i++) {
            array_push($this->data['multiplication'], $this->x[$i] * $this->y[$i]);
            array_push($this->data['x_deviation'], $this->x[$i] - $this->avg('x'));
            array_push($this->data['x_deviation_pow'], pow($this->data['x_deviation'][$i], 2));
            array_push($this->data['x_pow'], pow($this->x[$i], 2));
        }

        // Needs a complete multiplication of the x and y
        for ($i = 0; $i < $this->count; $i++) {
            array_push($this->data['y_xi_pow'], pow(
                $this->y[$i] - $this->y($this->x[$i]), 2
            ));
        }
    }

    /**
     * Get the average.
     * 
     * @param  string  $index
     * @return float
     */
    public function avg(string $index): float
    {
        if (array_key_exists("{$index}_average", $this->cache))
            return $this->cache["{$index}_average"];

        return $this->cache["{$index}_average"] = $this->set(
            $this->{$index}
        )->average();
    }

    /**
     * Get variance.
     * 
     * @return float
     */
    public function variance(): float
    {
        if (array_key_exists('variance', $this->cache))
            return $this->cache['variance'];

        return $this->cache['variance'] = (
            $this->set(
                $this->data['y_xi_pow']
            )->sum() / ($this->count - 2)
        );
    }

    /**
     * Get deviation.
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
     * Get the b.
     * 
     * @return float
     */
    public function b(): float
    {
        if (array_key_exists('b', $this->cache))
            return $this->cache['b'];

        return $this->cache['b'] = (
            $this->set(
                $this->data['multiplication']
            )->sum() - $this->count * (
                $this->avg('x') * $this->avg('y')
            )
        ) / (
            $this->set(
                $this->data['x_pow']
            )->sum() - $this->count * pow($this->avg('x'), 2)
        );
    }

    /**
     * Get the a.
     * 
     * @return float
     */
    public function a(): float
    {
        if (array_key_exists('a', $this->cache))
            return $this->cache['a'];

        return $this->cache['a'] = (
            $this->avg('y') - $this->b() * $this->avg('x')
        );
    }

    /**
     * Get the y.
     * 
     * @param  int|float  $xi
     * @return float
     */
    public function y($xi): float
    {
        return $this->cache['y'] = (
            $this->a() + $this->b() * $xi
        );
    }

    /**
     * Get first t.
     * 
     * @return float
     */
    public function tZero(): float
    {
        if (array_key_exists('tZero', $this->cache))
            return $this->cache['tZero'];

        return $this->cache['tZero'] = (
            ($this->b() - 0) / (
                $this->deviation() / (
                    sqrt(
                        $this->set(
                            $this->data['x_deviation_pow']
                        )->sum()
                    )
                )
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
        return "`\overline{x} = {$this->format($this->avg('x'))} , \overline{y} = {$this->format($this->avg('y'))}`";
    }

    /**
     * Get the prediction formula
     * 
     * @return string
     */
    public function predictionFormula(): string
    {
        return "`\hat{y} = \hat{a} + \hat{b} x_i = {$this->format($this->a())} + {$this->format($this->b())} * {$this->xi} = {$this->format($this->y($this->xi))}`";
    }

    /**
     * Get the variance and deviation formula.
     * 
     * @return string
     */
    public function varianceDeviationFormula(): string
    {
        $count = $this->count - 2;
        return "`s^2 = (sum_(i=1)^n (y_i - \hat{y})^2) / (n - 2) = ({$this->format($this->set($this->data['y_xi_pow'])->sum())}) / {$count} = {$this->format($this->variance())} -> s = {$this->format($this->deviation())}`";
    }

    /**
     * Get the b formula.
     * 
     * @return string
     */
    public function bFormula(): string
    {
        return "`\hat{b} = (sum_(i=1)^n x_i y_i - n (\overline{x} \overline{y}) ) / (sum_(i=1)^n x_i^2 - n (\overline{x})^2) = ({$this->format($this->set($this->data['multiplication'])->sum() - $this->count * ($this->avg('x') * $this->avg('y')))}) / ({$this->format($this->set($this->data['x_pow'])->sum() - $this->count * pow($this->avg('x'), 2))}) = {$this->format($this->b())}`";
    }

    /**
     * Get the a formula.
     * 
     * @return string
     */
    public function aFormula(): string
    {
        return "`\hat{a} = \overline{y} - \hat{b} \overline{x} = {$this->format($this->a())}`";
    }

    /**
     * Get the ya formula.
     * 
     * @return string
     */
    public function yFormula(): string
    {
        return "`\hat{y} = \hat{a} + \hat{b} x_i = {$this->format($this->a())} + {$this->format($this->b())}x_i`";
    }

    /**
     * Get t-zero formula.
     * 
     * @return string
     */
    public function tZeroFormula(): string
    {
        return "`T_0 = (\hat{b} - 0) / (s / sqrt{sum_(i=1)^n(x_i - \overline{x})^2}) = ({$this->format($this->b())}) / (({$this->format($this->deviation())}) / sqrt{{$this->format($this->set($this->data['x_deviation_pow'])->sum())})} = {$this->format($this->tZero())}`";
    }
}
