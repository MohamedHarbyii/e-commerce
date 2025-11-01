<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            // لعرض مسار الصورة الكامل
            'image_url'   => $this->image ? url('storage/' . $this->image) : null,
            'status'      => $this->status,
            // لعرض القسم الأب إذا كان موجوداً
            'parent'      => new CategoryResource($this->whenLoaded('parent')),
            'children'    => CategoryResource::collection($this->whenLoaded('children')),
            'created_at'  => $this->created_at->toDateTimeString(),
        ];
    }
}
