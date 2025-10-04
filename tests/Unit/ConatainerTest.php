<?php

use Core\Container;

test('it can resolve something out of container', function () {
    // arrange
    $container = new Container();

    $container->bind('foo', fn() => 'bar');

    // act
    $result = $container->resolve('foo');


    // assert / expect
    expect($result)->toBe('bar');
});
