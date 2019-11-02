<?php

namespace App\Http\Controllers\Hotel\Admin;

use App\Http\Controllers\Hotel\BaseController as GuestBaseController;

/**
 * Базовый контроллер для всех контроллеров управления
 * Отелем в панели администратора
 *
 * Должен быть родителем всех контроллеров управления Отелем
 */
abstract class BaseController extends GuestBaseController
{
    /**
     * BaseController constructor
     */
    public function __construct() {
        // Инициализация общих моментов для админки
    }
}
