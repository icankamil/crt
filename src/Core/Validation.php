<?php

namespace Core;

use Core\Classes\SessionData;
use Sirius\Validation\Validator;

abstract class Validation
{
    protected $validation;
    protected $validator;
    protected $request;
    public $errors = [];
    public $passed = true;

    public function validate()
    {
        $request = array_merge($this->request->request->all(), $this->request->files->all());
        $this->validator = new Validator();
        $this->makeRules($this->validation->rules());
        $this->passed = $this->validator->validate($request);

        if (!$this->passed) {
            $this->errors();
        }

        return $this;
    }

    public function makeRules($rules)
    {
        $validation = [];

        // generate rules
        foreach ($rules as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $name = count(explode('(', $value1)) > 0 ? explode('(', $value1)[0] : null;
                $optionsArr = count(explode('(', $value1)) > 1 ? explode('(', $value1)[1] : null;
                if (count(explode(':', str_replace(')', '', $optionsArr))) > 1) {
                    list($optionsName, $optionsValue) = explode(':', str_replace(')', '', $optionsArr));
                }
                $label = explode(':', $key)[1];
                array_push($validation, [
                    'selector' => $key,
                    'name' => $name,
                    'options' => isset($optionsName) && isset($optionsName) ? [$optionsName => $optionsValue] : null,
                    'message' => null,
                    'label' => $label
                ]);
            }
        }

        // make validation rules
        foreach ($validation as $key => $value) {
            $this->validator->add($value['selector'], $value['name'], $value['options'], null, $value['label']);
        }
    }

    public function errors()
    {
        $messages_validation = $this->validator->getMessages();
        $messages_custom = $this->validation->messages();

        $rules = $this->validation->rules();
        foreach ($rules as $key => $value) {
            foreach ($value as $key1 => $value1) {
                list($error_index_rules,) = explode(':', $key);
                $error_rules = $value1;
                $rules_options_arr = explode('(', $error_rules);
                if (count($rules_options_arr) > 1) {
                    list($rules_options,) = explode(')', $rules_options_arr[1]);
                } else {
                    list($rules_options,) = explode('(', $error_rules);
                }

                foreach ($messages_custom as $key3 => $value3) {
                    $msg_index_rules = explode('.', $key3)[0];
                    $msg_rules = isset(explode('.', $key3)[1]) ? explode('.', $key3)[1] : null;

                    if (isset($messages_validation[$error_index_rules])) {
                        foreach ($messages_validation[$error_index_rules][0]->getVariables() as $key4 => $value4) {
                            if (strpos($rules_options, $key4) !== false || strpos($messages_validation[$error_index_rules][0]->getTemplate(), $key4) !== false) {
                                $this->setErrorMessage($error_index_rules, $messages_validation[$error_index_rules][0]->getTemplate());
                                continue 1;
                            }
                        }
                    }
                    if ($error_index_rules == $msg_index_rules && $rules_options_arr[0] == $msg_rules) {
                        echo $error_index_rules . ' ' . $msg_index_rules . ' | ' . $rules_options_arr[0] . ' ' . $msg_rules . '<br>';
                        $this->setErrorMessage($error_index_rules, $value3);
                        continue 3;
                    }
                }
            }
        }

        // dd($messages_validation, $messages_custom, $this->errors, $this->validation->rules());

        SessionData::get()->getFlashBag()->set('errors', $this->errors);
    }

    public function setErrorMessage(string $index_rules, string $message)
    {
        $messages_validation = $this->validator->getMessages();
        foreach ($messages_validation as $key => $value) {
            if ($index_rules == $key) {
                $this->errors[$key] = $message;
                foreach ($value[0]->getVariables() as $key1 => $value1) {
                    $this->errors[$key] = str_replace('{' . $key1 . '}', $value1, $this->errors[$key]);
                }
            }
        }
    }

    abstract function rules();

    abstract function messages();
}
