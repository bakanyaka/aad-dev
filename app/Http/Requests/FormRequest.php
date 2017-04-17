<?php


namespace App\Http\Requests;


use Illuminate\Http\JsonResponse;

class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return new JsonResponse(['errors' => $errors], 422);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }


}