<?php

namespace Statistics\Support;

class StudentsTDistribution {
    /**
     * The table.
     * 
     * @var array
     */
    private const TABLE = [
        1 => [
            '0.1' => 3.078,
            '0.05' => 6.314,
            '0.025' => 12.706,
            '0.01' => 31.821,
            '0.005' => 63.657,
        ],
        2 => [
            '0.1' => 1.886,
            '0.05' => 2.920,
            '0.025' => 4.303,
            '0.01' => 6.965,
            '0.005' => 9.925,
        ],
        3 => [
            '0.1' => 1.635,
            '0.05' => 2.353,
            '0.025' => 3.182,
            '0.01' => 4.541,
            '0.005' => 5.841,
        ],
        4 => [
            '0.1' => 1.533,
            '0.05' => 2.132,
            '0.025' => 2.996,
            '0.01' => 3.747,
            '0.005' => 4.604,
        ],
        5 => [
            '0.1' => 1.476,
            '0.05' => 2.015,
            '0.025' => 2.571,
            '0.01' => 3.365,
            '0.005' => 4.032,
        ],
        6 => [
            '0.1' => 1.440,
            '0.05' => 1.943,
            '0.025' => 2.447,
            '0.01' => 3.143,
            '0.005' => 3.707,
        ],
        7 => [
            '0.1' => 1.415,
            '0.05' => 1.895,
            '0.025' => 2.365,
            '0.01' => 2.998,
            '0.005' => 3.499,
        ],
        8 => [
            '0.1' => 1.397,
            '0.05' => 1.860,
            '0.025' => 2.306,
            '0.01' => 2.896,
            '0.005' => 3.355,
        ],
        9 => [
            '0.1' => 1.383,
            '0.05' => 1.833,
            '0.025' => 2.262,
            '0.01' => 2.821,
            '0.005' => 3.250,
        ],
        10 => [
            '0.1' => 1.372,
            '0.05' => 1.812,
            '0.025' => 2.228,
            '0.01' => 2.764,
            '0.005' => 3.169,
        ],
        11 => [
            '0.1' => 1.363,
            '0.05' => 1.796,
            '0.025' => 2.201,
            '0.01' => 2.718,
            '0.005' => 3.106,
        ],
        12 => [
            '0.1' => 1.356,
            '0.05' => 1.782,
            '0.025' => 2.179,
            '0.01' => 2.681,
            '0.005' => 3.055,
        ],
        13 => [
            '0.1' => 1.350,
            '0.05' => 1.771,
            '0.025' => 2.160,
            '0.01' => 2.650,
            '0.005' => 3.012,
        ],
        14 => [
            '0.1' => 1.345,
            '0.05' => 1.761,
            '0.025' => 2.145,
            '0.01' => 2.624,
            '0.005' => 2.997,
        ],
        15 => [
            '0.1' => 1.341,
            '0.05' => 1.753,
            '0.025' => 2.131,
            '0.01' => 2.602,
            '0.005' => 2.974,
        ],
        16 => [
            '0.1' => 1.337,
            '0.05' => 1.746,
            '0.025' => 2.120,
            '0.01' => 2.583,
            '0.005' => 2.921,
        ],
        17 => [
            '0.1' => 1.333,
            '0.05' => 1.740,
            '0.025' => 2.110,
            '0.01' => 2.567,
            '0.005' => 2.898,
        ],
        18 => [
            '0.1' => 1.330,
            '0.05' => 1.734,
            '0.025' => 2.101,
            '0.01' => 2.552,
            '0.005' => 2.878,
        ],
        19 => [
            '0.1' => 1.328,
            '0.05' => 1.729,
            '0.025' => 2.093,
            '0.01' => 2.539,
            '0.005' => 2.861,
        ],
        20 => [
            '0.1' => 1.325,
            '0.05' => 1.725,
            '0.025' => 2.086,
            '0.01' => 2.528,
            '0.005' => 2.845,
        ],
        21 => [
            '0.1' => 1.323,
            '0.05' => 1.721,
            '0.025' => 2.080,
            '0.01' => 2.518,
            '0.005' => 2.831,
        ],
        22 => [
            '0.1' => 1.321,
            '0.05' => 1.717,
            '0.025' => 2.074,
            '0.01' => 2.508,
            '0.005' => 2.819,
        ],
        23 => [
            '0.1' => 1.319,
            '0.05' => 1.714,
            '0.025' => 2.069,
            '0.01' => 2.500,
            '0.005' => 2.807,
        ],
        24 => [
            '0.1' => 1.318,
            '0.05' => 1.711,
            '0.025' => 2.064,
            '0.01' => 2.492,
            '0.005' => 2.797,
        ],
        25 => [
            '0.1' => 1.316,
            '0.05' => 1.708,
            '0.025' => 2.060,
            '0.01' => 2.485,
            '0.005' => 2.787,
        ],
        26 => [
            '0.1' => 1.315,
            '0.05' => 1.706,
            '0.025' => 2.056,
            '0.01' => 2.479,
            '0.005' => 2.779,
        ],
        27 => [
            '0.1' => 1.314,
            '0.05' => 1.703,
            '0.025' => 2.052,
            '0.01' => 2.473,
            '0.005' => 2.771,
        ],
        28 => [
            '0.1' => 1.313,
            '0.05' => 1.701,
            '0.025' => 2.048,
            '0.01' => 2.467,
            '0.005' => 2.763,
        ],
        29 => [
            '0.1' => 1.311,
            '0.05' => 1.699,
            '0.025' => 2.045,
            '0.01' => 2.462,
            '0.005' => 2.756,
        ],
        30 => [
            '0.1' => 1.310,
            '0.05' => 1.697,
            '0.025' => 2.042,
            '0.01' => 2.457,
            '0.005' => 2.750,
        ],
        40 => [
            '0.1' => 1.303,
            '0.05' => 1.684,
            '0.025' => 2.021,
            '0.01' => 2.423,
            '0.005' => 2.704,
        ],
        60 => [
            '0.1' => 1.296,
            '0.05' => 1.671,
            '0.025' => 2.000,
            '0.01' => 2.390,
            '0.005' => 2.660,
        ],
        120 => [
            '0.1' => 1.289,
            '0.05' => 1.658,
            '0.025' => 1.980,
            '0.01' => 2.358,
            '0.005' => 2.617,
        ],
        0 => [
            '0.1' => 1.282,
            '0.05' => 1.645,
            '0.025' => 1.960,
            '0.01' => 2.326,
            '0.005' => 2.576,
        ],
    ];

