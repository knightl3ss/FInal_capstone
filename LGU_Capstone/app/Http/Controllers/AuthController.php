<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'birthday' => 'required|date|before:today',
            'status' => 'required|in:active,pending,blocked',
            'address_street' => 'required|string|max:255',
            'address_city' => 'required|string|max:255',
            'address_state' => 'required|string|max:255',
            'address_postal_code' => 'required|string|max:10',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,manager',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string|regex:/^[0-9]{10,15}$/',
            'gender' => 'required|string|in:male,female,other',
            'extension_name' => 'nullable|string|max:10',
            'employee_id' => 'required|string|unique:users,employee_id|max:20',
        ]);

        // Add profile picture validation
        if ($request->hasFile('profile_picture')) {
            $validator->addRules([
                'profile_picture' => 'image|mimes:jpeg,png,gif|max:5120', // 5MB max
            ]);
        }

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle profile picture upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $filename = uniqid() . '.' . $profilePicture->getClientOriginalExtension();
            $path = $profilePicture->storeAs('profile_pictures', $filename, 'public');
            $profilePicturePath = 'storage/' . $path;

            // Log file details for debugging
            Log::info('Profile Picture Upload Details', [
                'original_name' => $profilePicture->getClientOriginalName(),
                'mime_type' => $profilePicture->getMimeType(),
                'size' => $profilePicture->getSize(),
            ]);

            Log::info('Profile picture uploaded successfully', [
                'new_path' => $profilePicturePath
            ]);
        }

        // Create the user
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'age' => $request->input('age'),
            'birthday' => $request->input('birthday'),
            'status' => $request->input('status'),
            'address_street' => $request->input('address_street'),
            'address_city' => $request->input('address_city'),
            'address_state' => $request->input('address_state'),
            'address_postal_code' => $request->input('address_postal_code'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')),
            'phone_number' => $request->input('phone_number'),
            'gender' => $request->input('gender'),
            'extension_name' => $request->input('extension_name'),
            'employee_id' => $request->input('employee_id'),
            'profile_picture' => $profilePicturePath ?? 'default-profile.png',
        ]);

        // Log registration event
        Log::info('New user registered', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $user->role,
            'status' => $user->status
        ]);

        // Redirect to login page with success message
        return redirect('/login_page')->with('success', 'Registration successful! Please log in.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Attempt to authenticate and check user status
        if (auth()->attempt($credentials, $remember)) {
            $user = auth()->user();

            // Check user status
            switch ($user->status) {
                case 'blocked':
                    auth()->logout();
                    return redirect()->back()->withErrors([
                        'email' => 'Your account has been blocked. Please contact the administrator.'
                    ]);

                case 'pending':
                    auth()->logout();
                    return redirect()->back()->withErrors([
                        'email' => 'Your account is pending approval. Please wait for administrator verification.'
                    ]);

                default:
                    // Update last login timestamp
                    $user->last_login_at = now();
                    $user->save();

                    // Regenerate session
                    $request->session()->regenerate();

                    // Log login attempt
                    Log::info('User logged in', [
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'last_login_at' => $user->last_login_at
                    ]);

                    // Redirect based on role - always to dashboard
                    return redirect('/dashboard');
            }
        }

        // Authentication failed
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login_page');
    }

    public function accountList()
    {
        // Fetch all users, ordered by most recent first
        $users = User::orderBy('created_at', 'desc')->get();

        // Return the view with users data
        return view('Pages.Account.account_list', compact('users'));
    }

    public function viewAccount($id)
    {
        // Find the user or fail (404 if not found)
        $user = User::findOrFail($id);

        // Return the view with user data
        return view('Pages.Account.account_view', compact('user'));
    }

    public function editAccount($id)
    {
        // Find the user or fail (404 if not found)
        $user = User::findOrFail($id);

        // Return the edit view with user data
        return view('Pages.Account.account_edit', compact('user'));
    }

    public function deleteAccount($id)
    {
        // Find the user or fail (404 if not found)
        $user = User::findOrFail($id);

        // Log the deletion
        Log::info('User account deleted', [
            'deleted_user_id' => $user->id,
            'deleted_user_email' => $user->email,
            'deleted_by_user_id' => auth()->id()
        ]);

        // Delete the user
        $user->delete();

        // Redirect back to account list with success message
        return redirect()->route('account_list')->with('success', 'User account deleted successfully.');
    }

    public function deleteAdmin($id)
    {
        try {
            $admin = User::findOrFail($id);

            // Optional: Add authorization check to ensure only authorized users can delete admins
            if (Auth::user()->role !== 'admin') {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            $admin->delete();

            return redirect()->route('account_list')->with('success', 'Admin account deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting admin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete admin account.');
        }
    }

    public function registerModal(Request $request)
    {
        // Use the same validation as the regular register method
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'birthday' => 'required|date|before:today',
            'status' => 'required|in:active,pending,blocked',
            'address_street' => 'required|string|max:255',
            'address_city' => 'required|string|max:255',
            'address_state' => 'required|string|max:255',
            'address_postal_code' => 'required|string|max:10',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,manager',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string|regex:/^[0-9]{10,15}$/',
            'gender' => 'required|string|in:male,female,other',
            'extension_name' => 'nullable|string|max:10',
            'employee_id' => 'required|string|unique:users,employee_id|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the user (same as regular register)
        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'extension_name' => $request->extension_name,
                'age' => $request->age,
                'birthday' => $request->birthday,
                'status' => $request->status,
                'gender' => $request->gender,
                'address_street' => $request->address_street,
                'address_city' => $request->address_city,
                'address_state' => $request->address_state,
                'address_postal_code' => $request->address_postal_code,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'employee_id' => $request->employee_id,
            ]);

            // Return to account list with success message
            return redirect()->route('account_list')->with('success', 'New admin account created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating account: ' . $e->getMessage())
                ->withInput();
        }
    }
    public function updateAccount(Request $request, $id = null)
{
    // If no ID is provided, use the authenticated user's ID
    $id = $id ?? auth()->id();
    
    // Find the user or fail (404 if not found)
    $user = User::findOrFail($id);

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'age' => 'required|integer|min:18|max:100',
        'birthday' => 'required|date|before:today',
        'address_street' => 'required|string|max:255',
        'address_city' => 'required|string|max:255',
        'address_state' => 'required|string|max:255',
        'address_postal_code' => 'required|string|max:10',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'phone_number' => 'required|string|regex:/^[0-9]{10,15}$/',
        'gender' => 'required|string|in:male,female,other',
        'extension_name' => 'nullable|string|max:10',
    ]);

    // If validation fails, return back with errors and input
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Update the user's profile
    $user->update($request->except('password'));

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    // Return to account list with success message
    return redirect()->route('account_list')->with('success', 'Account updated successfully!');
}
}