<?php

use Core\Validator;

it('Validates a string', function () {
    expect(Validator::string('string'))->toBeTrue();
    expect(Validator::string(''))->toBeFalse();
});

it('validates a string with a minimum length', function () {
    expect(Validator::string('string', 6))->toBeTrue();
    expect(Validator::string('string', 7))->toBeFalse();
});

it('validates an email', function () {
    expect(Validator::email('notAnEmail'))->toBeFalse();
    expect(Validator::email('test@example.com'))->toBeTrue();
});
