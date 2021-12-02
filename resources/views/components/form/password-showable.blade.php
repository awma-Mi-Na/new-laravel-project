<div class="mb-4">
    <label
        class="block uppercase mb-2 font-bold text-sm text-gray-700"
        for="password"
    >Password</label>
    <input
        class="border border-gray-400 p-2 w-full"
        type="password"
        name="password"
        id="password"
    >
    <i
        style="margin-left: -60px; cursor: pointer;"
        id="togglePassword"
        class="text-xs"
    >Show</i>
</div>
@error('password')
    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
@enderror


<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        //toggle show/hide
        if (togglePassword.innerHTML === "Show")
            togglePassword.innerHTML = "Hide";
        else
            togglePassword.innerHTML = "Show";
    });
</script>
