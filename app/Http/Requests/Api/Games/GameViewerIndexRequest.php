<?php

namespace App\Http\Requests\Api\Games;

use App\Helpers\DateHelper;
use App\Http\Requests\Api\Contracts\ApiBaseRequest;

class GameViewerIndexRequest extends ApiBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'games' => 'required|array',
            'games.*' => 'int',
            'created.*' => 'array',
            'created.from' => [
                DateHelper::apiDateFormat(),
            ],
            'created.to' => [
                DateHelper::apiDateFormat(),
                'after:created.from',
            ],
        ];
    }
}
