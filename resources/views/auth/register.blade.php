<link rel="icon" type="image/x-icon" href="/images/kmutt-logo.png">

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div class="col-sm-4  text-center" style="background-color: #E64011; border-radius: 25px">
                <a href="{{route('home')}}">
                    <img src="/images/kmutt-logo.png" alt="" width="100px" height="115px">
                </a>
            </div>
            {{-- <x-jet-authentication-card-logo /> --}}
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" x-data="{role_id: 2}">
            @csrf

            <div class="text-center text-lg ">Registration</div>

            <div>
                <x-jet-label for="role_id" value="{{ __('Register as:') }}" />
                <select name="role_id" x-model="role_id" class="block mt-1 w-full border-gray-300 focus:border-red-700 focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="1">Admin</option>
                    <option value="2">Student</option>
                    <option value="3">Teacher</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4" x-show="role_id != 1">
                <x-jet-label for="DepartmentID" value="{{ __('Department:') }}" />
                <select name="DepartmentID" x-model="DepartmentID" class="block mt-1 w-full border-gray-300 focus:border-red-700 focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="" selected>Select department...</option>
                    <option value="101">Computer Engineering</option>
                    <option value="102">ME</option>
                    <option value="111">Maths</option>
                </select>
            </div>
            
            <div class="mt-4" x-show="role_id == 2">
                <x-jet-label for="student_licence_number" value="{{ __('Licence Number') }}" />
                <x-jet-input id="student_licence_number" class="block mt-1 w-full" type="text" :value="old('student_licence_number')" name="student_licence_number" />
            </div>

            <div class="mt-4" x-show="role_id == 2">
                <x-jet-label for="student_address" value="{{ __('Address') }}" />
                <x-jet-input id="student_address" class="block mt-1 w-full" type="text" :value="old('student_address')" name="student_address" />
            </div>

            <div class="mt-4" x-show="role_id == 3">
                <x-jet-label for="teacher_qualifications" value="{{ __('Qualifications') }}" />
                <x-jet-input id="teacher_qualifications" class="block mt-1 w-full" type="text" :value="old('teacher_qualifications')" name="teacher_qualifications" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
