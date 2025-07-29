<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'proj_name'        => $this->proj_name,
            'proj_description' => $this->proj_description,
            'language'         => $this->language,
            'framework'        => $this->framework,

            'thumbnail'        => $this->thumbnail,
            'github_url'       => $this->github_url,
            'live_url'         => $this->live_url,
            'status'           => $this->status,
            'img'              => $this->img,
            'image_url'        => $this->image_url,
            'highlight'        => $this->highlight,

        ];
    }
}
