<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'amount'=>number_format($this->amount/100,2),
            'transaction_date'=>Carbon::create($this->transaction_date)->format('m/d/Y'),
            'description'=>$this->description,
            'created_at'=>$this->created_at
        ];
    }
}
