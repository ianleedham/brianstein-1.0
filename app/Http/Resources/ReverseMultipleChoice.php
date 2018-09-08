<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReverseMultipleChoice extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'template' => 'reversed_multiple_choice',
            'prompt' => [
                'text' => [
                    'label' => 'English',
                    'kind'=> 'text',
                    'value' => $this->english,
                ],
                'audio' => [
                    'label' => 'audio',
                    'kind' => 'audio',
                    'value' => [
                        'normal' => $this->audio,
                        'slow' => ''
                    ],
                ],
            ],
            'answer' => [
                'label' => 'English',
                'kind' => 'text',
                'value' => $this->pronunciation,
                'alternatives' => '',

            ],
            //'choices' => Choices::collection($this->MultipleChoice),
        ];
    }
}
