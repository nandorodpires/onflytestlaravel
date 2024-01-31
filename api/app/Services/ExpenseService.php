<?php

namespace App\Services;

use App\Dto\ExpenseDto;
use App\Jobs\NotifyUserNewExpenseJob;
use App\Models\User;
use App\Repositories\ExpenseRepository;
use App\Repositories\UserRepository;

class ExpenseService
{
    protected ExpenseRepository $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function getAllbyUser(User $user) {
        return $this->expenseRepository->getAllByUser($user);
    }

    public function store(ExpenseDto $dto)
    {
        $expense = $this->expenseRepository->create($dto);
        $userRepository = new UserRepository();
        $user = $userRepository->getById($dto->user_id);
        NotifyUserNewExpenseJob::dispatch($user, $expense);
        return $expense;
    }

    public function getById(int $id)
    {
        return $this->expenseRepository->getById($id);
    }

    public function update(ExpenseDto $dto, int $id)
    {
        return $this->expenseRepository->update($dto, $id);
    }

    public function destroy(int $id) {
        return $this->expenseRepository->destroy($id);
    }
}
