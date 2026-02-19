
<div class="flex flex-col backdrop-blur-2xl">
    <div class="flex flex-row w-full justify-between items-center px-4">
        <img src="{{asset('/images/logo_full.png')}}" alt=""/>
        <button id="exit" class="w-fit rounded-sm bg-red-600 text-white px-4 py-3 capitalize text-[1.4rem]">exit quickly</button>
    </div>
    <hr class="text-alt-background h-[4px]">
</div>
<script>
    document.getElementById('exit').onclick = function() {
        // Open the new URL in a new tab
        window.open('https://meteo.go.ke/', '_blank');

        // Redirect the current tab to a different URL
        window.location.href = 'https://meteo.go.ke/';
    };
</script>

