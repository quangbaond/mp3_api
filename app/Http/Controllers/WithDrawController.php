<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithDrawController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $withDraws = \App\Models\WithDraw::query()->where('user_id', auth()->id())->get();
        return $this->sendResponse($withDraws, 'Get with draw success');
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'amount' => 'required|numeric',
            'bank_branch' => 'required|max:255',
            'bank_account_number' => 'required|max:255',
            'bank_account_name' => 'required|max:255',
        ]);
        $withDraw = \App\Models\WithDraw::query()->create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'bank_branch' => $request->bank_branch,
            'bank_account_number' => $request->bank_account_number,
            'bank_account_name' => $request->bank_account_name,
        ]);

        $user = auth()->user();
        $user->balance = $user->balance - $request->amount;
        $user->save();
        return $this->sendResponse($withDraw, 'Create with draw success');
    }

    public function vote(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);
        $user = auth()->user();
        if ($user->balance < $request->amount) {
            return $this->sendResponse(null, 'Balance not enough', 422);
        }
        $user->balance = $user->balance - $request->amount;
        $user->save();
        return $this->sendResponse(null, 'Vote success', 200);
    }
}
