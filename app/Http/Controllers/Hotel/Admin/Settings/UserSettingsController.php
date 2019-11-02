<?php

namespace App\Http\Controllers\Hotel\Admin\Settings;

use App\Http\Controllers\Hotel\Admin\BaseController as AdminController;
use App\Http\Requests\Settings\BaseRequest as SettingsRequest;
use App\Models\User;
use App\Repositories\SettingsRepository;
use App\Repositories\UserRepository;

class UserSettingsController extends AdminController
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct()
    {
        $this->settingsRepository = app(SettingsRepository::class);
        $this->userRepository = app(UserRepository::class);
    }

    public function store(SettingsRequest $request)
    {
        $item['name'] = $request->name;
        $item['email'] = $request->email;
        $item['role'] = $request->role;
        if ($request->password != null) {
            $item['password'] = bcrypt($request->password);
        }

        $result = User::create($item);

        if ($result) {
            return redirect()
                ->route('admin.settings.index')
                ->with(['message' => ['success' => 'Успешно сохранено']]);
        } else {
            return back()
                ->withErrors(['message' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $item = $this->userRepository->getUser($id);

        return view('hotel.admin.settings.user_edit', compact('item'));
    }

    public function update(SettingsRequest $request, $id)
    {
        $item = $this->userRepository->getUser($id);

        $item->name = $request->name;
        $item->email = $request->email;
        $item->role = $request->role;
        if ($request->password != null) {
            $item->password = bcrypt($request->password);
        }
        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.settings.index')
                ->with(['message' => ['success' => 'Успешно сохранено']]);
        } else {
            return back()
                ->withErrors(['message' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $result = User::destroy($id);

        if ($result) {
            return redirect()
                ->route('admin.settings.index')
                ->with([
                    'message' => ['success' => "Запись id[$id] удалена"],
                ]);
        } else {
            return back()->withErrors(['message' => 'Ошибка удаления']);
        }
    }
}
