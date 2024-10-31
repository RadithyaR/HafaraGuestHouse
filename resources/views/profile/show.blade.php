<!DOCTYPE html>
<html lang="en">
   <head>
    <base href="/public">
      @include('home.css')
      <style>
        .profile-content {
            padding: 2rem 0;
            background: #f8f9fa;
        }
        
        .profile-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 0 auto;
            max-width: 80rem;
            padding: 2rem;
        }

        .section-spacing {
            margin-top: 2.5rem;
        }

        .border-section {
            border-top: 1px solid #e5e7eb;
            margin: 2rem 0;
            padding-top: 2rem;
        }

        /* Memastikan tidak ada style yang mengganggu header */
        .header-section {
            position: relative;
            z-index: 100;
        }

        /* Mengatur jarak antara header dan konten */
        .main-content {
            position: relative;
            z-index: 99;
        }
      </style>
   </head>
   <body>
        <!-- Original Header -->
        <div class="header-section">
            @include('home.header')
        </div>

        <!-- Profile Content -->
        <div class="main-content">
            <section class="profile-content">
                <x-app-layout>
                <div class="profile-container">
                    
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        <div>
                            @livewire('profile.update-profile-information-form')
                        </div>

                        <div class="border-section"></div>
                    @endif
                    

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        <div class="section-spacing">
                            @livewire('profile.update-password-form')
                        </div>

                        <div class="border-section"></div>
                    @endif

                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <div class="section-spacing">
                            @livewire('profile.two-factor-authentication-form')
                        </div>

                        <div class="border-section"></div>
                    @endif

                    <div class="section-spacing">
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                        <div class="border-section"></div>

                        <div class="section-spacing">
                            @livewire('profile.delete-user-form')
                        </div>
                    @endif
                </div>
            </x-app-layout>
            </section>
        </div>

        <!-- Footer -->
        @include('home.footer')

        <!-- JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" 
                crossorigin="anonymous"></script>
   </body>
</html>