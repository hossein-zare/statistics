<?php

require "../vendor/autoload.php";

use Statistics\TwoTailedHypothesisKnownVariance;
use Statistics\Support\StudentsTDistribution;

$stats = new TwoTailedHypothesisKnownVariance([
    'n' => 10,
    'average' => 8.6,
    'deviation' => 3.3
], [
    'n' => 10,
    'average' => 7.9,
    'deviation' => 3.3
]);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Two-Tailed Hypothesis Known Variance</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles.css?<?php echo time(); ?>">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="value"><?php echo $stats->zZeroFormula(); ?></div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=AM_CHTML"></script>
    </body>
</html>