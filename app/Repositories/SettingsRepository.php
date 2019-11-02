<?php
namespace App\Repositories;

use App\Models\Settings as Model;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */
class SettingsRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить все настройки
     *
     */
    public function getAllSettings()
    {
        $settingsAll = collect(
            $this->startConditions()
                ->toBase()
                ->get()
            );

        $settings['discountMax'] = $settingsAll
            ->where('group_name', 'discount')
            ->where('element_name', 'max')
            ->first();

        $settings['discountMin'] = $settingsAll
            ->where('group_name', 'discount')
            ->where('element_name', 'min')
            ->first();

        $settings['rooms'] = $settingsAll
            ->where('group_name', 'rooms');

        $settings['amenities'] = $settingsAll
            ->where('group_name', 'amenities');

        $settings['hotels'] = $settingsAll
            ->where('group_name', 'hotels');

        return $settings;
    }

    /**
     * Получить стоимость комнаты (в том числе и удаленные)
     *
     * @param string|null $roomType
     *
     */
    public function getRoomCost($roomType)
    {
        $roomCost = $this->startConditions()
            ->withTrashed()
            ->where('element_name', $roomType)
            ->first()
            ->value;

        return $roomCost;
    }

    /**
     * Получить список отелей
     *
     */
    public function getSetting($id)
    {
        $result = $this->startConditions()
            ->find($id);

        return $result;
    }

    /**
     * Получить список отелей
     *
     */
    public function getSettingsHotels()
    {
        $result = $this->startConditions()
            ->where('group_name', 'hotels')
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Получить список удаленных услуг
     *
     */
    public function getSettingsTrashed($item)
    {
        $trashed['rooms'] = $this->startConditions()
            ->onlyTrashed()
            ->where('element_name', $item->room_type)
            ->get()
            ->first();

        $trashed['hotels'] = $this->startConditions()
            ->onlyTrashed()
            ->where('value', $item->hotel_name)
            ->get()
            ->first();

        $trashed['amenities'] = $this->startConditions()
            ->onlyTrashed()
            ->whereIn('element_name', array_flip($item->amenities))
            ->get()
            ->toArray();

        return $trashed;
    }
}