    /**
     * The alpha.
     * 
     * @var string|float
     */
    public $alpha;

    /**
     * The degree.
     * 
     * @var int
     */
    public $degree;

    /**
     * The mode.
     * 
     * @var string
     */
    public $mode;

    /**
     * The relation.
     * 
     * @var string
     */
    public $relation;

    /**
     * The degree decrement.
     * 
     * @var int
     */
    public $decrement;

    /**
     * The degree formula.
     * 
     * @var string
     */
    public $degreeFormula;

    /**
     * Create a new instance.
     * 
     * @param  mixed  $params
     */
    public function __construct(...$params)
    {
        $this->set(...$params);
    }

    /**
     * Set new values.
     * 
     * @param  float|string  $alpha
     * @param  int|array  $degree
     * @param  string  $relation
     * @param  string|null  $mode
     */
    public function set($alpha, $degree, string $relation, string $mode = null)
    {
        $this->relation = $relation;

        $this->setMode($degree, $mode);

        switch ($relation) {
            case '<=':
                $this->alpha = (string)((float) $alpha);
            break;
            case '>=':
                $this->alpha = (string)((float) $alpha);
            break;
            case '=':
                $this->alpha = (string)(((float) $alpha) / 2);
            break;
        }
    }

    /**
     * Set the mode.
     * 
     * @param  int|array  $degree
     * @param  string  $mode
     * @return void
     */
    private function setMode($degree, string $mode): void
    {
        $this->mode = $mode;
        switch ($mode)
        {
            case 'CorrelationCoefficient':
                $this->decrement = 2;
                $this->degreeFormula = "n - 2";
                $this->degree = $degree - $this->decrement;
            break;
            case 'TwoTailedHypothesis':
                $this->decrement = 1;
                $this->degreeFormula = "n - 1";
                $this->degree = $degree - $this->decrement;
            break;
            case 'TwoTailedHypothesisUnknownVariance':
                $this->decrement = 2;
                $this->degreeFormula = "n_1 + n_2 - 2";
                $this->degree = ($degree[0] + $degree[1]) - $this->decrement;
            break;
            default:
                $this->decrement = 1;
                $this->degreeFormula = "n - 1";
                $this->degree = $degree - $this->decrement;
        }
    }

