<?php
namespace app\validators;

use app\repositories\UserRepository;


/**
 * Class RegisterUserValidator
 *
 * Uses for validate incoming data. If there it any fail it fills $this->validationErrors array.
 *
 * @package app\validators
 */
class RegisterUserValidator implements Validate
{
    public $validationErrors = [];
    private $fields;
    private $userRepository;
    private $rules = [
        'firstname'  => [
            'mask'  => '/^([0-9а-яА-Яa-zA-Z]{1})[-_\.0-9A-Za-zа-яА-Я]{1,}([-_\.0-9A-Za-zа-яА-Я])$/u',
            'min'   => 2,
            'max'   => 30
        ],
        'surname'  => [
            'mask'  => '/^([0-9а-яА-Яa-zA-Z]{1})[-_\.0-9A-Za-zа-яА-Я]{1,}([-_\.0-9A-Za-zа-яА-Я])$/u',
            'min'   => 2,
            'max'   => 30
        ],
        'email'  => [
            'mask' => '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u',
            'max'   => 20
        ],
        'password'  => [
            'min'   => 5,
            'max'   => 30
        ]
    ];

    /**
     * RegisterUserValidator constructor.
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
    $this->lengthTest('firstname');
    $this->regTest('firstname');
    $this->lengthTest('surname');
    $this->regTest('surname');
    $this->emailTest();
    $this->lengthTest('password');
    $this->passwordConfirmationTest();
    return $this->validationErrors;
    }

    /**
     * Test field on min and max length. Fills $this->validationErrors if there is a fail.
     *
     * @param $field
     */
    public function lengthTest ($field)
    {
        if (strlen($this->fields[$field]) < $this->rules[$field]['min']
            || strlen($field) > $this->rules[$field]['max']){
        $this->validationErrors[] = "Field '{$field}' must contain minimum of {$this->rules[$field]['min']} and a maximum of {$this->rules[$field]['max']} characters.";
        }
    }

    /**
     * Tests email by regular expression. Tests with min and max length values. Tests if there is same email at the database.
     */
    public function emailTest ()
    {
        if (
            preg_match($this->rules['email']['mask'], $this->fields['email']) == 0
            || strlen($this->fields['email']) > $this->rules['email']['max']){
            $this->validationErrors[] = "Incorrect email.";
        }
        if (!empty($this->userRepository->getUserByEmail($this->fields['email']))){
            $this->validationErrors[] = "This email is already in use.";
        }
    }

    /**
     * Compares fields 'password' and 'confirmationPassword'.
     */
    public function passwordConfirmationTest ()
    {
        if ($this->fields['password'] != $this->fields['passwordConfirmation']){
            $this->validationErrors[] = "Confirmation password and password do not match.";
        }
    }

    /**
     * Tests $field with regular expression mask which contains at $this->rules[$field]['mask'].
     *
     * @param $field
     */
    public function regTest ($field)
    {
        if (!empty($this->rules[$field]['mask'])){
           if(preg_match($this->rules[$field]['mask'], $this->fields[$field]) == 0){
               $this->validationErrors[] = "The field '{$field}' may consist only of Russian or English letters and symbols '_', '-', '.'";
           }
        }
    }
}

