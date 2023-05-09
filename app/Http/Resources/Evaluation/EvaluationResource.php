<?php

namespace App\Http\Resources\Evaluation;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'comentarios' => $this->comment,
            'estrelas'    => $this->stars,
            'date'        => Carbon::make($this->created_at)->format('Y-m-d')
        ];
    }
}
