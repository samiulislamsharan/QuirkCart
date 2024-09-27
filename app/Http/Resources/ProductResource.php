<?php

namespace App\Http\Resources;

use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => CurrencyHelper::formatBDT($this->price),
            'quantity' => $this->quantity,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'product_images' => $this->whenLoaded(
                'product_images',
                function () {
                    return ProductImageResource::collection($this->product_images);
                }
            ),
            'category_id' => $this->category_id,
            'category' => $this->whenLoaded(
                'category',
                function () {
                    return new CategoryResource($this->category);
                }
            ),
            'brand_id' => $this->brand_id,
            'brand' => $this->whenLoaded(
                'brand',
                function () {
                    return new BrandResource($this->brand);
                }
            ),
        ];
    }
}