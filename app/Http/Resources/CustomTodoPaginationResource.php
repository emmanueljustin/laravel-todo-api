<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomTodoPaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'todo_items' => $this->resource->items(),
            'page_data' => [
                'curr_page' => $this->resource->currentPage(),
                'prev_page' => $this->resource->currentPage() > 1 ? $this->resource->currentPage() - 1 : null,
                'next_page' => $this->resource->hasMorePages() ? $this->resource->currentPage() + 1 : null,
                'total_items' => $this->resource->total(),
            ],
        ];
    }
}
