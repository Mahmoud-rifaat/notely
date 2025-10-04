<?php

namespace Core;

class ValidationException extends \Exception
{
    public readonly array $errors;
    public readonly array $old;

    public static function throw($errors, $old)
    {
        $instance = new ValidationException();
        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }


    public function old()
    {
        return $this->old;
    }
}
