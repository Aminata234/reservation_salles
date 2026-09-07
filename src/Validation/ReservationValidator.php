<?php

namespace App\Validation;

use Respect\Validation\Validator as v;

final class ReservationValidator implements ValidatorInterface
{
    public function validate(array $data): ValidationResult
    {
        $errors = [];

        $rules = [
            'salle_id' => v::intVal()->positive(),
            'responsable' => v::stringType()->length(2, 120),
            'email' => v::email(),
            'motif' => v::stringType()->length(5, 255),
            'date_debut' => v::date(),
            'date_fin' => v::date(),
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