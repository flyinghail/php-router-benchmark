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
Debian 8.6

PHP 7.0.11


Currently
---------

The current test creates 1000 routes, each with a randomized prefix and postfix, with 9 parameters each.

It was run with the [Pux](https://github.com/c9s/pux) and [R3](https://github.com/c9s/php-r3) extensions enabled.

An example route: `/9b37eef21e/{arg1}/{arg2}/{arg3}/{arg4}/{arg5}/{arg6}/{arg7}/{arg8}/{arg9}/bda37e9f9b`

## Worst-case matching
This benchmark matches the last route and unknown route. It generates a randomly prefixed and suffixed route in an attempt to thwart any optimization. 1,000 routes each with 9 arguments.

This benchmark consists of 22 tests. Each test is executed 1,000 times, the results pruned, and then averaged. Values that fall outside of 3 standard deviations of the mean are discarded.


Test Name | Results | Time | + Interval | Change
--------- | ------- | ---- | ---------- | ------
CogRoute - unknown route (1000 routes) | 995 | 0.0000029269 | +0.0000000000 | baseline
Conformity Learnable - last route (1000 routes) | 999 | 0.0000031961 | +0.0000002692 | 9% slower
Router - unknown route (1000 routes) | 992 | 0.0000036013 | +0.0000006744 | 23% slower
Timber - unknown route (1000 routes) | 998 | 0.0000042328 | +0.0000013059 | 45% slower
TreeRoute - unknown route (1000 routes) | 988 | 0.0000043832 | +0.0000014563 | 50% slower
TreeRoute - last route (1000 routes) | 986 | 0.0000085110 | +0.0000055841 | 191% slower
CogRoute - last route (1000 routes) | 989 | 0.0000086211 | +0.0000056943 | 195% slower
Conformity - unknown route (1000 routes) | 999 | 0.0000097136 | +0.0000067867 | 232% slower
Conformity Learnable - unknown route (1000 routes) | 983 | 0.0000118334 | +0.0000089065 | 304% slower
Router - last route (1000 routes) | 978 | 0.0000173980 | +0.0000144711 | 494% slower
Timber - last route (1000 routes) | 999 | 0.0000218311 | +0.0000189043 | 646% slower
FastRoute - unknown route (1000 routes) | 977 | 0.0000683842 | +0.0000654573 | 2236% slower
Symfony2 Dumped - unknown route (1000 routes) | 989 | 0.0000992713 | +0.0000963444 | 3292% slower
FastRoute - last route (1000 routes) | 999 | 0.0001272370 | +0.0001243101 | 4247% slower
Symfony2 Dumped - last route (1000 routes) | 978 | 0.0001886347 | +0.0001857078 | 6345% slower
Symfony2 - unknown route (1000 routes) | 970 | 0.0004959465 | +0.0004930196 | 16845% slower
Pux PHP - unknown route (1000 routes) | 998 | 0.0006005759 | +0.0005976490 | 20419% slower
Symfony2 - last route (1000 routes) | 998 | 0.0006724694 | +0.0006695425 | 22876% slower
Pux PHP - last route (1000 routes) | 999 | 0.0007016196 | +0.0006986927 | 23872% slower
Conformity - last route (1000 routes) | 987 | 0.0026811942 | +0.0026782673 | 91506% slower
Aura v2 - unknown route (1000 routes) | 985 | 0.0371142838 | +0.0371113569 | 1267947% slower
Aura v2 - last route (1000 routes) | 996 | 0.0381865379 | +0.0381836110 | 1304582% slower


## First route matching
This benchmark tests how quickly each router can match the first route. 1,000 routes each with 9 arguments.

This benchmark consists of 11 tests. Each test is executed 1,000 times, the results pruned, and then averaged. Values that fall outside of 3 standard deviations of the mean are discarded.


Test Name | Results | Time | + Interval | Change
--------- | ------- | ---- | ---------- | ------
Conformity Learnable - first route (1000 routes) | 999 | 0.0000031825 | +0.0000000000 | baseline
FastRoute - first route | 999 | 0.0000063230 | +0.0000031405 | 99% slower
Pux PHP - first route | 998 | 0.0000066084 | +0.0000034259 | 108% slower
CogRoute - first route | 987 | 0.0000085575 | +0.0000053750 | 169% slower
TreeRoute - first route | 987 | 0.0000087439 | +0.0000055615 | 175% slower
Symfony2 Dumped - first route | 996 | 0.0000097455 | +0.0000065630 | 206% slower
Router - first route | 974 | 0.0000175020 | +0.0000143195 | 450% slower
Timber - first route | 976 | 0.0000211342 | +0.0000179518 | 564% slower
Conformity - first route (1000 routes) | 984 | 0.0000497515 | +0.0000465690 | 1463% slower
Symfony2 - first route | 993 | 0.0000571741 | +0.0000539917 | 1697% slower
Aura v2 - first route | 997 | 0.0000962106 | +0.0000930281 | 2923% slowe