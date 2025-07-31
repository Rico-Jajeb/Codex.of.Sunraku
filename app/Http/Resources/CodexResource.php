<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CodexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'codex_name' => $this->codex_name,
            'language' => $this->language,
            'framework' => $this->framework,
            'tags' => $this->tags,
            'diffuclt_level' => $this->diffuclt_level,
            'content' => $this->content,
            'code_snippet' => $this->code_snippet,
            'instructions' => $this->instructions,
            'output' => $this->output,
            'image_url' => $this->image_url,
            'category_name' => $this->category_name,

        ];
    }
}
