<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <button type="button" onclick=register_fingerprint()>
                    Registrar huella dactilar
                </button>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <script>
         async function register_fingerprint() {
        if (Webpass.isUnsupported()) {
            alert("Tu navegador o dispositivo no es compatible con WebAuthn.");
            return;
        }

        try {
            const { success, error } = await Webpass.attest(
                "/webauthn/register/options",
                "/webauthn/register"
            );

            if (success) {
                alert("Huella registrada correctamente.");
                window.location.replace("/dashboard");
            } else {
                alert("Ocurrió un error al registrar la huella.");
                console.error(error);
            }
        } catch (e) {
            console.error(e);
            alert("Error durante el registro de la huella: " + (e.message || "desconocido"));
        }
    }
    </script>
</x-app-layout>
