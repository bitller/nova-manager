<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;

/**
 * Base controller.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class BaseController extends Controller {

    /**
     * @var array
     */
    protected $validatedFields = [];

    /**
     * BaseController constructor.
     */
    public function __construct() {
        // Share user data across all views, only if user is logged in
        if (Auth::check()) {
            view()->share('user', Auth::user());
        }
    }


    /**
     * Custom format for validation errors.
     *
     * @param Validator $validator
     * @return array
     */
    protected function formatValidationErrors(Validator $validator) {
        $messages = $validator->messages();
        $errors = [];
        foreach ($this->validatedFields as $field) {
            if ($messages->has($field)) {
                $errors[$field] = $messages->first($field);
            }
        }
        return [
            'success' => false,
            'errors' => $errors
        ];
    }
}