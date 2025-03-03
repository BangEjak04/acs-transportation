<h1 class="text-3xl font-bold mb-4">Welcome to ACS Transportation</h1>
<p class="text-gray-700">Your trusted partner in transportation services.</p>
<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle Content</button>
 
    <div x-show="open">
        Content...
    </div>
</div>