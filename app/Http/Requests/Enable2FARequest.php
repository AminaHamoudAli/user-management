<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Enable2FARequest extends FormRequest
{
    public function authorize()
    {
        return true; // المستخدم مسموح له بتفعيل 2FA
    }

    public function rules()
    {
        return [
            'password' => 'required|string', // إعادة التحقق من كلمة المرور قبل تمكين 2FA
        ];
    }
}
