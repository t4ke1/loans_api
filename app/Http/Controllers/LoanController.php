<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoanController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'borrower_name' => 'required|string|max:20',
            'borrow_volume' => 'required|integer',
            'borrow_date' => 'required|date',
            'monthly_payment' => 'required|integer',
        ]);

        $loan = Loan::create($request->all());

        return response()->json($loan, 201); // 201 - Created
    }

    public function show($id): JsonResponse
    {
        $loan = Loan::findOrFail($id);

        return response()->json($loan, 200);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $this->validate($request, [
            'borrower_name' => 'required|string|max:20',
            'borrow_volume' => 'required|integer',
            'borrow_date' => 'required|date',
            'monthly_payment' => 'required|integer',
        ]);

        $loan = Loan::findOrFail($id);
        $loan->update($request->all());

        return response()->json($loan, 200);
    }

    public function delete($id): JsonResponse
    {
        Loan::findOrFail($id)->delete();

        return response()->json(null, 204);
    }

    public function loanList(Request $request): JsonResponse
    {
        $query = Loan::query();

        // Применяем фильтры, если они есть
        if ($request->has('borrow_volume')) {
            $query->orderBy('borrow_volume', 'asc');
        }
        if ($request->has('created_at')) {
            $query->orderBy('created_at', 'asc');
        }
        $loans = $query->get();

        return response()->json($query->get(), 200);
    }
}
