<div>
    <div>
        <button>option 01</button>
        <button>option 01</button>
        <button>option 01</button>


    </div>
</div>

<script>
    // Livewire does not handle dynamic content well in scripts
    // If you need to dynamically update JavaScript, consider using Alpine.js or Livewire hooks
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.processed', function(message, component) {
            // Scroll to the bottom after Livewire update
            document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight;
        });
    });
</script>