PHP Router Benchmark
====================

The intent here is to benchmark different PHP routing solutions. This is a micro-optimization, done purely out of 
dumb curiosity.


Installation
------------

Clone the repo, run `composer install`, run `php run-tests.php`.

You can install the [Pux](https://github.com/c9s/pux) extension to test that as well. If the extension is not
installed, the tests will fallback to the pure PHP implementation of Pux.

To test the [R3 library](https://github.com/c9s/php-r3), you also need to install that extension. If the extension is
not installed, the tests for R3 will be skipped.

Benchmark environment
---------
Debian 8.2

PHP 7.0.0


Currently
---------

The current test creates 1000 routes, each with a randomized prefix and postfix, with 9 parameters each.

It was run with the [Pux](https://github.com/c9s/pux) and [R3](https://github.com/c9s/php-r3) extensions enabled.

An example route: `/9b37eef21e/{arg1}/{arg2}/{arg3}/{arg4}/{arg5}/{arg6}/{arg7}/{arg8}/{arg9}/bda37e9f9b`

## Worst-case matching
This benchmark matches the last route and unknown route. It generates a randomly prefixed and suffixed route in an attempt to thwart any optimization. 1,000 routes each with 9 arguments.

This benchmark consists of 12 tests. Each test is executed 1,000 times, the results pruned, and then averaged. Values that fall outside of 3 standard deviations of the mean are discarded.


Test Name | Results | Time | + Interval | Change
--------- | ------- | ---- | ---------- | ------
Conformity Learnable - last route (1000 routes) | 999 | 0.0000040944 | +0.0000000000 | baseline
Timber - unknown route (1000 routes) | 997 | 0.0000046034 | +0.0000005090 | 12% slower
Router - unknown route (1000 routes) | 991 | 0.0000047785 | +0.0000006841 | 17% slower
TreeRoute - unknown route (1000 routes) | 990 | 0.0000057411 | +0.0000016467 | 40% slower
TreeRoute - last route (1000 routes) | 996 | 0.0000111083 | +0.0000070139 | 171% slower
Conformity - unknown route (1000 routes) | 997 | 0.0000137001 | +0.0000096057 | 235% slower
Conformity Learnable - unknown route (1000 routes) | 985 | 0.0000150557 | +0.0000109613 | 268% slower
Router - last route (1000 routes) | 989 | 0.0000195040 | +0.0000154096 | 376% slower
Timber - last route (1000 routes) | 999 | 0.0000274349 | +0.0000233405 | 570% slower
FastRoute - unknown route (1000 routes) | 980 | 0.0000672345 | +0.0000631401 | 1542% slower
Symfony2 Dumped - unknown route (1000 routes) | 989 | 0.0000924575 | +0.0000883631 | 2158% slower
FastRoute - last route (1000 routes) | 999 | 0.0001264955 | +0.0001224011 | 2989% slower
Symfony2 Dumped - last route (1000 routes) | 995 | 0.0001772135 | +0.0001731192 | 4228% slower
Symfony2 - unknown route (1000 routes) | 998 | 0.0006014890 | +0.0005973946 | 14591% slower
Pux PHP - unknown route (1000 routes) | 998 | 0.0006263266 | +0.0006222322 | 15197% slower
Pux PHP - last route (1000 routes) | 999 | 0.0007687018 | +0.0007646074 | 18675% slower
Symfony2 - last route (1000 routes) | 998 | 0.0008137582 | +0.0008096638 | 19775% slower
Conformity - last route (1000 routes) | 996 | 0.0030857291 | +0.0030816347 | 75265% slower
Aura v2 - unknown route (1000 routes) | 989 | 0.0343667588 | +0.0343626644 | 839264% slower
Aura v2 - last route (1000 routes) | 994 | 0.0372709240 | +0.0372668296 | 910194% slower


## First route matching
This benchmark tests how quickly each router can match the first route. 1,000 routes each with 9 arguments.

This benchmark consists of 6 tests. Each test is executed 1,000 times, the results pruned, and then averaged. Values that fall outside of 3 standard deviations of the mean are discarded.


Test Name | Results | Time | + Interval | Change
--------- | ------- | ---- | ---------- | ------
Conformity Learnable - first route (1000 routes) | 998 | 0.0000033868 | +0.0000000000 | baseline
Pux PHP - first route | 997 | 0.0000067228 | +0.0000033360 | 99% slower
FastRoute - first route | 999 | 0.0000075105 | +0.0000041237 | 122% slower
TreeRoute - first route | 971 | 0.0000102432 | +0.0000068564 | 202% slower
Symfony2 Dumped - first route | 999 | 0.0000109241 | +0.0000075373 | 223% slower
Router - first route | 959 | 0.0000183090 | +0.0000149222 | 441% slower
Timber - first route | 979 | 0.0000270419 | +0.0000236551 | 698% slower
Symfony2 - first route | 998 | 0.0000518365 | +0.0000484496 | 1431% slower
Conformity - first route (1000 routes) | 996 | 0.0000644867 | +0.0000610999 | 1804% slower
Aura v2 - first route | 996 | 0.0000933562 | +0.0000899694 | 2656% slower
