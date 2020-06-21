<?php

namespace Statistics;

use Statistics\Support\Traits\CollectionTrait;

class CorrelationCoefficient {
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
        $this->prepare('x', $x);
        $this->prepare('y', $y);
        $this->count = count($x);

        // Loop through the numbers
        $this->loop();
    }

    /**
     * Prepare the collection.
     * 
     * @param  string  $property
     * @param  array  $array
     * @return void
     */
    protected function prepare(string $property, array $array): void
    {
        $this->{$property}['numbers'] = $array;
        $this->{$property}['sum'] = $this->set($array)->sum($array);
        $this->{$property}['average'] = $this->set($array)->average($array);
        $this->{$property}['deviation'] = [];
        $this->{$property}['deviation_pow'] = [];
    }

    /**
     * Calculation loop.
     * 
     * @return void
     */
    protected function loop(): void
    {
        for ($i = 0; $i < $this->count; $i++) {
            $this->calculateDeviation('x', $i)->calculateDeviation('y', $i);
        }
    }

    /**
     * Deviation calculation for the property.
     * 
     * @param  string  $property
     * @param  int  $i
     * @return \Statistics\CorrelationCoefficient
     */
    protected function calculateDeviation(string $property, int $i)
    {
        $deviation = $this->{$property}['numbers'][$i] - $this->{$property}['average'];
        array_push(
            $this->{$property}['deviation'], $deviation
        );
        array_push(
            $this->{$property}['deviation_pow'], pow($deviation, 2)
        );

        return $this;
    }

    /**
     * Multiplate deviations.
     * 
     * @return array
     */
    protected function multiplyDeviations(): array
    {
        if (array_key_exists('deviation_multiplication', $this->cache))
            return $this->cache['deviation_multiplication'];

        $this->cache['deviation_multiplication'] = [];
        for ($i = 0; $i < $this->count; $i++) {
            array_push(
                $this->cache['deviation_multiplication'], $this->x['deviation'][$i] * $this->y['deviation'][$i]
            );
        }

        return $this->cache['deviation_multiplication'];
    }

    /**
     * Describe the result.
     * 
     * @return string
     */
    public function describe(): string
    {
        switch ($this->calculate()) {
            case 1:
                return 'Positive Perfect Linear Relationship +';
            case -1:
                return 'Negative Perfect Linear Relationship -';
            default:
                if ($this->calculate() >= 0.5)
                    return 'Strong Positive Correlation +';
                if ($this->calculate() <= -0.5)
                    return 'Strong Negative Correlation -';
                return 'No Correlation or Weak Correlation';
        }
    }

    /**
     * Calculate the correlation coefficient.
     * 
     * @return float
     */
    public function calculate(): float
    {
        if (array_key_exists('r', $this->cache))
            return $this->cache['r'];
        
        $this->cache['sum'] = [
            'x' => [
                'deviation' => $this->set(
                    $this->x['deviation']
                )->sum(),
                'deviation_pow' => $this->set(
                    $this->x['deviation_pow']
                )->sum(),
            ],
            'y' => [
                'deviation' => $this->set(
                    $this->y['deviation']
                )->sum(),
                'deviation_pow' => $this->set(
                    $this->y['deviation_pow']
                )->sum(),
            ],
            'deviation_multiplication' => $this->set(
                $this->multiplyDeviations()
            )->sum()
        ];

        return $this->cache['r'] = ($this->cache['sum']['deviation_multiplication'] / (sqrt(
            $this->cache['sum']['x']['deviation_pow'] * $this->cache['sum']['y']['deviation_pow']
        ) ?: 1));
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

        return $this->cache['tZero'] = $this->calculate() * sqrt(
            ($this->count - 2) / (1 - pow($this->calculate(), 2))
        );
    }

    /**
     * Get r formula.
     * 
     * @return string
     */
    public function formula(): string
    {
        // Get the cache ready
        $this->calculate();

        $deviation_multiplication = $this->format(
            $this->cache['sum']['deviation_multiplication']
        );
        $x_deviation_pow = $this->format(
            $this->cache['sum']['x']['deviation_pow']
        );
        $y_deviation_pow = $this->format(
            $this->cache['sum']['y']['deviation_pow']
        );
        $result = $this->format(
            $this->calculate()
        );

        $definition = "(sum_(i=1)^n(x_i-\overlinex)) / sqrt{sum_(i=1)^n(x_i-\overlinex)^2 (y_i-\overliney)^2}";
        $replacement = "{$deviation_multiplication} / sqrt{{$x_deviation_pow} * {$y_deviation_pow}}";
        return "`r = {$definition} = {$replacement} = {$result}`";
    }

    /**
     * Get t-zero formula.
     * 
     * @return string
     */
    public function tZeroFormula(): string
    {
        // Get the cache ready
        $this->calculate();

        $deviation_multiplication = $this->format(
            $this->cache['sum']['deviation_multiplication']
        );
        $x_deviation_pow = $this->format(
            $this->cache['sum']['x']['deviation_pow']
        );
        $y_deviation_pow = $this->format(
            $this->cache['sum']['y']['deviation_pow']
        );
        $r = $this->format(
            $this->calculate()
        );
        $r_pow = pow($r, 2);
        $result = $this->format(
            $this->tZero()
        );

        $definition = "r * sqrt{(n - 2) / (1 - r^2)}";
        $replacement = "{$r} * sqrt{({$this->count()} - 2) / (1 - {$r_pow})}";
        return "`T_0 = {$definition} = {$replacement} = {$result}`";
    }

    /**
     * Create a table of the output numbers.
     * 
     * @return string
     */
    public function table(): string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $groups = $x = $y = '';
        for ($i = 0; $i < $this->count(); $i++) {
            $groups.= <<<EOD
                <tr>
                    <td><b>{$alphabet[$i]}</b></td>
                    <td>{$this->format($this->x['numbers'][$i])}</td>
                    <td>{$this->format($this->y['numbers'][$i])}</td>
                    <td>{$this->format($this->x['deviation'][$i])}</td>
                    <td>{$this->format($this->y['deviation'][$i])}</td>
                    <td>{$this->format($this->x['deviation_pow'][$i])}</td>
                    <td>{$this->format($this->y['deviation_pow'][$i])}</td>
                    <td>{$this->format($this->multiplyDeviations()[$i])}</td>
                </tr>
            EOD;
        }

        // Footer
        $groups.= <<<EOD
            <tr>
                <td><b>Total</b></td>
                <td>{$this->format($this->set($this->x['numbers'])->sum())}</td>
                <td>{$this->format($this->set($this->y['numbers'])->sum())}</td>
                <td>{$this->format($this->set($this->x['deviation'])->sum())}</td>
                <td>{$this->format($this->set($this->y['deviation'])->sum())}</td>
                <td>{$this->format($this->set($this->x['deviation_pow'])->sum())}</td>
                <td>{$this->format($this->set($this->y['deviation_pow'])->sum())}</td>
                <td>{$this->format($this->set($this->multiplyDeviations())->sum())}</td>
            </tr>
            <tr>
                <td><b>`\bar{x} , \bar{y}`</b></td>
                <td>{$this->format($this->set($this->x['numbers'])->average())}</td>
                <td>{$this->format($this->set($this->y['numbers'])->average())}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        EOD;

        return <<<EOD
            <table style="width: 100%">
                <tr>
                    <th></th>
                    <th>x</th>
                    <th>y</th>
                    <th>`(x_i-\overlinex)`</th>
                    <th>`(y_i-\overliney)`</th>
                    <th>`(x_i-\overlinex)^2`</th>
                    <th>`(y_i-\overliney)^2`</th>
                    <th>`(x_i-\overlinex)(y_i-\overliney)`</th>
                </tr>
                
                {$groups}
            </table>
        EOD;
    }
}
