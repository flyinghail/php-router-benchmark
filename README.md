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
Debian 9.3

PHP 7.2.0


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
Conformity Learnable - last route (1000 routes) | 999 | 0.0000011355 | +0.0000000000 | baseline
CogRoute - unknown route (1000 routes) | 996 | 0.0000013262 | +0.0000001906 | 17% slower
Router - unknown route (1000 routes) | 995 | 0.0000015498 | +0.0000004143 | 36% slower
Timber - unknown route (1000 routes) | 999 | 0.0000021162 | +0.0000009806 | 86% slower
TreeRoute - unknown route (1000 routes) | 996 | 0.0000023260 | +0.0000011905 | 105% slower
CogRoute - last route (1000 routes) | 994 | 0.0000047940 | +0.0000036585 | 322% slower
Conformity - unknown route (1000 routes) | 999 | 0.0000050794 | +0.0000039438 | 347% slower
Conformity Learnable - unknown route (1000 routes) | 988 | 0.0000064376 | +0.0000053020 | 467% slower
TreeRoute - last route (1000 routes) | 998 | 0.0000064531 | +0.0000053175 | 468% slower
Symfony2 Dumped - unknown route (1000 routes) | 994 | 0.0000080477 | +0.0000069122 | 609% slower
Router - last route (1000 routes) | 996 | 0.0000114271 | +0.0000102916 | 906% slower
Symfony2 Dumped - last route (1000 routes) | 999 | 0.0000115121 | +0.0000103766 | 914% slower
Timber - last route (1000 routes) | 998 | 0.0000187796 | +0.0000176441 | 1554% slower
FastRoute - unknown route (1000 routes) | 995 | 0.0000720120 | +0.0000708765 | 6242% slower
FastRoute - last route (1000 routes) | 999 | 0.0001327058 | +0.0001315703 | 11586% slower
Symfony2 - unknown route (1000 routes) | 998 | 0.0004860230 | +0.0004848874 | 42701% slower
Symfony2 - last route (1000 routes) | 999 | 0.0005589923 | +0.0005578567 | 49127% slower
Pux PHP - unknown route (1000 routes) | 997 | 0.0006175558 | +0.0006164202 | 54284% slower
Pux PHP - last route (1000 routes) | 999 | 0.0008010306 | +0.0007998950 | 70441% slower
Conformity - last route (1000 routes) | 999 | 0.0025557916 | +0.0025546560 | 224971% slower
Aura v2 - unknown route (1000 routes) | 976 | 0.0363397207 | +0.0363385852 | 3200087% slower
Aura v2 - last route (1000 routes) | 981 | 0.0363658337 | +0.0363646982 | 3202386% slower


## First route matching
This benchmark tests how quickly each router can match the first route. 1,000 routes each with 9 arguments.

This benchmark consists of 11 tests. Each test is executed 1,000 times, the results pruned, and then averaged. Values that fall outside of 3 standard deviations of the mean are discarded.


Test Name | Results | Time | + Interval | Change
--------- | ------- | ---- | ---------- | ------
Conformity Learnable - first route (1000 routes) | 998 | 0.0000012578 | +0.0000000000 | baseline
Pux PHP - first route | 998 | 0.0000039592 | +0.0000027014 | 215% slower
FastRoute - first route | 999 | 0.0000043782 | +0.0000031203 | 248% slower
CogRoute - first route | 993 | 0.0000049093 | +0.0000036515 | 290% slower
TreeRoute - first route | 993 | 0.0000067271 | +0.0000054693 | 435% slower
Symfony2 Dumped - first route | 997 | 0.0000089353 | +0.0000076775 | 610% slower
Router - first route | 992 | 0.0000123810 | +0.0000111232 | 884% slower
Timber - first route | 992 | 0.0000217997 | +0.0000205419 | 1633% slower
Symfony2 - first route | 999 | 0.0000454079 | +0.0000441501 | 3510% slower
Conformity - first route (1000 routes) | 990 | 0.0000467720 | +0.0000455142 | 3619% slower
Aura v2 - first route | 999 | 0.0000852882 | +0.0000840304 | 6681% slower
