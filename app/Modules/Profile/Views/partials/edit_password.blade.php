<section>
            <div class="row card-body">
                <div class="col-12 ">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Update Password') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Ensure your account is using a long, random password to stay secure.') }}
                        </p>
                    </header>


                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div class="row mb-3">
                            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="" />
                            <div class="col-sm-10">
                                <x-text-input id="update_password_current_password" name="current_password"
                                    type="password" class="" autocomplete="current-password" />
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div class="row mb-3">
                            <x-input-label for="update_password_password" :value="__('New Password')" />
                            <div class="col-sm-10">
                                <x-text-input id="update_password_password" name="password" type="password"
                                    class="form-control" autocomplete="new-password" />
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div class="row mb-3">
                            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                            <div class="col-sm-10">
                                <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                    type="password" class="form-control" autocomplete="new-password" />
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="row ">
                            <div class="col-sm-10">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </section>
