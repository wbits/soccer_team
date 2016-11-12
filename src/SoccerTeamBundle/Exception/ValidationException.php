<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Exception;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ValidationException extends UnprocessableEntityHttpException
{
    /**
     * @var array
     */
    private $errors;

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     *
     * @return ValidationException
     */
    public function setErrors(array $errors): ValidationException
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return ! empty($this->errors);
    }
}
