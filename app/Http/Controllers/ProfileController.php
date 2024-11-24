<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    // Método para trocar a senha do usuário
public function changePassword(Request $request): RedirectResponse
{
    // Validação do formulário
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'new_password' => ['required', 'min:8', 'confirmed'],
    ]);

    // Recupera o usuário autenticado
    $user = $request->user();

    // Atualiza a senha
    $user->password = bcrypt($request->new_password);
    $user->save();

    // Retorna para o perfil com uma mensagem de sucesso
    return Redirect::route('profile.edit')->with('status', 'password-updated');
}

}
