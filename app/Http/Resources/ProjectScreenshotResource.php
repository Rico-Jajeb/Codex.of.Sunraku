<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectScreenshotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'img'        => $this->img,
            'features'   => $this->features,
            'project_id' => $this->project_id,
            'image_url2' => $this->image_url2,
        ];
    }
}
