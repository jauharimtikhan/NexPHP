<?php

namespace System\FormValidation;

class Validator
{
    private $data;
    private $rules;
    private array $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate()
    {

        foreach ($this->rules as $field => $rules) {
            $rules = explode('|', $rules);
            foreach ($rules as $rule) {
                $ruleName = $rule;
                $parameters = [];
                if (strpos($rule, ':') !== false) {
                    list($ruleName, $paramString) = explode(':', $rule);
                    $parameters = explode(',', $paramString);
                }
                $method = "validate" . ucfirst($ruleName);
                if (method_exists($this, $method)) {
                    if (count($rules) >= 1) {
                        $this->$method($field, ...$parameters);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    public function errors()
    {
        $errors = $this->errors;
        if (is_array($errors)) {
            save_old_input($this->data);
            return  $errors;
        } else {
            clear_old_input();
            return [];
        }
    }

    private function validateRequired($field)
    {
        if (empty($this->data[$field])) {
            $this->addError($field, "{$field} is required.");
        }
    }

    private function addError($field, $message)
    {

        $this->errors[$field][] = $message;
    }

    private function validateEmail($field)
    {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "{$field} must be a valid email address.");
        }
    }

    private function validateMin($field, $min)
    {
        if (strlen($this->data[$field]) < $min) {
            $this->addError($field, "{$field} must be at least {$min} characters.");
        }
    }

    private function validateMax($field, $max)
    {
        if (strlen($this->data[$field]) > $max) {
            $this->addError($field, "{$field} must be no more than {$max} characters.");
        }
    }
}
