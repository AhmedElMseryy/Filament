<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions;
use Spatie\Permission\Models\Role;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\EmployeeResource;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $employee = $this->record;

        $employee->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        if (isset($data['role_id'])) {
            $role = Role::find($data['role_id']);
            if ($role) {
                $employee->syncRoles([$role]);
            }
        }

        return $employee->toArray();
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
