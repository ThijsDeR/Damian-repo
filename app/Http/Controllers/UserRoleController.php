<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $userRoles = UserRole::all();

        return view('userroles.index', compact('userRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        UserRole::create($this->validateUpdateUserRole($request));

        return redirect(route('userroles.index'))->with('success', 'User created successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('userroles.create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $user = UserRole::find($id);

        return view('userroles.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = UserRole::find($id);

        return view('userroles.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = UserRole::find($id);
        $user->update($this->validateUpdateUserRole($request));

        return redirect()->route('userroles.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        UserRole::find($id)->delete();

        return redirect()->route('userroles.index')
            ->with('success', 'User deleted successfully');
    }

    public function validateUserRole($request)
    {
        $request->validate([
            'user_id' => "required|integer",
            "super_admin" => "nullable|boolean",
            "admin" => "nullable|boolean",
            "truck_driver" => "nullable|boolean",
            "sales" => "nullable|boolean",
        ]);
    }

    public function validateUpdateUserRole($request)
    {
        $request->validate([
            "super_admin" => "nullable|boolean",
            "admin" => "nullable|boolean",
            "truck_driver" => "nullable|boolean",
            "sales" => "nullable|boolean",
        ]);
    }
}
