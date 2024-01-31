<?php

namespace App\Repositories;

use App\Dto\ExpenseDto;
use App\Models\Expense;
use App\Models\User;

class ExpenseRepository
{
    public function getAllByUser(User $user)
    {
        return Expense::where('user_id', $user->id)->orderBy('date')->get();
    }

    public function create(ExpenseDto $data): Expense {
        return Expense::create($data->toArray());
    }

    public function getById(int $id): Expense
    {
        return Expense::findOrFail($id);
    }

    public function update(ExpenseDto $data, int $id)
    {
        return Expense::findOrFail($id)->update($data->toArray());
    }

    public function destroy(int $id)
    {
        return Expense::findOrFail($id)->delete();
    }
}
