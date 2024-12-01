<?php

namespace App\Http\Controllers;

use App\Data\LoginUserData;
use App\Data\RegisterUserData;
use App\Data\UserData;
use App\Models\User;
use App\Services\PostService;
use App\Services\UserService;
use http\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\LaravelData\DataCollection;

class UsersController extends Controller
{
    public function __construct(private readonly UserService $userService,private readonly PostService $postService )
    {
    }

    public function register(): View
    {
        $title = "Register";
        return view('auth.register', compact('title'));
    }

    public function registerUser(RegisterUserData $registerData)
    {
        $user = User::create([
            'name' => $registerData->name,
            'email' => $registerData->email,
            'password' => Hash::make($registerData->password),
        ]);
        Auth::login($user);
        return redirect()->route('home');
    }

    public function login(): View
    {
        $title = "Login";
        return view('auth.login', compact('title'));
    }

    public function loginUser(LoginUserData $loginUserData)
    {
        if (Auth::attempt($loginUserData->toArray())) {

            return redirect()->route('home');
        }
        session()->flash('error', 'Невірний емейл або пароль.');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function index()
    {
        $posts = $this->postService->show();
        return view('user.index', compact('posts'));
    }

    public function friends()
    {
        $title = "Friends";
        $friends = $this->userService->getFriends();
        $potentialFriends = $this->userService->getPotentialFriends($friends);

        return view('user.friends', compact('title', 'friends', 'potentialFriends'));
    }

    public function addFried(User $user)
    {
        $this->userService->addFried($user);
        return redirect()->back()->with(['success' => 'good']);
    }
}
