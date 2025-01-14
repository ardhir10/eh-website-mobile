<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Role',
            'Status', 
            'Joined Date',
            'ID'
        ];
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->role ?? 'user',
            'active',
            $user->created_at->format('Y-m-d'),
            $user->id
        ];
    }
} 