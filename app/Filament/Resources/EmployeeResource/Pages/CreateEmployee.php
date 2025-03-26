<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Models\User;
use Filament\Actions;
use Spatie\Permission\Models\Role;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\EmployeeResource;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     // إنشاء الموظف وإعطاؤه الدور المحدد
    //     $employee = User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'phone' => $data['phone'],
    //         'password' => bcrypt($data['password']),
    //     ]);

    //     $role = Role::find($data['role_id']);
    //     if ($role) {
    //         $employee->assignRole($role);
    //     }

    //     return $employee->toArray();
    // }
}
