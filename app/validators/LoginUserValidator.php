<?php
namespace app\validators;

use app\repositories\UserRepository;

/**
 * Class LoginUserValidator
 *
 * Uses for validate incoming data. If there it any fail it fills $this->validationErrors array.
 *
 * @package app\validators
 */
class LoginUserValidator implements Validate
{
    public $validationErrors = [];
    private $fields;
    private $userRepository;

    /**
     * LoginUserValidator constructor.
     *
     * Fills $this->fields with incoming data.
     * Creates object of UserRepository.
     *
     * @param array $fields
     */
    public function __construct(array $fields)
    {
    $this->fields = $fields;
    $this->userRepository = new UserRepository();
    }

    /**
     * Method which implements all methods for final validation.
     *
     * @return array
     */
    public function validate()
    {
        $userParams = $this->userRepository->getUserByEmail($this->fields['email']);
        if (empty($userParams) || $userParams[0]['password'] != $this->fields['password']){
            $this->validationErrors[] = "Incorrect email or password";
        }
        return $this->validationErrors;
    }
}

