<?php

require "../vendor/autoload.php";

use Statistics\LinearRegression;
use Statistics\Support\StudentsTDistribution;

$stats = new LinearRegression([
    34, 22, 48, 56, 62
], [
    5.5, 7, 3.5, 3, 1
], 42);

$t = new StudentsTDistribution(0.05, $stats->count, '=', 'LinearRegression');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Linear Regression</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles.css?<?php echo time(); ?>">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="value"><?php echo $stats->averageFormula(); ?></div>
            </div>
            <div class="row">
                <div class="value"><?php echo $stats->bFormula(); ?></div>
            </div>
            <div class="row">
                <div class="value"><?php echo $stats->aFormula(); ?></div>
            </div>
            <div class="row">
                <div class="value"><?php echo $stats->yFormula(); ?></div>
            </div>
            <div class="row">
                <div class="label">`Prediction (<?php echo $stats->xi; ?>) = `</div>
                <div class="value"><?php echo $stats->predictionFormula(); ?></div>
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