    /**
     * Calculate the critical value.
     * 
     * @return float
     */
    private function calculate(): float
    {
        if (! array_key_exists($this->degree, self::TABLE)) {
            for ($i = $this->degree + 1; $i <= 120; $i++)
                if (array_key_exists($i, self::TABLE))
                    return self::TABLE[$i][$this->alpha];

            return self::TABLE[0][$this->alpha];
        }

        return self::TABLE[$this->degree][$this->alpha];
    }

    /**
     * Get the critical value..
     * 
     * @return float
     */
    public function criticalValue(): float
    {
        if ($this->relation === '>=')
            return -1 * $this->calculate();

        return $this->calculate();
    }

    /**
     * Compare t0 and the t.
     * 
     * @param  float  $tZero
     * @return bool
     */
    public function compare(float $tZero): bool
    {
        switch ($this->relation) {
            case '<=':
                return $tZero > $this->criticalValue();
            case '>=':
                return $tZero < $this->criticalValue();
            case '=':
                return abs($tZero) > $this->criticalValue();
        }
    }

    /**
     * Get critial value formula.
     * 
     * @return string
     */
    public function formula(): string
    {
        switch ($this->relation) {
            case '<=':
                return "`t(\alpha, {$this->degreeFormula}) = t({$this->alpha}, {$this->degree}) = {$this->criticalValue()}`";
            case '>=':
                return "`-t(\alpha, {$this->degreeFormula}) = -t({$this->alpha}, {$this->degree}) = {$this->criticalValue()}`";
            case '=':
                $alpha = $this->alpha * 2;
                return "`t(\alpha / 2, {$this->degreeFormula}) = t({$alpha} / 2, {$this->degree}) = t({$this->alpha}, {$this->degree}) = {$this->criticalValue()}`";
        }
    }

    /**
     * Get comparison formula.
     * 
     * @param  float  $tZero
     * @return string
     */
    public function comparisonFormula(float $tZero): string
    {
        $condition = $this->compare($tZero);
        $tZero = \number_format($tZero, 2);
        $h = $condition ? '\\U\\n\\a\\c\\c\\e\\p\\t\\a\\b\\l\\e' : '\\A\\c\\c\\e\\p\\t\\a\\b\\l\\e';

        switch ($this->relation) {
            case '<=':
                $symbol = $condition ? '>' : '\cancel{>}';
                return "`T_0 > t(\alpha, {$this->degreeFormula}) -> {$tZero} {$symbol} {$this->criticalValue()} -> H_0: {$h}`";
            case '>=':
                $symbol = $condition ? '<' : '\cancel{<}';
                return "`T_0 < -t(\alpha, {$this->degreeFormula}) -> {$tZero} {$symbol} {$this->criticalValue()} -> H_0: {$h}`";
            case '=':
                $symbol = $condition ? '>' : '\cancel{>}';
                return "`|T_0| > t(\alpha / 2, {$this->degreeFormula}) -> |{$tZero}| {$symbol} {$this->criticalValue()} -> H_0: {$h}`";
        }
    }
}