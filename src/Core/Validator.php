<?php
namespace App\Core;

class Validator {
    // Tableau pour stocker les erreurs de validation
    private array $errors = [];

    /**
     * Valide les données en fonction des règles spécifiées.
     *
     * @param array $data Les données à valider.
     * @param array $rules Les règles de validation à appliquer.
     * @return array Les erreurs de validation, s'il y en a.
     */
    public function validate(array $data, array $rules) {
        // Parcourt chaque champ et applique les règles de validation
        foreach ($rules as $field => $ruleSet) {
            foreach ($ruleSet as $rule) {
                // Applique chaque règle au champ correspondant
                $this->applyRule($field, $data[$field] ?? null, $rule);
            }
        }
        return $this->errors;
    }

    /**
     * Applique une règle de validation à un champ donné.
     *
     * @param string $field Le nom du champ à valider.
     * @param mixed $value La valeur du champ.
     * @param string $rule La règle de validation à appliquer.
     */
    private function applyRule(string $field, $value, string $rule) {
        // Vérifie si le champ est requis et vide
        if ($rule === 'required' && empty($value)) {
            $this->errors[$field][] = "Le champ $field est requis.";
        }
        // Vérifie si le champ doit être une adresse email valide
        elseif ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "Le champ $field doit être une adresse email valide.";
        }
        // Vérifie si le champ respecte une longueur minimale
        elseif (str_starts_with($rule, 'min:')) {
            $min = explode(':', $rule)[1];
            if (strlen($value) < $min) {
                $this->errors[$field][] = "Le champ $field doit contenir au moins $min caractères.";
            }
        }
        // Vérifie si le champ respecte une longueur maximale
        elseif (str_starts_with($rule, 'max:')) {
            $max = explode(':', $rule)[1];
            if (strlen($value) > $max) {
                $this->errors[$field][] = "Le champ $field ne doit pas dépasser $max caractères.";
            }
        }
    }

    /**
     * Vérifie s'il y a des erreurs de validation.
     *
     * @return bool True s'il y a des erreurs, sinon False.
     */
    public function hasErrors() {
        return !empty($this->errors);
    }

    /**
     * Retourne les erreurs de validation.
     *
     * @return array Les erreurs de validation.
     */
    public function getErrors() {
        return $this->errors;
    }
}
