<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ChatPopup extends Component
{
    public $userMessage = '';
    public $options = [];
    public $messages = [];

    public function render()
    {
        Log::debug('Messages:', $this->messages);
        Log::debug('Options:', $this->options);

        // If there are no messages yet, simulate sending a message to get the initial options
        if (empty($this->messages)) {
            $this->options = $this->getOptions(1); // Assign the initial set of options
            $this->appendMessage('Bot', 'Please select one of the options:');
        }

        return view('livewire.chat-popup', ['messages' => $this->messages]);
    }

    public function sendMessage()
    {
        $this->appendMessage('User', $this->userMessage);

        // Simulate the backend logic to get options
        $this->options = $this->getOptions(2); // Modify to get the options for the next step
        $this->appendMessage('Bot', 'Please select one of the options:');
    }

    public function selectOption($selectedOption)
    {
        $this->appendMessage('User', $selectedOption);
        $this->sendMessage(); // Continue the conversation
    }

    private function getOptions($step)
    {
        switch ($step) {
            case 1:
                return ['Option 1A', 'Option 1B', 'Option 1C'];
            case 2:
                return ['Option 2A', 'Option 2B', 'Option 2C'];
            // Add more cases as needed
            default:
                return ['Invalid step'];
        }
    }

    private function appendMessage($sender, $message)
    {
        // Append the message to the $messages property
        $this->messages[] = ['sender' => $sender, 'message' => $message];

        // You can handle message appending logic here
        // For simplicity, you can just print to the console for now
        $this->emit('appendMessage', $sender, $message);
    }
}
