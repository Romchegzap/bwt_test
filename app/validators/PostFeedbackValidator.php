<?php
namespace app\validators;

use app\repositories\UserRepository;

/**
 * Class PostFeedbackValidator
 *
 * Uses for validate incoming data. If there it any fail it fills $this->validationErrors array.
 *
 * @package app\validators
 */
class PostFeedbackValidator implements Validate
{
    public $validationErrors = [];
    private $fields;
    private $userRepository;
    private $rules = [
        'name'  => [
            'mask'  => '/^([0-9а-яА-Яa-zA-Z]{1})[-_\.0-9A-Za-zа-яА-Я]{0,}([-_\.0-9A-Za-zа-яА-Я])$/u',
            'min'   => 2,
            'max'   => 30
        ],
        'email'  => [
            'mask' => '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u',
            'max'   => 20
        ],
        'message'  => [
            'min'   => 10,
            'max'   => 1000
        ]
    ];

    /**
     * PostFeedbackValidator constructor.
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
        $this->lengthTest('name');
        $this->regTest('name');
        $this->emailTest();
        $this->lengthTest('message');
        return $this->validationErrors;
    }

    /**
     * Test field on min and max length. Fills $this->validationErrors if there is a fail.
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
     * Testing $this->fields['email'] for min and max string length.
     */
    public function emailTest ()
    {
        if (
            preg_match($this->rules['email']['mask'], $this->fields['email']) == 0
            || strlen($this->fields['email']) > $this->rules['email']['max']){
            $this->validationErrors[] = "Incorrect email.";
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