<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login_form_container">
        <div class="login_form">
            <center><img src="{{ asset('assets') }}/login/image/logo.png" alt="Italian Trulli" width="150"
                    height="60"></center>

            <form id="login_form" action="{{ route('login') }}" method="post">
                @csrf
                <div class="input_group">
                    <i class="fa fa-envelope"></i>
                    <input type="text" placeholder="Email" name="email" class="input_text" required :value="old('email')" autocomplete="off" />
                </div>
                <div class="input_group">
                    <i class="fa fa-unlock-alt"></i>
                    <input type="password" name="password" placeholder="Password" required class="input_text" autocomplete="off" />
                </div>
                <div class="button_group" id="login_button">
                    {{-- <a href="javascript:{}" type="submit" onclick="document.getElementById('login_form').submit();">Submit</a> --}}
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
