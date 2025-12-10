<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\TemporaryUploadedFile;

class UserProfile extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;
    public $profile_pic;
    public $new_profile_pic; // for uploads

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public $user;

    public function mount()
    {
        $this->user = Auth::user();

        $this->first_name = explode(' ', $this->user->name)[0] ?? '';
        $this->last_name = explode(' ', $this->user->name)[1] ?? '';
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->address = $this->user->address;
        $this->profile_pic = $this->user->profile_pic;
    }

    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_pic' => 'nullable|image|max:5120', // 5MB
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveProfile()
    {
        $this->validate();

        // if ($this->profile_pic instanceof \Livewire\TemporaryUploadedFile) {
        //     $path = $this->profile_pic->store('profile_pics', 'public');
        //     $this->user->profile_pic = $path;
        // }

        if ($this->new_profile_pic instanceof TemporaryUploadedFile) {
            $path = $this->new_profile_pic->store('profile_pics', 'public');
            $this->user->profile_pic = $path;
            $this->profile_pic = $path; // update displayed image
        }


        $this->user->name = trim($this->first_name . ' ' . $this->last_name);
        $this->user->email = $this->email;
        $this->user->phone = $this->phone;
        $this->user->address = $this->address;

        $this->user->save();

        session()->flash('message', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Current password is incorrect.');
            return;
        }

        $this->user->password = Hash::make($this->new_password);
        $this->user->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        session()->flash('password_message', 'Password changed successfully.');
    }
    public function render()
    {
        return view('livewire.user.user-profile');
    }
}
