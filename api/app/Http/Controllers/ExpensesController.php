<?php

namespace App\Http\Controllers;

use App\Dto\ExpenseDto;
use App\Http\Requests\CreateExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Services\ExpenseService;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    protected ExpenseService $expenseService;

    public function __construct(ExpenseService $expenseService)
    {
        $this->expenseService = $expenseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $expenses = $this->expenseService->getAllByUser($user);
            return response()->json($expenses, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => $th->getCode(),
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateExpenseRequest $request)
    {
        try {
            $expenseDto = new ExpenseDto($request->all());
            $expense = $this->expenseService->store($expenseDto);
            return response()->json($expense, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => $th->getCode(),
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $expense = $this->expenseService->getById($id);
            $this->authorize('show', $expense);
            $expense = $this->expenseService->getById($id);
            return response()->json($expense, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => $th->getCode(),
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, $id)
    {
        try {
            $expense = $this->expenseService->getById((int)$id);
            $this->authorize('update', $expense);
            $expenseDto = new ExpenseDto($request->all());
            $this->expenseService->update($expenseDto, $id);
            return response()->json([
                'message' => 'Expense has been updated'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => $th->getCode(),
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $expense = $this->expenseService->getById($id);
            $this->authorize('destroy', $expense);
            $this->expenseService->destroy($id);
            return response()->json([
                'message' => 'Expense has been destroyed'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => $th->getCode(),
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
