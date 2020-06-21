<?php

require "../vendor/autoload.php";

use Statistics\CorrelationCoefficient;
use Statistics\Support\StudentsTDistribution;

$stats = new CorrelationCoefficient([
    43,
    48,
    56,
    61,
    67,
    70
], [
    128,
    120,
    135,
    143,
    141,
    152
]);

$t = new StudentsTDistribution(0.05, $stats->count - 1, '=');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Correlation Coefficient</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles.css?<?php echo time(); ?>">
    </head>
    <body>
        <div class="container mt-5">
            <div class="mb-5">
                <?php echo $stats->table(); ?>
            </div>
            <div class="row">
                <div class="value"><?php echo $stats->formula(); ?></div>
            </div>
            <div class="row">
                <div class="value"><?php echo $stats->tZeroFormula(); ?></div>
            </div>
            <div class="row">
                <div class="value"><?php echo $t->formula(2); ?></div>
            </div>
            <div class="row">
                <div class="value"><?php echo $t->comparisonFormula($stats->tZero()); ?></div>
            </div>
            <div class="row">
                <div class="label">Description:</div>
                <div class="value"><?php echo $stats->describe(); ?></div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=AM_CHTML"></script>
    </body>
</html>