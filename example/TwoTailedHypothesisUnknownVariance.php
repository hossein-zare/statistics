<?php

require "../vendor/autoload.php";

use Statistics\TwoTailedHypothesisUnknownVariance;
use Statistics\Support\StudentsTDistribution;

$stats = new TwoTailedHypothesisUnknownVariance([
    'n' => 13,
    'average' => 4.7,
    'deviation' => 0.9
], [
    'n' => 25,
    'average' => 5.1,
    'deviation' => 0.8
]);

$t = new StudentsTDistribution(0.01, $stats->getDegree(), '=', 'TwoTailedHypothesisUnknownVariance');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Two-Tailed Hypothesis Unknown Variance</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles.css?<?php echo time(); ?>">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="value"><?php echo $stats->averageFormula(); ?></div>
            </div>
            <div class="row">
                <div class="value"><?php echo $stats->varianceDeviationFormula(); ?></div>
            </div>
            <div class="row">
                <div class="value"><?php echo $stats->tZeroFormula(); ?></div>
            </div>
            <div class="row">
                <div class="value"><?php echo $t->formula(); ?></div>
            </div>
            <div class="row">
                <div class="value"><?php echo $t->comparisonFormula($stats->tZero()); ?></div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=AM_CHTML"></script>
    </body>
</html>