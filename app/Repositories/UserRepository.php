<?php
namespace App\Repositories;

use App\Models\User as Model;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */
class UserRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить список всех пользователей
     *
     */
    public function getAllUsers()
    {
        $result = $this->startConditions()
            ->all();

        return $result;
    }

    /**
     * Получить одного пользователя
     *
     */
    public function getUser($id)
    {
        $result = $this->startConditions()
            ->find($id);

        return $result;
    }
}
