<?php

namespace App\Validation;

use Respect\Validation\Validator as v;

final class SalleValidator implements ValidatorInterface
{
    public function validate(array $data): ValidationResult
    {
        $errors = [];

        $rules = [
            'nom' => v::stringType()->length(2, 100),
            'batiment' => v::stringType()->length(2, 100),
            'capacite' => v::intVal()->between(1, 1000),
            'type' => v::in([
                'cours',
                'informatique',
                'laboratoire',
                'amphitheatre',
                'reunion',
            ]),
            'active' => v::boolType(),
        ];

        foreach ($rules as $field => $rule) {
            if (!array_key_exists($field, $data)) {
                $errors[$field] = 'Ce champ est obligatoire.';
                continue;
            }

            if (!$rule->validate($data[$field])) {
                $errors[$field] = 'La valeur de ce champ est invalide.';
            }
        }

        return new ValidationResult(
            empty($errors),
            $errors,
            $data
        );
    }
}