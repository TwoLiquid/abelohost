<?php

namespace App\Http\Requests\Dashboard\Item;

use App\Http\Requests\Dashboard\BaseRequest;

/**
 * Class UpdateRequest
 *
 * @package App\Http\Requests\Dashboard\Item
 */
class UpdateRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'name'          => 'required|string|unique:items,name,' . $this->route('id'),
            'description'   => 'string|nullable',
            'price'         => 'required|integer',
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'name.required'         => 'Необходимо ввести название товара.',
            'name.string'           => 'Название товара должно быть строкой.',
            'name.unique'           => 'Товар с таким названием уже существует.',
            'description.string'    => 'Описание товара должно быть строкой.',
            'price.required'        => 'Необходимо ввести цену товара.',
            'price.integer'         => 'Цена товара должна быть целым числом.'
        ];
    }
}
